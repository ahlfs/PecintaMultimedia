<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\Post;
use Illuminate\Support\Facades\Cache;

class HomeFeed extends Component
{
    public $search = '';
    public $loadedCount = 15;

    protected $queryString = [
        'search' => ['except' => ''],
    ];

    public function updatedSearch()
    {
        $this->loadedCount = 15;
    }

    #[On('search-updated')]
    public function searchUpdated($value)
    {
        $this->search = $value;
        $this->loadedCount = 15;
    }

    /**
     * Retrieve and cache the shuffled list of post IDs for the current session/instance.
     * Caching prevents re-shuffling on every scroll/render cycle.
     */
    private function getFeedIds()
    {
        $searchHash = md5($this->search);
        $cacheKey = 'feed_ids_' . $this->getId() . '_' . $searchHash;

        return Cache::remember($cacheKey, 3600, function () {
            $searchKey = trim($this->search);

            $ids = Post::when($searchKey, function ($query) use ($searchKey) {
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
                ->limit(5000)
                ->pluck('id')
                ->toArray();

            shuffle($ids);
            return $ids;
        });
    }

    public function loadMore()
    {
        $allIds = $this->getFeedIds();
        if ($this->loadedCount < count($allIds)) {
            $this->loadedCount += 15;
        }
    }

    public function render()
    {
        $allIds = $this->getFeedIds();
        $idsPage = array_slice($allIds, 0, $this->loadedCount);

        $posts = collect();
        if (!empty($idsPage)) {
            $posts = Post::whereIn('id', $idsPage)
                ->withCount(['likes', 'comments'])
                ->with(['user', 'likes', 'comments'])
                ->get()
                ->sortBy(function ($post) use ($idsPage) {
                    return array_search($post->id, $idsPage);
                });
        }

        return view('livewire.home-feed', [
            'posts' => $posts,
            'hasMore' => $this->loadedCount < count($allIds)
        ]);
    }
}
