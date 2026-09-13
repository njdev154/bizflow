<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-ink">Rendez-vous</h2>
    </x-slot>

    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <div class="flex justify-end mb-6">
            <a href="{{ route('appointments.create') }}"
               class="inline-flex items-center justify-center h-11 px-5 bg-accent text-primary-dark rounded-xl font-semibold text-sm hover:bg-[#E08C00] transition">
                Nouveau rendez-vous
            </a>
        </div>

        <div class="bg-surface border border-border rounded-xl overflow-hidden">
            <table class="w-full text-sm">
                <thead class="bg-background text-muted text-xs uppercase">
                    <tr>
                        <th class="text-left px-4 py-3">Date / Heure</th>
                        <th class="text-left px-4 py-3">Client</th>
                        <th class="text-left px-4 py-3">Service</th>
                        <th class="text-left px-4 py-3">Statut</th>
                        <th class="text-right px-4 py-3"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border">
                    @forelse ($appointments as $appointment)
                        <tr>
                            <td class="px-4 py-3 text-ink">{{ $appointment->scheduled_at->translatedFormat('d M Y, H:i') }}</td>
                            <td class="px-4 py-3 text-ink font-medium">{{ $appointment->client->full_name ?? 'Client supprimé' }}</td>
                            <td class="px-4 py-3 text-muted">{{ $appointment->service->name ?? '—' }}</td>
                            <td class="px-4 py-3">
                                <form method="POST" action="{{ route('appointments.status', $appointment) }}">
                                    @csrf
                                    @method('PATCH')
                                    <select name="status" onchange="this.form.submit()"
                                            class="text-xs font-semibold px-2.5 py-1.5 rounded-full border-0 {{ $appointment->statusBadgeClass() }}">
                                        @foreach (['planifie' => 'Planifié', 'confirme' => 'Confirmé', 'en_attente' => 'En attente', 'termine' => 'Terminé', 'annule' => 'Annulé', 'absent' => 'Absent'] as $value => $label)
                                            <option value="{{ $value }}" @selected($appointment->status === $value)>{{ $label }}</option>
                                        @endforeach
                                    </select>
                                </form>
                            </td>
                            <td class="px-4 py-3 text-right">
    @if (!$appointment->payment)
        <a href="{{ route('payments.create', ['appointment_id' => $appointment->id]) }}" class="text-accent font-semibold hover:underline">Encaisser</a>
    @endif
</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-10 text-center text-muted">
                                Aucun rendez-vous enregistré pour l'instant.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $appointments->links() }}
        </div>
    </div>
</x-app-layout>
