<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-ink">Tableau de bord</h2>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <h1 class="text-xl font-semibold text-ink mb-1">
            Bonjour, {{ explode(' ', auth()->user()->name)[0] }}
        </h1>
        <p class="text-sm text-muted mb-6">
            Voici un aperçu de l'activité de {{ $organization->name ?? 'votre entreprise' }} aujourd'hui — {{ now()->translatedFormat('l j F Y') }}.
        </p>

        <!-- ============ KPI ============ -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">

            <div class="bg-surface border border-border rounded-xl p-4 shadow-sm">
                <div class="text-sm text-muted mb-2">Rendez-vous aujourd'hui</div>
                <div class="text-2xl font-bold text-ink mb-1">{{ $stats['appointments_today']['value'] }}</div>
                @if (!is_null($stats['appointments_today']['delta']))
                    <div class="text-xs font-semibold {{ $stats['appointments_today']['delta'] >= 0 ? 'text-success' : 'text-danger' }}">
                        {{ $stats['appointments_today']['delta'] >= 0 ? '↑' : '↓' }} {{ abs($stats['appointments_today']['delta']) }}% vs hier
                    </div>
                @else
                    <div class="text-xs text-muted">Pas de comparaison disponible</div>
                @endif
            </div>

            <div class="bg-surface border border-border rounded-xl p-4 shadow-sm">
                <div class="text-sm text-muted mb-2">Clients actifs</div>
                <div class="text-2xl font-bold text-ink mb-1">{{ $stats['active_clients']['value'] }}</div>
                <div class="text-xs text-muted">Total, hors clients archivés</div>
            </div>

            <div class="bg-surface border border-border rounded-xl p-4 shadow-sm">
                <div class="text-sm text-muted mb-2">Chiffre d'affaires (jour)</div>
                <div class="text-2xl font-bold text-ink mb-1">{{ number_format($stats['revenue_today']['value'], 0, ',', ' ') }} FCFA</div>
                @if (!is_null($stats['revenue_today']['delta']))
                    <div class="text-xs font-semibold {{ $stats['revenue_today']['delta'] >= 0 ? 'text-success' : 'text-danger' }}">
                        {{ $stats['revenue_today']['delta'] >= 0 ? '↑' : '↓' }} {{ abs($stats['revenue_today']['delta']) }}% vs hier
                    </div>
                @else
                    <div class="text-xs text-muted">Pas de comparaison disponible</div>
                @endif
            </div>

        </div>

        <!-- ============ AGENDA + GRAPHIQUE/PAIEMENTS ============ -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 items-start">

            <!-- Rendez-vous du jour -->
            <div class="bg-surface border border-border rounded-xl p-4 shadow-sm">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-base font-semibold text-ink">Rendez-vous du jour</h2>
                </div>

                @forelse ($upcomingAppointments as $appointment)
                    <div class="flex items-center gap-3 py-3 {{ !$loop->last ? 'border-b border-border' : '' }}">
                        <div class="w-14 shrink-0 text-sm font-bold text-ink">
                            {{ $appointment->scheduled_at->format('H:i') }}
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="text-sm font-semibold text-ink truncate">{{ $appointment->client->full_name ?? 'Client supprimé' }}</div>
                            <div class="text-xs text-muted truncate">{{ $appointment->service->name ?? '—' }}</div>
                        </div>
                        <span class="text-xs font-semibold px-2.5 py-1 rounded-full {{ $appointment->statusBadgeClass() }}">
                            {{ $appointment->statusLabel() }}
                        </span>
                    </div>
                @empty
                    <p class="text-sm text-muted py-6 text-center">
                        Aucun rendez-vous prévu aujourd'hui.
                    </p>
                @endforelse
            </div>

            <div class="flex flex-col gap-4">

                <!-- Chiffre d'affaires 7 jours -->
                <div class="bg-surface border border-border rounded-xl p-4 shadow-sm">
                    <h2 class="text-base font-semibold text-ink mb-4">Chiffre d'affaires (7 derniers jours)</h2>

                    @if ($weeklyRevenue->sum('total') > 0)
                        <div class="flex items-end gap-3 h-40">
                            @foreach ($weeklyRevenue as $day)
                                <div class="flex-1 flex flex-col items-center justify-end gap-2 h-full">
                                    <div class="w-3/5 rounded-t {{ $day['total'] == $maxWeeklyRevenue ? 'bg-accent' : 'bg-accent-light' }}"
                                         style="height: {{ max((int) round(($day['total'] / $maxWeeklyRevenue) * 100), 3) }}%"></div>
                                    <span class="text-xs text-muted">{{ ucfirst($day['label']) }}</span>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-sm text-muted py-10 text-center">
                            Pas encore de chiffre d'affaires enregistré cette semaine.
                        </p>
                    @endif
                </div>

                <!-- Derniers paiements -->
                <div class="bg-surface border border-border rounded-xl p-4 shadow-sm">
                    <h2 class="text-base font-semibold text-ink mb-4">Derniers paiements</h2>

                    @forelse ($recentPayments as $payment)
                        <div class="flex items-center justify-between py-3 {{ !$loop->last ? 'border-b border-border' : '' }}">
                            <div>
                                <div class="text-sm font-semibold text-ink">{{ $payment->client->full_name ?? 'Client supprimé' }}</div>
                                <div class="text-xs text-muted capitalize">{{ str_replace('_', ' ', $payment->method) }}</div>
                            </div>
                            <div class="text-right">
                                <div class="text-sm font-bold text-ink">{{ number_format($payment->amount, 0, ',', ' ') }} FCFA</div>
                                <div class="text-xs text-muted">{{ $payment->paid_at->format('H:i') }}</div>
                            </div>
                        </div>
                    @empty
                        <p class="text-sm text-muted py-6 text-center">
                            Aucun paiement enregistré pour l'instant.
                        </p>
                    @endforelse
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
