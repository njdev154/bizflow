<?php

namespace Tests\Feature;

use App\Models\Client;
use App\Models\Membership;
use App\Models\Organization;
use App\Models\Service;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PaymentSecurityTest extends TestCase
{
    use RefreshDatabase;

    public function test_cannot_record_two_payments_for_the_same_appointment(): void
    {
        $user = User::factory()->create();
        $organization = Organization::create(['name' => 'Salon Test', 'slug' => 'salon-test']);
        Membership::create(['user_id' => $user->id, 'organization_id' => $organization->id, 'role' => 'owner']);
        $client = Client::create(['organization_id' => $organization->id, 'full_name' => 'Awa Koné']);
        $service = Service::create(['organization_id' => $organization->id, 'name' => 'Coupe femme', 'duration_minutes' => 45, 'price' => 15000]);

        $appointment = $organization->appointments()->create([
            'client_id' => $client->id,
            'service_id' => $service->id,
            'scheduled_at' => now(),
            'duration_minutes' => 45,
            'status' => 'termine',
        ]);

        // Premier paiement : doit réussir
        $this->actingAs($user)->post(route('payments.store'), [
            'appointment_id' => $appointment->id,
            'client_id' => $client->id,
            'amount' => 15000,
            'method' => 'especes',
            'paid_at' => now(),
        ]);

        // Deuxième paiement sur le même rendez-vous : doit échouer
        $response = $this->actingAs($user)->post(route('payments.store'), [
            'appointment_id' => $appointment->id,
            'client_id' => $client->id,
            'amount' => 15000,
            'method' => 'especes',
            'paid_at' => now(),
        ]);

        $response->assertSessionHasErrors('appointment_id');
        $this->assertEquals(1, $organization->payments()->count());
    }
}
