<?php

namespace App\Http\Controllers;

use App\Models\Post;

class PostLikeController extends Controller
{
    public function like(Post $post)
    {
        $liker = auth()->user();

        $liker->likes()->attach($post);

        return redirect()->route('posts.show', $post->id . '#post-content')->with('success', "Liked successfully!");
    }

    public function unlike(Post $post)
    {
        $liker = auth()->user();

        $liker->likes()->detach($post);

        return redirect()->route('posts.show', $post->id . '#post-content')->with('success', "Unliked successfully!");
    }
}
