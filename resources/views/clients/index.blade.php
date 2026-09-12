<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-ink">Clients</h2>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
            <form method="GET" class="w-full sm:max-w-sm">
                <input type="text" name="q" value="{{ $search }}" placeholder="Rechercher un client..."
                       class="w-full h-11 px-4 border border-border rounded-xl text-sm text-ink focus:outline-none focus:border-accent focus:ring-2 focus:ring-accent/30">
            </form>
            <a href="{{ route('clients.create') }}"
               class="inline-flex items-center justify-center h-11 px-5 bg-accent text-primary-dark rounded-xl font-semibold text-sm hover:bg-[#E08C00] transition whitespace-nowrap">
                Ajouter un client
            </a>
        </div>

        <div class="bg-surface border border-border rounded-xl overflow-hidden">
            <table class="w-full text-sm">
                <thead class="bg-background text-muted text-xs uppercase">
                    <tr>
                        <th class="text-left px-4 py-3">Nom</th>
                        <th class="text-left px-4 py-3">Téléphone</th>
                        <th class="text-left px-4 py-3">Email</th>
                        <th class="text-left px-4 py-3">Ajouté le</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border">
                    @forelse ($clients as $client)
                        <tr>
                            <td class="px-4 py-3 font-medium text-ink">{{ $client->full_name }}</td>
                            <td class="px-4 py-3 text-muted">{{ $client->phone ?? '—' }}</td>
                            <td class="px-4 py-3 text-muted">{{ $client->email ?? '—' }}</td>
                            <td class="px-4 py-3 text-muted">{{ $client->created_at->format('d/m/Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-4 py-10 text-center text-muted">
                                @if ($search !== '')
                                    Aucun client ne correspond à "{{ $search }}".
                                @else
                                    Aucun client enregistré pour l'instant.
                                @endif
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $clients->links() }}
        </div>
    </div>
</x-app-layout>
