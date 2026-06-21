<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Post;
use App\Models\Like;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Livewire\Livewire;
use App\Livewire\HomeFeed;
use App\Livewire\LikeButton;
use Illuminate\Support\Facades\Hash;

class LivewireFeedTest extends TestCase
{
    use RefreshDatabase;

    private $user;
    private $posts;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::create([
            'name' => 'Test User',
            'username' => 'testuser',
            'email' => 'test@example.com',
            'password' => Hash::make('password123'),
        ]);

        // Create some sample posts
        $this->posts = collect([
            Post::create([
                'user_id' => $this->user->id,
                'title' => 'Programmer Meme 1',
                'description' => 'First funny coding meme',
                'image_path' => 'uploads/memes/test1.jpg',
            ]),
            Post::create([
                'user_id' => $this->user->id,
                'title' => 'UI UX Inspiration 2',
                'description' => 'Beautiful landing page',
                'image_path' => 'uploads/memes/test2.jpg',
            ]),
            Post::create([
                'user_id' => $this->user->id,
                'title' => 'Code Debugging Joke 3',
                'description' => 'Stuck on semi-colon',
                'image_path' => 'uploads/memes/test3.jpg',
            ]),
        ]);
    }

    /** @test */
    public function home_feed_renders_successfully()
    {
        $response = $this->withSession(['user_id' => $this->user->id])
            ->get('/feed');

        $response->assertStatus(200);
        $response->assertSeeLivewire(HomeFeed::class);
    }

    /** @test */
    public function home_feed_shows_all_posts()
    {
        Livewire::test(HomeFeed::class)
            ->assertSee('Programmer Meme 1')
            ->assertSee('UI UX Inspiration 2')
            ->assertSee('Code Debugging Joke 3');
    }

    /** @test */
    public function home_feed_filters_posts_by_search()
    {
        Livewire::test(HomeFeed::class)
            ->set('search', 'Programmer')
            ->assertSee('Programmer Meme 1')
            ->assertDontSee('UI UX Inspiration 2');

        Livewire::test(HomeFeed::class)
            ->set('search', 'UI UX')
            ->assertSee('UI UX Inspiration 2')
            ->assertDontSee('Programmer Meme 1');
    }

    /** @test */
    public function like_button_toggles_correctly()
    {
        $post = $this->posts->first();

        // 1. Initial state without auth
        Livewire::test(LikeButton::class, ['post' => $post])
            ->assertSee('0 Suka')
            ->assertSet('isLiked', false);

        // 2. State with auth - like the post
        session(['user_id' => $this->user->id]);

        $component = Livewire::test(LikeButton::class, ['post' => $post])
            ->assertSee('0 Suka')
            ->call('toggleLike')
            ->assertSee('1 Suka')
            ->assertSet('isLiked', true);

        $this->assertDatabaseHas('likes', [
            'user_id' => $this->user->id,
            'post_id' => $post->id,
        ]);

        // 3. Unlike the post
        $component->call('toggleLike')
            ->assertSee('0 Suka')
            ->assertSet('isLiked', false);

        $this->assertDatabaseMissing('likes', [
            'user_id' => $this->user->id,
            'post_id' => $post->id,
        ]);
    }
}
