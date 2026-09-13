<?php

namespace Tests\Feature;

use App\Models\Client;
use App\Models\Membership;
use App\Models\Organization;
use App\Models\Service;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AppointmentConflictTest extends TestCase
{
    use RefreshDatabase;

    protected function setUpOrganization(): array
    {
        $user = User::factory()->create();
        $organization = Organization::create(['name' => 'Salon Test', 'slug' => 'salon-test']);
        Membership::create(['user_id' => $user->id, 'organization_id' => $organization->id, 'role' => 'owner']);
        $client = Client::create(['organization_id' => $organization->id, 'full_name' => 'Awa Koné']);
        $service = Service::create(['organization_id' => $organization->id, 'name' => 'Coupe femme', 'duration_minutes' => 45, 'price' => 15000]);

        return [$user, $organization, $client, $service];
    }

    public function test_an_overlapping_appointment_is_rejected(): void
    {
        [$user, $organization, $client, $service] = $this->setUpOrganization();

        $organization->appointments()->create([
            'client_id' => $client->id,
            'service_id' => $service->id,
            'scheduled_at' => '2026-09-17 09:00:00',
            'duration_minutes' => 45,
            'status' => 'confirme',
        ]);

        // Un deuxième rendez-vous qui commence à 9h20, alors que le premier finit à 9h45
        $response = $this->actingAs($user)->post(route('appointments.store'), [
            'client_id' => $client->id,
            'service_id' => $service->id,
            'scheduled_at' => '2026-09-17 09:20:00',
        ]);

        $response->assertSessionHasErrors('scheduled_at');
        $this->assertEquals(1, $organization->appointments()->count());
    }

    public function test_a_non_overlapping_appointment_is_accepted(): void
    {
        [$user, $organization, $client, $service] = $this->setUpOrganization();

        $organization->appointments()->create([
            'client_id' => $client->id,
            'service_id' => $service->id,
            'scheduled_at' => '2026-09-17 09:00:00',
            'duration_minutes' => 45,
            'status' => 'confirme',
        ]);

        // Un deuxième rendez-vous à 10h00, bien après la fin du premier (9h45)
        $response = $this->actingAs($user)->post(route('appointments.store'), [
            'client_id' => $client->id,
            'service_id' => $service->id,
            'scheduled_at' => '2026-09-17 10:00:00',
        ]);

        $response->assertRedirect(route('appointments.index'));
        $this->assertEquals(2, $organization->appointments()->count());
    }

    public function test_a_cancelled_appointment_does_not_block_the_same_slot(): void
    {
        [$user, $organization, $client, $service] = $this->setUpOrganization();

        $organization->appointments()->create([
            'client_id' => $client->id,
            'service_id' => $service->id,
            'scheduled_at' => '2026-09-17 09:00:00',
            'duration_minutes' => 45,
            'status' => 'annule',
        ]);

        $response = $this->actingAs($user)->post(route('appointments.store'), [
            'client_id' => $client->id,
            'service_id' => $service->id,
            'scheduled_at' => '2026-09-17 09:00:00',
        ]);

        $response->assertRedirect(route('appointments.index'));
    }
}
