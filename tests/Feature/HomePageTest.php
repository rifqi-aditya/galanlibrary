<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class HomePageTest extends TestCase
{
    use RefreshDatabase;

    public function test_load_root_page()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    public function test_redirect_if_not_logged_in()
    {
        $response = $this->get(route('home.index'));
        $response->assertStatus(302);
    }

    public function test_access_home_page_after_login()
    {
        $user = User::create(
            [
                'email' => 'admin@gmail.com',
                'name' => 'Administrator',
                'email_verified_at' => now(),
                'password' => Hash::make('password')
            ]
        );

        $response = $this->actingAs($user)->get(route('home.index'));

        $response->assertStatus(200);
    }

    public function test_home_page_showing_right_view()
    {
        $this->refreshDatabase();
        $this->seed();

        $admin = User::create(
            [
                'email' => 'adminuser@gmail.com',
                'name' => 'Administrator',
                'email_verified_at' => now(),
                'password' => Hash::make('password')
            ]
        );

        $admin->assignRole('administrator');

        $member = User::create(
            [
                'email' => 'memberuser@gmail.com',
                'name' => 'Member',
                'email_verified_at' => now(),
                'password' => Hash::make('password')
            ]
        );

        $member->assignRole('member');

        $responseAdmin = $this->actingAs($admin)->get(route('home.index'));
        $responseAdmin->assertSee('Statistik Perpustakaan');

        $responseMember = $this->actingAs($member)->get(route('home.index'));
        $responseMember->assertSee('Halo, ' . $member->name);
        $responseMember->assertSee('Mau baca buku apa hari ini?');
    }
}
