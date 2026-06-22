<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthAndProfileTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guests_can_view_login_page()
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
        $response->assertViewIs('auth.login');
    }

    /** @test */
    public function guests_can_view_register_page()
    {
        $response = $this->get('/register');
        $response->assertStatus(200);
        $response->assertViewIs('auth.register');
    }

    /** @test */
    public function guests_can_register()
    {
        $response = $this->post('/register', [
            'name' => 'John Doe',
            'username' => 'johndoe',
            'email' => 'john@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertRedirect('/feed');
        $this->assertDatabaseHas('users', [
            'name' => 'John Doe',
            'username' => 'johndoe',
            'email' => 'john@example.com',
        ]);

        $user = User::where('email', 'john@example.com')->first();
        $this->assertNotNull($user);
        $this->assertTrue(Hash::check('password123', $user->password));

        // Assert session has user_id
        $this->assertEquals($user->id, session('user_id'));
    }

    /** @test */
    public function guests_cannot_register_with_existing_username()
    {
        User::create([
            'name' => 'Existing User',
            'username' => 'existing',
            'email' => 'existing@example.com',
            'password' => Hash::make('password123'),
        ]);

        $response = $this->post('/register', [
            'name' => 'Another User',
            'username' => 'existing',
            'email' => 'another@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertSessionHasErrors('username');
    }

    /** @test */
    public function guests_can_login_with_valid_credentials()
    {
        $user = User::create([
            'name' => 'Test User',
            'username' => 'testuser',
            'email' => 'test@example.com',
            'password' => Hash::driver('argon2id')->make('password123'),
        ]);

        // Login using email
        $response = $this->post('/login', [
            'login' => 'test@example.com',
            'password' => 'password123',
        ]);

        $response->assertRedirect('/feed');
        $this->assertEquals($user->id, session('user_id'));

        // Reset session
        session()->forget('user_id');

        // Login using username
        $response = $this->post('/login', [
            'login' => 'testuser',
            'password' => 'password123',
        ]);

        $response->assertRedirect('/feed');
        $this->assertEquals($user->id, session('user_id'));
    }

    /** @test */
    public function guests_cannot_login_with_invalid_credentials()
    {
        User::create([
            'name' => 'Test User',
            'username' => 'testuser',
            'email' => 'test@example.com',
            'password' => Hash::make('password123'),
        ]);

        $response = $this->post('/login', [
            'login' => 'test@example.com',
            'password' => 'wrongpassword',
        ]);

        $response->assertSessionHas('error');
        $this->assertNull(session('user_id'));
    }

    /** @test */
    public function logged_in_users_can_logout()
    {
        $user = User::create([
            'name' => 'Test User',
            'username' => 'testuser',
            'email' => 'test@example.com',
            'password' => Hash::make('password123'),
        ]);

        $response = $this->withSession(['user_id' => $user->id])
                         ->post('/logout');

        $response->assertRedirect('/');
        $this->assertNull(session('user_id'));
    }

    /** @test */
    public function guest_cannot_access_profile_edit()
    {
        $response = $this->get('/profile/edit');
        $response->assertRedirect('/login');
    }

    /** @test */
    public function logged_in_users_can_access_profile_edit()
    {
        $user = User::create([
            'name' => 'Test User',
            'username' => 'testuser',
            'email' => 'test@example.com',
            'password' => Hash::make('password123'),
        ]);

        $response = $this->withSession(['user_id' => $user->id])
                         ->get('/profile/edit');

        $response->assertStatus(200);
        $response->assertViewIs('profile.edit');
    }

    /** @test */
    public function users_can_update_profile()
    {
        $user = User::create([
            'name' => 'Old Name',
            'username' => 'oldusername',
            'email' => 'old@example.com',
            'password' => Hash::driver('argon2id')->make('oldpassword'),
        ]);

        $response = $this->withSession(['user_id' => $user->id])
                         ->put('/profile', [
                             'name' => 'New Name',
                             'username' => 'newusername',
                             'email' => 'new@example.com',
                             'bio' => 'New bio description',
                         ]);

        $response->assertRedirect('/profile/edit');
        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => 'New Name',
            'username' => 'newusername',
            'email' => 'new@example.com',
            'bio' => 'New bio description',
        ]);
    }

    /** @test */
    public function logged_in_users_can_view_profile_dashboard()
    {
        $user = User::create([
            'name' => 'Test User',
            'username' => 'testuser',
            'email' => 'test@example.com',
            'password' => Hash::make('password123'),
        ]);

        $response = $this->withSession(['user_id' => $user->id])
                         ->get('/profile');

        $response->assertStatus(200);
        $response->assertViewIs('profile.show');
        $response->assertSee('testuser');
        $response->assertSee('Kiriman');
        $response->assertSee('Koleksi');
        $response->assertSee('Suka');
    }

    /** @test */
    public function guests_can_access_feed_and_public_profiles_without_login()
    {
        $user = User::create([
            'name' => 'Public User',
            'username' => 'publicuser',
            'email' => 'public@example.com',
            'password' => Hash::make('password123'),
        ]);

        // Guests can access feed page
        $feedResponse = $this->get('/feed');
        $feedResponse->assertStatus(200);

        // Guests can access specific profile page
        $profileResponse = $this->get('/profile/' . $user->id);
        $profileResponse->assertStatus(200);
        $profileResponse->assertSee('publicuser');

        // Guests accessing generic /profile get redirected to login page
        $genericProfileResponse = $this->get('/profile');
        $genericProfileResponse->assertRedirect('/login');
    }
}
