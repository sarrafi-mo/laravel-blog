<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;

class PaginatePosts extends Component
{
    use WithPagination;

    public $archive;

    public function render()
    {
        $posts = Post::orderBy('id', 'DESC');

        return view('livewire.paginate-posts' , [
            'posts' => $posts->paginate(6)
        ]);
    }
}
