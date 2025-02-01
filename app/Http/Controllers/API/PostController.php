<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::latest()->take(10)->get()->map(function ($post) {
            return [
                'title' => $post->title,
                'excerpt' => Str::limit($post->content, 50),
                'image_url' => url('images/blog/thumbnail/' . $post->image),
                'post_url' => url('/posts/show/' . $post->slug),
            ];
        });
    
        return response()->json($posts, 200);
    }

}
