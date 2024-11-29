<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCommentRequest $request, Post $post)
    {
        $validated = $request->validated();

        $validated['post_id'] = $post->id;
        $validated['user_id'] = Auth::id();

        Comment::create($validated);

        return redirect()->route('posts.show', $post->slug . '#post-content')->with('success', "Your comment saved successfuly.");
    }

    public function destroy(Post $post , Comment $comment)
    {
        $this->authorize('comment.delete', $comment);

        $comment->delete();
        return redirect()->route('posts.show', $post->slug . '#post-content')->with('success', "comment deleted successfuly.");
    }
}
