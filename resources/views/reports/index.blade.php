<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-ink">Rapports</h2>
    </x-slot>

    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <!-- Sélecteur de période -->
        <div class="flex gap-2 mb-6">
            @foreach (['7d' => '7 jours', '30d' => '30 jours', 'month' => 'Ce mois'] as $value => $label)
                <a href="{{ route('reports.index', ['period' => $value]) }}"
                   class="px-4 py-2 rounded-xl text-sm font-medium {{ $period === $value ? 'bg-primary text-white' : 'bg-surface border border-border text-muted hover:text-ink' }}">
                    {{ $label }}
                </a>
            @endforeach
        </div>

        <p class="text-sm text-muted mb-6">Période : {{ $periodLabel }}</p>

        <!-- KPI -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6">
            <div class="bg-surface border border-border rounded-xl p-4">
                <div class="text-sm text-muted mb-2">Chiffre d'affaires</div>
                <div class="text-2xl font-bold text-ink">{{ number_format($totalRevenue, 0, ',', ' ') }} FCFA</div>
            </div>
            <div class="bg-surface border border-border rounded-xl p-4">
                <div class="text-sm text-muted mb-2">Rendez-vous sur la période</div>
                <div class="text-2xl font-bold text-ink">{{ $appointmentsCount }}</div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">

            <!-- Répartition par méthode de paiement -->
            <div class="bg-surface border border-border rounded-xl p-4">
                <h2 class="text-base font-semibold text-ink mb-4">Répartition des paiements</h2>

                @forelse ($byMethod as $row)
                    <div class="mb-3">
                        <div class="flex justify-between text-sm mb-1">
                            <span class="text-ink font-medium">{{ $row['label'] }}</span>
                            <span class="text-muted">{{ number_format($row['sum'], 0, ',', ' ') }} FCFA ({{ $row['percent'] }}%)</span>
                        </div>
                        <div class="w-full h-2.5 rounded-full bg-background overflow-hidden">
                            <div class="h-full rounded-full {{ $row['color'] }}" style="width: {{ $row['percent'] }}%"></div>
                        </div>
                    </div>
                @empty
                    <p class="text-sm text-muted py-6 text-center">Aucun paiement sur cette période.</p>
                @endforelse
            </div>

            <!-- Rendez-vous par statut -->
            <div class="bg-surface border border-border rounded-xl p-4">
                <h2 class="text-base font-semibold text-ink mb-4">Rendez-vous par statut</h2>

                @forelse ($byStatus as $row)
                    <div class="flex items-center justify-between py-2 border-b border-border last:border-0">
                        <span class="text-sm text-ink">{{ $row['label'] }}</span>
                        <span class="text-sm font-semibold text-ink">{{ $row['count'] }}</span>
                    </div>
                @empty
                    <p class="text-sm text-muted py-6 text-center">Aucun rendez-vous sur cette période.</p>
                @endforelse
            </div>

            <!-- Services les plus demandés -->
            <div class="bg-surface border border-border rounded-xl p-4 lg:col-span-2">
                <h2 class="text-base font-semibold text-ink mb-4">Services les plus demandés</h2>

                @forelse ($topServices as $row)
                    <div class="flex items-center justify-between py-2 border-b border-border last:border-0">
                        <span class="text-sm text-ink">{{ $row['name'] }}</span>
                        <span class="text-sm font-semibold text-ink">{{ $row['count'] }} rendez-vous</span>
                    </div>
                @empty
                    <p class="text-sm text-muted py-6 text-center">Aucun service demandé sur cette période.</p>
                @endforelse
            </div>

        </div>
    </div>
</x-app-layout>
