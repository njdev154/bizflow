<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-ink">Paiements</h2>
    </x-slot>

    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <div class="flex justify-end mb-6">
            <a href="{{ route('payments.create') }}"
               class="inline-flex items-center justify-center h-11 px-5 bg-accent text-primary-dark rounded-xl font-semibold text-sm hover:bg-[#E08C00] transition">
                Enregistrer un paiement
            </a>
        </div>

        <div class="bg-surface border border-border rounded-xl overflow-hidden">
            <table class="w-full text-sm">
                <thead class="bg-background text-muted text-xs uppercase">
                    <tr>
                        <th class="text-left px-4 py-3">Date</th>
                        <th class="text-left px-4 py-3">Client</th>
                        <th class="text-left px-4 py-3">Service</th>
                        <th class="text-left px-4 py-3">Méthode</th>
                        <th class="text-right px-4 py-3">Montant</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border">
                    @forelse ($payments as $payment)
                        <tr>
                            <td class="px-4 py-3 text-muted">{{ $payment->paid_at->translatedFormat('d M Y, H:i') }}</td>
                            <td class="px-4 py-3 font-medium text-ink">{{ $payment->client->full_name ?? 'Vente directe' }}</td>
                            <td class="px-4 py-3 text-muted">{{ $payment->appointment?->service?->name ?? '—' }}</td>
                            <td class="px-4 py-3 text-muted capitalize">{{ str_replace('_', ' ', $payment->method) }}</td>
                            <td class="px-4 py-3 text-right font-semibold text-ink">{{ number_format($payment->amount, 0, ',', ' ') }} FCFA</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-10 text-center text-muted">
                                Aucun paiement enregistré pour l'instant.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $payments->links() }}
        </div>
    </div>
</x-app-layout>
