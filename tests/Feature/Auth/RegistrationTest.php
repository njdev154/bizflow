<?php

namespace Tests\Feature\Auth;

use App\Models\Organization;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_screen_can_be_rendered(): void
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }

    public function test_new_users_can_register(): void
    {
        $response = $this->post('/register', [
            'company_name' => 'Salon Bella',
            'sector' => 'Salon de coiffure',
            'phone' => '0712345678',
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(route('dashboard', absolute: false));
    }

    public function test_registration_creates_an_organization_and_owner_membership(): void
    {
        $this->post('/register', [
            'company_name' => 'Salon Bella',
            'sector' => 'Salon de coiffure',
            'phone' => '0712345678',
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $organization = Organization::where('name', 'Salon Bella')->first();

        $this->assertNotNull($organization);
        $this->assertEquals('owner', $organization->memberships()->first()->role);
    }

    public function test_registration_requires_a_company_name(): void
    {
        $response = $this->post('/register', [
            'sector' => 'Salon de coiffure',
            'phone' => '0712345678',
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response->assertSessionHasErrors('company_name');
        $this->assertGuest();
    }
}
