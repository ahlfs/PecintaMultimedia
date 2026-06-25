<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Comment;
use App\Models\Post;

class CommentsSection extends Component
{
    public Post $post;
    public string $newComment = '';

    public function mount(Post $post): void
    {
        $this->post = $post;
    }

    public function addComment(): void
    {
        $userId = session('user_id');

        if (!$userId) {
            $this->dispatch('notify-error', message: 'Silakan masuk terlebih dahulu untuk berkomentar.');
            return;
        }

        $this->validate([
            'newComment' => 'required|string|min:1|max:1000',
        ], [
            'newComment.required' => 'Komentar tidak boleh kosong.',
            'newComment.max'      => 'Komentar maksimal 1000 karakter.',
        ]);

        Comment::create([
            'user_id' => $userId,
            'post_id' => $this->post->id,
            'body'    => trim($this->newComment),
        ]);

        $this->newComment = '';
        $this->dispatch('notify-success', message: 'Komentar berhasil ditambahkan!');
    }

    public function deleteComment(int $commentId): void
    {
        $userId = session('user_id');

        if (!$userId) {
            return;
        }

        $comment = Comment::find($commentId);

        if ($comment && ($comment->user_id == $userId || $this->post->user_id == $userId)) {
            $comment->delete();
            $this->dispatch('notify-success', message: 'Komentar dihapus.');
        }
    }

    public function render()
    {
        $comments = $this->post
            ->comments()
            ->with('user')
            ->latest()
            ->get();

        return view('livewire.comments-section', [
            'comments' => $comments,
        ]);
    }
}
