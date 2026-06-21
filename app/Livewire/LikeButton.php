<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Post;
use App\Models\Like;

class LikeButton extends Component
{
    public Post $post;
    public $isLiked = false;
    public $likesCount = 0;

    public function mount(Post $post)
    {
        $this->post = $post;
        $this->likesCount = $post->likes()->count();
        
        $userId = session('user_id');
        if ($userId) {
            $this->isLiked = Like::where('user_id', $userId)
                ->where('post_id', $post->id)
                ->exists();
        }
    }

    public function toggleLike()
    {
        $userId = session('user_id');
        
        if (!$userId) {
            return redirect()->route('login')->with('error', 'Silakan masuk terlebih dahulu.');
        }

        $like = Like::where('user_id', $userId)
            ->where('post_id', $this->post->id)
            ->first();

        if ($like) {
            $like->delete();
            $this->isLiked = false;
            $this->likesCount--;
        } else {
            Like::create([
                'user_id' => $userId,
                'post_id' => $this->post->id,
            ]);
            $this->isLiked = true;
            $this->likesCount++;
        }
    }

    public function render()
    {
        return view('livewire.like-button');
    }
}
