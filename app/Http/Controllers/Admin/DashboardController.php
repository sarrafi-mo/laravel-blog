<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $totalPosts = Post::count();
        $totalComments = Comment::count();

        return view(
            'admin.dashboard',
            compact('totalUsers', 'totalPosts', 'totalComments')
        );
    }
}
