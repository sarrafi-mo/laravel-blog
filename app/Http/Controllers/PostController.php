<?php

namespace App\Http\Controllers;

use App\Models\Post;

class PostController extends Controller
{
    public function index($archive = null)
    {
        if ($archive != null) {
            return view('index', compact('archive'));
        } else {
            return view('index');
        }
    }

    public function show(Post $post)
    {
        $comments = $post->comments()->orderBy('created_at', 'desc')->paginate(5);
        
        $suggestedPosts = Post::where('category', $post->category)
            ->where('id', '!=', $post->id)
            ->latest()
            ->limit(5)
            ->get();

        return view('post-details', [
            'post' => $post,
            'comments' => $comments,
            'suggestedPosts' => $suggestedPosts,
        ]);
    }
}
