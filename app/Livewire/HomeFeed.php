<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Post;
use Illuminate\Support\Facades\Cache;

class HomeFeed extends Component
{
    use WithPagination;

    public $search = '';

    protected $queryString = [
        'search' => ['except' => ''],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $page = $this->paginators['page'] ?? 1;
        $searchKey = trim($this->search);
        
        // Cache key includes search query and current page to keep pagination cached correctly
        $cacheKey = 'home_feed_' . md5($searchKey . '_page_' . $page);
        
        $posts = Cache::remember($cacheKey, 30, function () use ($searchKey) {
            return Post::with(['user', 'likes', 'comments'])
                ->withCount(['likes', 'comments'])
                ->when($searchKey, function ($query) use ($searchKey) {
                    $query->where(function ($q) use ($searchKey) {
                        $q->where('title', 'like', '%' . $searchKey . '%')
                          ->orWhere('description', 'like', '%' . $searchKey . '%')
                          ->orWhereHas('user', function ($uq) use ($searchKey) {
                              $uq->where('name', 'like', '%' . $searchKey . '%')
                                 ->orWhere('username', 'like', '%' . $searchKey . '%');
                          });
                    });
                })
                ->latest()
                ->paginate(12);
        });

        return view('livewire.home-feed', [
            'posts' => $posts
        ]);
    }
}
