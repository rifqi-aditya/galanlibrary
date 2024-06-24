<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_load_login_page()
    {
        $response = $this->get(route('login'));
        $response->assertStatus(200);
        $response->assertSee('Login');
    }

    public function test_created_user_can_login()
    {
        $user = User::create(
            [
                'email' => 'admin@gmail.com',
                'name' => 'Administrator',
                'email_verified_at' => now(),
                'password' => Hash::make('password')
            ]
        );

        $this->post(route('login'), [
            'email' => $user->email,
            'password' => $user->password,
        ])->assertRedirect('/');
    }
}
