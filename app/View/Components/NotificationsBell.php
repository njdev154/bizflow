<?php

namespace App\View\Components;

use App\Models\Organization;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class NotificationsBell extends Component
{
    public Collection $alerts;

    public function __construct()
    {
        $organization = auth()->user()?->currentOrganization();
        $this->alerts = $this->buildAlerts($organization);
    }

    protected function buildAlerts(?Organization $organization): Collection
    {
        $alerts = collect();

        if (!$organization) {
            return $alerts;
        }

        $now = now();

        // Rendez-vous en retard (heure passée, mais toujours "planifié" ou "confirmé")
        $late = $organization->appointments()
            ->whereIn('status', ['planifie', 'confirme'])
            ->where('scheduled_at', '<', $now)
            ->where('scheduled_at', '>=', $now->copy()->subHours(6))
            ->with('client')
            ->orderBy('scheduled_at')
            ->get();

        foreach ($late as $appointment) {
            $alerts->push([
                'type' => 'danger',
                'message' => 'Rendez-vous en retard : '.($appointment->client->full_name ?? 'Client').' ('.$appointment->scheduled_at->format('H:i').')',
                'url' => route('appointments.index'),
            ]);
        }

        // Rendez-vous proches (dans les 30 prochaines minutes)
        $soon = $organization->appointments()
            ->whereIn('status', ['planifie', 'confirme'])
            ->whereBetween('scheduled_at', [$now, $now->copy()->addMinutes(30)])
            ->with('client')
            ->orderBy('scheduled_at')
            ->get();

        foreach ($soon as $appointment) {
            $alerts->push([
                'type' => 'warning',
                'message' => 'Rendez-vous à venir : '.($appointment->client->full_name ?? 'Client').' à '.$appointment->scheduled_at->format('H:i'),
                'url' => route('appointments.index'),
            ]);
        }

        // Configuration incomplète
        if ($organization->services()->count() === 0) {
            $alerts->push([
                'type' => 'info',
                'message' => 'Aucun service configuré — ajoutez votre premier service.',
                'url' => route('services.create'),
            ]);
        }

        if (blank($organization->phone)) {
            $alerts->push([
                'type' => 'info',
                'message' => "Le téléphone de l'entreprise n'est pas renseigné.",
                'url' => route('settings.edit'),
            ]);
        }

        return $alerts;
    }

    public function render()
    {
        return view('components.notifications-bell');
    }
}
