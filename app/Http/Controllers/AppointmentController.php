<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class AppointmentController extends Controller
{
    public function index(Request $request): View
    {
        $organization = $request->user()->currentOrganization();

        $appointments = $organization
            ? $organization->appointments()
                ->with(['client', 'service'])
                ->orderByDesc('scheduled_at')
                ->paginate(10)
            : Appointment::whereRaw('1 = 0')->paginate(10);

        return view('appointments.index', ['appointments' => $appointments]);
    }

    public function create(Request $request): View
    {
        $organization = $request->user()->currentOrganization();

        return view('appointments.create', [
            'clients' => $organization?->clients()->whereNull('archived_at')->orderBy('full_name')->get() ?? collect(),
            'services' => $organization?->services()->where('is_active', true)->orderBy('name')->get() ?? collect(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $organization = $request->user()->currentOrganization();

        abort_unless($organization, 403, "Aucune entreprise associée à ce compte.");

        $validated = $request->validate([
            'client_id' => ['required', 'exists:clients,id'],
            'service_id' => ['required', 'exists:services,id'],
            'scheduled_at' => ['required', 'date'],
        ]);

        $service = $organization->services()->findOrFail($validated['service_id']);
        $client = $organization->clients()->findOrFail($validated['client_id']);

        $this->assertNoConflict($organization, $validated['scheduled_at'], $service->duration_minutes);

        $organization->appointments()->create([
            'client_id' => $client->id,
            'service_id' => $service->id,
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
     * Vérifie qu'aucun rendez-vous non annulé n'occupe déjà ce créneau,
     * en excluant éventuellement le rendez-vous qu'on est en train de modifier.
     *
     * @throws ValidationException
     */
    protected function assertNoConflict($organization, string $scheduledAt, int $durationMinutes, ?int $excludeId = null): void
    {
        $start = \Carbon\Carbon::parse($scheduledAt);
        $end = $start->copy()->addMinutes($durationMinutes);

        $conflict = $organization->appointments()
            ->where('status', '!=', 'annule')
            ->when($excludeId, fn ($q) => $q->where('id', '!=', $excludeId))
            ->get()
            ->contains(function (Appointment $existing) use ($start, $end) {
                $existingStart = $existing->scheduled_at;
                $existingEnd = $existingStart->copy()->addMinutes($existing->duration_minutes);

                return $start->lt($existingEnd) && $end->gt($existingStart);
            });

        if ($conflict) {
            throw ValidationException::withMessages([
                'scheduled_at' => "Ce créneau chevauche un rendez-vous déjà existant. Choisissez un autre horaire.",
            ]);
        }
    }
}
