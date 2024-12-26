<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;

class PaginatePosts extends Component
{
    use WithPagination;

    public $archive;
    public $search;

    public function render()
    {
        return view('livewire.paginate-posts', [
            'posts' => Post::latest()
            ->where('title', 'like', "%{$this->search}%")
            ->paginate(6),
        ]);
    }
}
