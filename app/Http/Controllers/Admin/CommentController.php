<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::orderBy('id', 'DESC');

        if (request()->has('search')) {
            $comments = $comments->where('content', 'like', '%' . request()->get('search', '') . '%');
        }

        return view('admin.comments.index', [
            'comments' => $comments->paginate(8)
        ]);
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();

        return redirect()->back()->with('success', 'user deleted successfully');
    }
}
