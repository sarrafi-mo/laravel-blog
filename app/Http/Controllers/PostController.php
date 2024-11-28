<?php

namespace App\Http\Controllers;

class PostController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function show()
    {
        return view('post-details');
    }

    public function create()
    {
        return view('admin/post-create');
    }

    public function edit()
    {
        return view('admin/post-edit');
    }
}
