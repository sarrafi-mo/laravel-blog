<?php

namespace App\Http\Controllers;

use App\Models\Post;

class PostController extends Controller
{
    public function index($archive = null)
    {
        if ($archive != null) {
            return view('index' , compact('archive'));
        } else {
            return view('index');
        }
    }

    public function show(Post $post)
    {
        $comments = $post->comments()->orderBy('created_at', 'desc')->paginate(5);
        return view('post-details', compact('post', 'comments'));
    }
    
}
