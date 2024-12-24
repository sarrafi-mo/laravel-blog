@extends('layouts.app')

@section('content')
    <div class="container my-3">

        <h1 class="display-6 my-3">Edit Post</h1>

        <div>
            <span class="h5"><a href="{{ url()->previous() }}"><u>Posts</u></a></span>
            <span class="bi bi-arrow-right"></span>
            <span class="h5"> Edit Post </span>
        </div>

        @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="mb-3 mt-3">
            <label for="postTitle" class="form-label">Current Title</label>
            <input type="text" class="form-control" disabled id="postTitle" value="{{ $post->title }}">
        </div>
        <form action="{{ route('admin.posts.update', $post->slug) }}" method="POST">
            @method('put')
            @csrf

            <!-- Post Content -->
            <div class="mb-3">
                <label for="postContent" class="form-label">Current Content</label>
                <textarea name="content" class="form-control" id="postContent" rows="6" placeholder="Write your post content here"
                    required>{{ $post->content }}</textarea>
            </div>
            @error('content')
                <span class="text-danger"> {{ $message }} </span>
            @enderror

            <!-- Post Category -->
            <div class="mb-3">
                <label for="postCategory" class="form-label">Current Category : {{ $post->category }}</label>
                <select name="category" class="form-select" id="postCategory" required>
                    <option value="" disabled selected>Select a new category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->category }}">{{ $category->category }}</option>
                    @endforeach
                </select>
            </div>
            @error('category')
                <span class="text-danger"> {{ $message }} </span>
            @enderror

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">Update Post</button>
        </form>
    </div>
@endsection
