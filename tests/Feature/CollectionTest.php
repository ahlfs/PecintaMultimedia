<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class CollectionTest extends TestCase
{
    use RefreshDatabase;

    private $user;
    private $otherUser;

    protected function setUp(): void
    {
        parent::setUp();

        // Buat user utama untuk testing
        $this->user = User::create([
            'name' => 'Owner User',
            'username' => 'owneruser',
            'email' => 'owner@example.com',
            'password' => Hash::make('password123'),
        ]);

        // Buat user lain
        $this->otherUser = User::create([
            'name' => 'Other User',
            'username' => 'otheruser',
            'email' => 'other@example.com',
            'password' => Hash::make('password123'),
        ]);
    }

    /** @test */
    public function guests_cannot_access_collections_index()
    {
        $response = $this->get('/collections');
        $response->assertRedirect('/login');
    }

    /** @test */
    public function guests_cannot_access_collections_create()
    {
        $response = $this->get('/collections/create');
        $response->assertRedirect('/login');
    }

    /** @test */
    public function authenticated_users_can_view_collections_index()
    {
        $response = $this->withSession(['user_id' => $this->user->id])
                         ->get('/collections');

        $response->assertStatus(200);
        $response->assertViewIs('collections.index');
    }

    /** @test */
    public function authenticated_users_can_view_collections_create()
    {
        $response = $this->withSession(['user_id' => $this->user->id])
                         ->get('/collections/create');

        $response->assertStatus(200);
        $response->assertViewIs('collections.create');
    }

    /** @test */
    public function users_can_create_collections()
    {
        $response = $this->withSession(['user_id' => $this->user->id])
                         ->post('/collections', [
                             'name' => 'My New Folder',
                             'description' => 'A folder for memes',
                             'is_private' => '1',
                         ]);

        $response->assertRedirect('/collections');
        $this->assertDatabaseHas('collections', [
            'user_id' => $this->user->id,
            'name' => 'My New Folder',
            'description' => 'A folder for memes',
            'is_private' => 1,
        ]);
    }

    /** @test */
    public function collections_creation_requires_name()
    {
        $response = $this->withSession(['user_id' => $this->user->id])
                         ->post('/collections', [
                             'description' => 'A folder for memes',
                         ]);

        $response->assertSessionHasErrors('name');
    }

    /** @test */
    public function owner_can_view_their_private_collection()
    {
        $collection = Collection::create([
            'user_id' => $this->user->id,
            'name' => 'My Private Collection',
            'is_private' => true,
        ]);

        $response = $this->withSession(['user_id' => $this->user->id])
                         ->get('/collections/' . $collection->id);

        $response->assertStatus(200);
        $response->assertViewIs('collections.show');
    }

    /** @test */
    public function other_users_cannot_view_owners_private_collection()
    {
        $collection = Collection::create([
            'user_id' => $this->user->id,
            'name' => 'My Private Collection',
            'is_private' => true,
        ]);

        $response = $this->withSession(['user_id' => $this->otherUser->id])
                         ->get('/collections/' . $collection->id);

        $response->assertStatus(403);
    }

    /** @test */
    public function anyone_can_view_public_collection()
    {
        $collection = Collection::create([
            'user_id' => $this->user->id,
            'name' => 'My Public Collection',
            'is_private' => false,
        ]);

        // Owner can view
        $response1 = $this->withSession(['user_id' => $this->user->id])
                          ->get('/collections/' . $collection->id);
        $response1->assertStatus(200);

        // Other user can view
        $response2 = $this->withSession(['user_id' => $this->otherUser->id])
                          ->get('/collections/' . $collection->id);
        $response2->assertStatus(200);
    }

    /** @test */
    public function owner_can_edit_their_collection()
    {
        $collection = Collection::create([
            'user_id' => $this->user->id,
            'name' => 'Old Name',
        ]);

        $response = $this->withSession(['user_id' => $this->user->id])
                         ->get('/collections/' . $collection->id . '/edit');

        $response->assertStatus(200);
        $response->assertViewIs('collections.edit');
    }

    /** @test */
    public function other_users_cannot_edit_owners_collection()
    {
        $collection = Collection::create([
            'user_id' => $this->user->id,
            'name' => 'Old Name',
        ]);

        $response = $this->withSession(['user_id' => $this->otherUser->id])
                         ->get('/collections/' . $collection->id . '/edit');

        $response->assertStatus(403);
    }

    /** @test */
    public function owner_can_update_their_collection()
    {
        $collection = Collection::create([
            'user_id' => $this->user->id,
            'name' => 'Old Name',
            'description' => 'Old description',
            'is_private' => false,
        ]);

        $response = $this->withSession(['user_id' => $this->user->id])
                         ->put('/collections/' . $collection->id, [
                             'name' => 'New Name',
                             'description' => 'New description',
                             'is_private' => '1',
                         ]);

        $response->assertRedirect('/collections');
        $this->assertDatabaseHas('collections', [
            'id' => $collection->id,
            'name' => 'New Name',
            'description' => 'New description',
            'is_private' => 1,
        ]);
    }

    /** @test */
    public function owner_can_delete_their_collection()
    {
        $collection = Collection::create([
            'user_id' => $this->user->id,
            'name' => 'Delete Me',
        ]);

        $response = $this->withSession(['user_id' => $this->user->id])
                         ->delete('/collections/' . $collection->id);

        $response->assertRedirect('/collections');
        $this->assertDatabaseMissing('collections', [
            'id' => $collection->id,
        ]);
    }

    /** @test */
    public function other_users_cannot_delete_owners_collection()
    {
        $collection = Collection::create([
            'user_id' => $this->user->id,
            'name' => 'Delete Me',
        ]);

        $response = $this->withSession(['user_id' => $this->otherUser->id])
                         ->delete('/collections/' . $collection->id);

        $response->assertStatus(403);
        $this->assertDatabaseHas('collections', [
            'id' => $collection->id,
        ]);
    }
}
