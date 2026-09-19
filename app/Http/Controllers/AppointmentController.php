<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class AppointmentController extends Controller
{
    public function index(Request $request): View
    {
        $organization = $request->user()->currentOrganization();

        $filters = $request->only(['service_id', 'employee_id', 'status']);

        $appointments = $organization
            ? $organization->appointments()
                ->with(['client', 'service', 'employee'])
                ->when($filters['service_id'] ?? null, fn ($q, $v) => $q->where('service_id', $v))
                ->when($filters['employee_id'] ?? null, fn ($q, $v) => $q->where('employee_id', $v))
                ->when($filters['status'] ?? null, fn ($q, $v) => $q->where('status', $v))
                ->orderByDesc('scheduled_at')
                ->paginate(10)
                ->withQueryString()
            : Appointment::whereRaw('1 = 0')->paginate(10);

        return view('appointments.index', [
            'appointments' => $appointments,
            'filters' => $filters,
            'services' => $organization?->services()->orderBy('name')->get() ?? collect(),
            'employees' => $organization?->users()->orderBy('name')->get() ?? collect(),
        ]);
    }

    public function create(Request $request): View
    {
        $organization = $request->user()->currentOrganization();

        return view('appointments.create', [
            'clients' => $organization?->clients()->whereNull('archived_at')->orderBy('full_name')->get() ?? collect(),
            'services' => $organization?->services()->where('is_active', true)->orderBy('name')->get() ?? collect(),
            'employees' => $organization?->users()->orderBy('name')->get() ?? collect(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $organization = $request->user()->currentOrganization();

        abort_unless($organization, 403, "Aucune entreprise associée à ce compte.");

        $validated = $request->validate([
            'client_id' => ['required', 'exists:clients,id'],
            'service_id' => ['required', 'exists:services,id'],
            'employee_id' => [
                'nullable',
                Rule::exists('memberships', 'user_id')->where('organization_id', $organization->id),
            ],
            'scheduled_at' => ['required', 'date'],
        ]);

        $service = $organization->services()->findOrFail($validated['service_id']);
        $client = $organization->clients()->findOrFail($validated['client_id']);
        $employeeId = $validated['employee_id'] ?? null;

        $this->assertNoConflict($organization, $validated['scheduled_at'], $service->duration_minutes, $employeeId);

        $organization->appointments()->create([
            'client_id' => $client->id,
            'service_id' => $service->id,
            'employee_id' => $employeeId,
            'scheduled_at' => $validated['scheduled_at'],
            'duration_minutes' => $service->duration_minutes,
            'status' => 'planifie',
        ]);

        return redirect()->route('appointments.index')->with('status', 'Rendez-vous créé avec succès.');
    }

    public function updateStatus(Request $request, Appointment $appointment): RedirectResponse
    {
        $organization = $request->user()->currentOrganization();
        abort_if(!$organization || $appointment->organization_id !== $organization->id, 403);

        $validated = $request->validate([
            'status' => ['required', 'in:planifie,confirme,en_attente,termine,annule,absent'],
        ]);

        $appointment->update(['status' => $validated['status']]);

        return back()->with('status', 'Statut mis à jour.');
    }

    /**
     * Vérifie qu'aucun rendez-vous non annulé n'occupe déjà ce créneau.
     *
     * Règle : deux rendez-vous ne se bloquent mutuellement que s'ils seraient
     * gérés par la même personne. Si l'un des deux (ou les deux) n'a pas
     * d'employé assigné, on considère qu'il s'agit de l'opérateur général
     * de l'entreprise (cas d'un salon avec une seule personne) et on
     * compare uniquement entre rendez-vous eux-mêmes non assignés.
     *
     * @throws ValidationException
     */
    protected function assertNoConflict($organization, string $scheduledAt, int $durationMinutes, ?int $employeeId, ?int $excludeId = null): void
    {
        $start = \Carbon\Carbon::parse($scheduledAt);
        $end = $start->copy()->addMinutes($durationMinutes);

        $conflict = $organization->appointments()
            ->where('status', '!=', 'annule')
            ->where('employee_id', $employeeId)
            ->when($excludeId, fn ($q) => $q->where('id', '!=', $excludeId))
            ->get()
            ->contains(function (Appointment $existing) use ($start, $end) {
                $existingStart = $existing->scheduled_at;
                $existingEnd = $existingStart->copy()->addMinutes($existing->duration_minutes);

                return $start->lt($existingEnd) && $end->gt($existingStart);
            });

        if ($conflict) {
            throw ValidationException::withMessages([
                'scheduled_at' => "Ce créneau chevauche un rendez-vous déjà existant pour cette même personne. Choisissez un autre horaire ou un autre employé.",
            ]);
        }
    }
}
