<?php

namespace Tests\Feature;

use App\Models\Membership;
use App\Models\Organization;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrganizationSettingsTest extends TestCase
{
    use RefreshDatabase;

    public function test_owner_can_view_organization_settings(): void
    {
        [$owner] = $this->createOrganizationOwner();

        $this->actingAs($owner)
            ->get(route('settings.edit'))
            ->assertOk()
            ->assertSee('Identité de l’entreprise')
            ->assertSee('Coordonnées')
            ->assertSee('Région et devise')
            ->assertSee('Journal d’activité');
    }

    public function test_owner_can_update_organization_settings(): void
    {
        [$owner, $organization] = $this->createOrganizationOwner();

        $response = $this->actingAs($owner)->put(route('settings.update'), [
            'name' => 'Salon Awa',
            'sector' => 'Salon de coiffure',
            'phone' => '0102030405',
            'email' => 'contact@example.com',
            'currency' => 'FCFA',
            'timezone' => 'Africa/Abidjan',
        ]);

        $response->assertRedirect(route('settings.edit'));
        $this->assertDatabaseHas('organizations', [
            'id' => $organization->id,
            'name' => 'Salon Awa',
            'phone' => '0102030405',
            'email' => 'contact@example.com',
        ]);
    }

    private function createOrganizationOwner(): array
    {
        $owner = User::factory()->create();
        $organization = Organization::create([
            'name' => 'Salon Test',
            'slug' => 'salon-test',
            'sector' => 'Salon de coiffure',
        ]);

        Membership::create([
            'user_id' => $owner->id,
            'organization_id' => $organization->id,
            'role' => 'owner',
        ]);

        return [$owner, $organization];
    }
}
