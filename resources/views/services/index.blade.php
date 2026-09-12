<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-ink">Services</h2>
    </x-slot>

    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <div class="flex justify-end mb-6">
            <a href="{{ route('services.create') }}"
               class="inline-flex items-center justify-center h-11 px-5 bg-accent text-primary-dark rounded-xl font-semibold text-sm hover:bg-[#E08C00] transition">
                Ajouter un service
            </a>
        </div>

        <div class="bg-surface border border-border rounded-xl overflow-hidden">
            <table class="w-full text-sm">
                <thead class="bg-background text-muted text-xs uppercase">
                    <tr>
                        <th class="text-left px-4 py-3">Nom</th>
                        <th class="text-left px-4 py-3">Durée</th>
                        <th class="text-left px-4 py-3">Prix</th>
                        <th class="text-left px-4 py-3">Catégorie</th>
                        <th class="text-left px-4 py-3">Statut</th>
                        <th class="text-right px-4 py-3"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border">
                    @forelse ($services as $service)
                        <tr>
                            <td class="px-4 py-3 font-medium text-ink">{{ $service->name }}</td>
                            <td class="px-4 py-3 text-muted">{{ $service->duration_minutes }} min</td>
                            <td class="px-4 py-3 text-muted">{{ number_format($service->price, 0, ',', ' ') }} FCFA</td>
                            <td class="px-4 py-3 text-muted">{{ $service->category ?? '—' }}</td>
                            <td class="px-4 py-3">
                                @if ($service->is_active)
                                    <span class="text-xs font-semibold px-2.5 py-1 rounded-full bg-[#E8F7EE] text-success">Actif</span>
                                @else
                                    <span class="text-xs font-semibold px-2.5 py-1 rounded-full bg-[#EEF1F5] text-muted">Inactif</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-right">
                                <a href="{{ route('services.edit', $service) }}" class="text-accent font-semibold hover:underline">Modifier</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-10 text-center text-muted">
                                Aucun service enregistré pour l'instant.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $services->links() }}
        </div>
    </div>
</x-app-layout>
