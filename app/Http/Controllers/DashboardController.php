<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(Request $request): View
    {
        $organization = $request->user()->currentOrganization();

        $appointmentsToday = $organization?->appointments()->whereDate('scheduled_at', today())->count() ?? 0;
        $appointmentsYesterday = $organization?->appointments()->whereDate('scheduled_at', today()->subDay())->count() ?? 0;

        $activeClients = $organization?->clients()->whereNull('archived_at')->count() ?? 0;

        $revenueToday = (float) ($organization?->payments()->whereDate('paid_at', today())->where('status', 'enregistre')->sum('amount') ?? 0);
        $revenueYesterday = (float) ($organization?->payments()->whereDate('paid_at', today()->subDay())->where('status', 'enregistre')->sum('amount') ?? 0);

        $stats = [
            'appointments_today' => [
                'value' => $appointmentsToday,
                'delta' => $this->percentChange($appointmentsToday, $appointmentsYesterday),
            ],
            'active_clients' => [
                'value' => $activeClients,
                'delta' => null, // pas de comparaison "hier" pertinente pour un total de clients
            ],
            'revenue_today' => [
                'value' => $revenueToday,
                'delta' => $this->percentChange($revenueToday, $revenueYesterday),
            ],
        ];

        $upcomingAppointments = $organization
            ? $organization->appointments()
                ->with(['client', 'service'])
                ->whereDate('scheduled_at', today())
                ->orderBy('scheduled_at')
                ->get()
            : collect();

        $recentPayments = $organization
            ? $organization->payments()
                ->with('client')
                ->latest('paid_at')
                ->take(5)
                ->get()
            : collect();

        $weeklyRevenue = collect();
        for ($i = 6; $i >= 0; $i--) {
            $day = today()->subDays($i);
            $total = (float) ($organization?->payments()
                ->whereDate('paid_at', $day)
                ->where('status', 'enregistre')
                ->sum('amount') ?? 0);

            $weeklyRevenue->push(['label' => $day->translatedFormat('D'), 'total' => $total]);
        }

        return view('dashboard', [
            'organization' => $organization,
            'stats' => $stats,
            'upcomingAppointments' => $upcomingAppointments,
            'recentPayments' => $recentPayments,
            'weeklyRevenue' => $weeklyRevenue,
            'maxWeeklyRevenue' => max($weeklyRevenue->max('total'), 1), // évite une division par zéro dans la vue
        ]);
    }

    /**
     * Calcule un pourcentage d'évolution. Retourne null si la comparaison
     * n'a pas de sens (valeur d'hier à zéro) plutôt que d'inventer un chiffre.
     */
    protected function percentChange(float $current, float $previous): ?int
    {
        if ($previous == 0.0) {
            return null;
        }

        return (int) round((($current - $previous) / $previous) * 100);
    }
}
