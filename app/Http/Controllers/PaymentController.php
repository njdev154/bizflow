<?php

namespace App\Http\Controllers;

use App\Models\AuditLog;
use App\Models\Payment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class PaymentController extends Controller
{
    public function index(Request $request): View
    {
        $organization = $request->user()->currentOrganization();

        $payments = $organization
            ? $organization->payments()->with(['client', 'appointment.service'])->latest('paid_at')->paginate(10)
            : Payment::whereRaw('1 = 0')->paginate(10);

        return view('payments.index', ['payments' => $payments]);
    }

    public function create(Request $request): View
    {
        $organization = $request->user()->currentOrganization();

        $eligibleAppointments = $organization
            ? $organization->appointments()
                ->whereDoesntHave('payment')
                ->where('status', '!=', 'annule')
                ->with(['client', 'service'])
                ->orderByDesc('scheduled_at')
                ->get()
            : collect();

        $clients = $organization?->clients()->whereNull('archived_at')->orderBy('full_name')->get() ?? collect();

        return view('payments.create', [
            'eligibleAppointments' => $eligibleAppointments,
            'clients' => $clients,
            'selectedAppointmentId' => $request->query('appointment_id'),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $organization = $request->user()->currentOrganization();

        abort_unless($organization, 403, "Aucune entreprise associée à ce compte.");

        $validated = $request->validate([
            'appointment_id' => [
                'nullable',
                Rule::exists('appointments', 'id')->where('organization_id', $organization->id),
                function ($attribute, $value, $fail) use ($organization) {
                    if ($value && $organization->payments()->where('appointment_id', $value)->exists()) {
                        $fail('Ce rendez-vous a déjà un paiement enregistré.');
                    }
                },
            ],
            'client_id' => ['required', Rule::exists('clients', 'id')->where('organization_id', $organization->id)],
            'amount' => ['required', 'numeric', 'min:0'],
            'method' => ['required', 'in:especes,mobile_money,carte,autre'],
            'paid_at' => ['required', 'date'],
        ]);

        $payment = $organization->payments()->create([
            'client_id' => $validated['client_id'],
            'appointment_id' => $validated['appointment_id'] ?? null,
            'amount' => $validated['amount'],
            'method' => $validated['method'],
            'status' => 'enregistre',
            'paid_at' => $validated['paid_at'],
        ]);

        AuditLog::record('payment.created', $payment, ['amount' => (float) $payment->amount, 'method' => $payment->method]);

        return redirect()->route('payments.index')->with('status', 'Paiement enregistré avec succès.');
    }
}
