<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class ReportController extends Controller
{
    public function index(Request $request): View
    {
        $organization = $request->user()->currentOrganization();

        $period = $request->query('period', '7d');
        [$start, $end, $label] = match ($period) {
            '30d' => [now()->subDays(29)->startOfDay(), now()->endOfDay(), '30 derniers jours'],
            'month' => [now()->startOfMonth(), now()->endOfMonth(), 'ce mois-ci'],
            default => [now()->subDays(6)->startOfDay(), now()->endOfDay(), '7 derniers jours'],
        };

        $payments = $organization
            ? $organization->payments()->whereBetween('paid_at', [$start, $end])->where('status', 'enregistre')->get()
            : collect();

        $totalRevenue = (float) $payments->sum('amount');

        $methodLabels = ['especes' => 'Espèces', 'mobile_money' => 'Mobile Money', 'carte' => 'Carte', 'autre' => 'Autre'];
        $methodColors = ['especes' => 'bg-primary', 'mobile_money' => 'bg-accent', 'carte' => 'bg-success', 'autre' => 'bg-muted'];

        $byMethod = collect($methodLabels)->map(function ($label, $key) use ($payments, $totalRevenue, $methodColors) {
            $sum = (float) $payments->where('method', $key)->sum('amount');
            return [
                'label' => $label,
                'sum' => $sum,
                'percent' => $totalRevenue > 0 ? round(($sum / $totalRevenue) * 100) : 0,
                'color' => $methodColors[$key],
            ];
        })->filter(fn ($row) => $row['sum'] > 0)->values();

        $appointments = $organization
            ? $organization->appointments()->whereBetween('scheduled_at', [$start, $end])->get()
            : collect();

        $statusLabels = ['planifie' => 'Planifié', 'confirme' => 'Confirmé', 'en_attente' => 'En attente', 'termine' => 'Terminé', 'annule' => 'Annulé', 'absent' => 'Absent'];
        $byStatus = collect($statusLabels)->map(fn ($label, $key) => [
            'label' => $label,
            'count' => $appointments->where('status', $key)->count(),
        ])->filter(fn ($row) => $row['count'] > 0)->values();

        $topServices = $organization
            ? $organization->appointments()
                ->whereBetween('scheduled_at', [$start, $end])
                ->where('status', '!=', 'annule')
                ->with('service')
                ->get()
                ->groupBy('service_id')
                ->map(fn ($group) => [
                    'name' => $group->first()->service->name ?? 'Service supprimé',
                    'count' => $group->count(),
                ])
                ->sortByDesc('count')
                ->take(5)
                ->values()
            : collect();

        return view('reports.index', [
            'period' => $period,
            'periodLabel' => $label,
            'totalRevenue' => $totalRevenue,
            'byMethod' => $byMethod,
            'byStatus' => $byStatus,
            'topServices' => $topServices,
            'appointmentsCount' => $appointments->count(),
        ]);
    }
}
