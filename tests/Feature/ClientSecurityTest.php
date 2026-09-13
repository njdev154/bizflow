<?php

namespace Tests\Feature;

use App\Models\Client;
use App\Models\Membership;
use App\Models\Organization;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ClientSecurityTest extends TestCase
{
    use RefreshDatabase;

    protected function createOwnerWithOrganization(string $organizationName): array
    {
        $user = User::factory()->create();
        $organization = Organization::create(['name' => $organizationName, 'slug' => str($organizationName)->slug()]);
        Membership::create(['user_id' => $user->id, 'organization_id' => $organization->id, 'role' => 'owner']);

        return [$user, $organization];
    }

    public function test_user_cannot_edit_a_client_belonging_to_another_organization(): void
    {
        [$userA, $orgA] = $this->createOwnerWithOrganization('Salon A');
        [, $orgB] = $this->createOwnerWithOrganization('Salon B');

        $clientOfB = Client::create(['organization_id' => $orgB->id, 'full_name' => 'Client de B']);

        $response = $this->actingAs($userA)->get(route('clients.edit', $clientOfB));

        $response->assertForbidden();
    }

    public function test_user_can_edit_a_client_belonging_to_their_own_organization(): void
    {
        [$user, $organization] = $this->createOwnerWithOrganization('Salon A');

        $client = Client::create(['organization_id' => $organization->id, 'full_name' => 'Mon client']);

        $response = $this->actingAs($user)->get(route('clients.edit', $client));

        $response->assertOk();
    }
}
