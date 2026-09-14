<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-ink">Journal d'audit</h2>
    </x-slot>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        @php
            $actionLabels = [
                'client.created' => 'Client créé',
                'client.updated' => 'Client modifié',
                'payment.created' => 'Paiement enregistré',
                'employee.role_updated' => 'Rôle employé modifié',
                'employee.removed' => 'Employé retiré',
                'connexion' => 'Connexion',
            ];
        @endphp

        <div class="bg-surface border border-border rounded-xl overflow-hidden">
            <table class="w-full text-sm">
                <thead class="bg-background text-muted text-xs uppercase">
                    <tr>
                        <th class="text-left px-4 py-3">Date</th>
                        <th class="text-left px-4 py-3">Utilisateur</th>
                        <th class="text-left px-4 py-3">Action</th>
                        <th class="text-left px-4 py-3">Détail</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border">
                    @forelse ($logs as $log)
                        <tr>
                            <td class="px-4 py-3 text-muted">{{ $log->created_at->format('d/m/Y H:i') }}</td>
                            <td class="px-4 py-3 text-ink font-medium">{{ $log->user->name ?? 'Utilisateur supprimé' }}</td>
                            <td class="px-4 py-3 text-ink">{{ $actionLabels[$log->action] ?? $log->action }}</td>
                            <td class="px-4 py-3 text-muted">{{ collect($log->meta)->map(fn($v, $k) => "$k: $v")->implode(', ') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-4 py-10 text-center text-muted">Aucune action enregistrée pour l'instant.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">{{ $logs->links() }}</div>
    </div>
</x-app-layout>
