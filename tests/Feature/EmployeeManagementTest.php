<?php

namespace Tests\Feature;

use App\Models\Membership;
use App\Models\Organization;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EmployeeManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_owner_can_view_members_in_role_order(): void
    {
        $owner = User::factory()->create(['name' => 'Awa Owner']);
        $manager = User::factory()->create(['name' => 'Binta Manager']);
        $employee = User::factory()->create(['name' => 'Coulibaly Employee']);
        $organization = Organization::create([
            'name' => 'Salon Test',
            'slug' => 'salon-test',
        ]);

        Membership::create([
            'user_id' => $owner->id,
            'organization_id' => $organization->id,
            'role' => 'owner',
        ]);
        Membership::create([
            'user_id' => $manager->id,
            'organization_id' => $organization->id,
            'role' => 'manager',
        ]);
        Membership::create([
            'user_id' => $employee->id,
            'organization_id' => $organization->id,
            'role' => 'employee',
        ]);

        $response = $this->actingAs($owner)->get(route('employees.index'));

        $response->assertOk()
            ->assertSeeInOrder(['Awa Owner', 'Binta Manager', 'Coulibaly Employee']);
    }
}
