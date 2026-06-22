<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Post;
use App\Models\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    private $user;
    private $otherUser;

    protected function setUp(): void
    {
        parent::setUp();

        // Buat user utama untuk testing
        $this->user = User::create([
            'name' => 'Post Owner',
            'username' => 'postowner',
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

        // Pastikan folder uploads/memes ada
        if (!File::isDirectory(public_path('uploads/memes'))) {
            File::makeDirectory(public_path('uploads/memes'), 0755, true);
        }
    }

    protected function tearDown(): void
    {
        // Bersihkan file testing di public/uploads/memes
        $files = File::files(public_path('uploads/memes'));
        foreach ($files as $file) {
            if (str_contains($file->getFilename(), 'test_')) {
                File::delete($file->getPathname());
            }
        }

        parent::tearDown();
    }

    /** @test */
    public function guests_cannot_access_posts_create()
    {
        $response = $this->get('/posts/create');
        $response->assertRedirect('/login');
    }

    /** @test */
    public function authenticated_users_can_view_posts_create()
    {
        $response = $this->withSession(['user_id' => $this->user->id])
                         ->get('/posts/create');

        $response->assertStatus(200);
        $response->assertViewIs('posts.create');
    }

    /** @test */
    public function users_can_create_posts()
    {
        $collection = Collection::create([
            'user_id' => $this->user->id,
            'name' => 'My Collection',
        ]);

        $image = UploadedFile::fake()->image('test_meme.jpg');

        $response = $this->withSession(['user_id' => $this->user->id])
                         ->post('/posts', [
                             'title' => 'My First Meme',
                             'description' => 'Hilarious programmer joke',
                             'image' => $image,
                             'collection_ids' => [$collection->id],
                         ]);

        $response->assertRedirect('/feed');

        $this->assertDatabaseHas('posts', [
            'user_id' => $this->user->id,
            'title' => 'My First Meme',
            'description' => 'Hilarious programmer joke',
        ]);

        $post = Post::where('title', 'My First Meme')->first();
        $this->assertNotNull($post);
        $this->assertFileExists(public_path($post->image_path));
        $this->assertTrue($post->collections->contains($collection->id));

        // Cleanup
        if (File::exists(public_path($post->image_path))) {
            File::delete(public_path($post->image_path));
        }
    }

    /** @test */
    public function post_creation_requires_title_and_image()
    {
        $response = $this->withSession(['user_id' => $this->user->id])
                         ->post('/posts', [
                             'description' => 'Hilarious programmer joke',
                         ]);

        $response->assertSessionHasErrors(['title', 'image']);
    }

    /** @test */
    public function anyone_can_view_post_detail()
    {
        $post = Post::create([
            'user_id' => $this->user->id,
            'title' => 'A Meme Title',
            'description' => 'Description of the meme',
            'image_path' => 'uploads/memes/test_dummy.jpg',
        ]);

        $response = $this->withSession(['user_id' => $this->otherUser->id])
                         ->get('/posts/' . $post->slug);

        $response->assertStatus(200);
        $response->assertViewIs('posts.show');
    }

    /** @test */
    public function owner_can_edit_their_post()
    {
        $post = Post::create([
            'user_id' => $this->user->id,
            'title' => 'A Meme Title',
            'image_path' => 'uploads/memes/test_dummy.jpg',
        ]);

        $response = $this->withSession(['user_id' => $this->user->id])
                         ->get('/posts/' . $post->slug . '/edit');

        $response->assertStatus(200);
        $response->assertViewIs('posts.edit');
    }

    /** @test */
    public function other_users_cannot_edit_owners_post()
    {
        $post = Post::create([
            'user_id' => $this->user->id,
            'title' => 'A Meme Title',
            'image_path' => 'uploads/memes/test_dummy.jpg',
        ]);

        $response = $this->withSession(['user_id' => $this->otherUser->id])
                         ->get('/posts/' . $post->slug . '/edit');

        $response->assertStatus(403);
    }

    /** @test */
    public function owner_can_update_their_post_without_new_image()
    {
        $collection = Collection::create([
            'user_id' => $this->user->id,
            'name' => 'My Collection',
        ]);

        $post = Post::create([
            'user_id' => $this->user->id,
            'title' => 'Old Title',
            'description' => 'Old Description',
            'image_path' => 'uploads/memes/test_dummy.jpg',
        ]);

        $response = $this->withSession(['user_id' => $this->user->id])
                         ->put('/posts/' . $post->slug, [
                             'title' => 'New Title',
                             'description' => 'New Description',
                             'collection_ids' => [$collection->id],
                         ]);

        $response->assertRedirect('/feed');
        $this->assertDatabaseHas('posts', [
            'id' => $post->id,
            'title' => 'New Title',
            'description' => 'New Description',
            'image_path' => 'uploads/memes/test_dummy.jpg',
        ]);

        $this->assertTrue($post->fresh()->collections->contains($collection->id));
    }

    /** @test */
    public function owner_can_update_their_post_with_new_image()
    {
        // 1. Buat file dummy lama
        $oldFilePath = public_path('uploads/memes/test_old.jpg');
        File::put($oldFilePath, 'old image content');

        $post = Post::create([
            'user_id' => $this->user->id,
            'title' => 'Old Title',
            'image_path' => 'uploads/memes/test_old.jpg',
        ]);

        $newImage = UploadedFile::fake()->image('test_new.jpg');

        $response = $this->withSession(['user_id' => $this->user->id])
                         ->put('/posts/' . $post->slug, [
                             'title' => 'New Title',
                             'image' => $newImage,
                         ]);

        $response->assertRedirect('/feed');
        $post = $post->fresh();

        $this->assertEquals('New Title', $post->title);
        $this->assertFileDoesNotExist($oldFilePath);
        $this->assertFileExists(public_path($post->image_path));

        // Cleanup
        if (File::exists(public_path($post->image_path))) {
            File::delete(public_path($post->image_path));
        }
    }

    /** @test */
    public function owner_can_delete_their_post()
    {
        // 1. Buat file dummy
        $filePath = public_path('uploads/memes/test_delete.jpg');
        File::put($filePath, 'dummy content');

        $post = Post::create([
            'user_id' => $this->user->id,
            'title' => 'Delete Me',
            'image_path' => 'uploads/memes/test_delete.jpg',
        ]);

        $response = $this->withSession(['user_id' => $this->user->id])
                         ->delete('/posts/' . $post->slug);

        $response->assertRedirect('/feed');
        $this->assertDatabaseMissing('posts', [
            'id' => $post->id,
        ]);
        $this->assertFileDoesNotExist($filePath);
    }

    /** @test */
    public function other_users_cannot_delete_owners_post()
    {
        $post = Post::create([
            'user_id' => $this->user->id,
            'title' => 'Delete Me',
            'image_path' => 'uploads/memes/test_dummy.jpg',
        ]);

        $response = $this->withSession(['user_id' => $this->otherUser->id])
                         ->delete('/posts/' . $post->slug);

        $response->assertStatus(403);
        $this->assertDatabaseHas('posts', [
            'id' => $post->id,
        ]);
    }

    /** @test */
    public function users_can_save_post_to_their_collections()
    {
        // Post milik other user
        $post = Post::create([
            'user_id' => $this->otherUser->id,
            'title' => 'Funny Cat',
            'image_path' => 'uploads/memes/test_dummy.jpg',
        ]);

        // Koleksi milik main user
        $collection1 = Collection::create([
            'user_id' => $this->user->id,
            'name' => 'Cats Folder',
        ]);
        $collection2 = Collection::create([
            'user_id' => $this->user->id,
            'name' => 'Faves Folder',
        ]);

        // Kirim request untuk menyimpan post ke collection1 dan collection2
        $response = $this->withSession(['user_id' => $this->user->id])
                         ->post('/posts/' . $post->slug . '/save', [
                             'collection_ids' => [$collection1->id, $collection2->id],
                         ]);

        $response->assertRedirect('/posts/' . $post->slug);
        
        $this->assertTrue($collection1->fresh()->posts->contains($post->id));
        $this->assertTrue($collection2->fresh()->posts->contains($post->id));
    }
}
