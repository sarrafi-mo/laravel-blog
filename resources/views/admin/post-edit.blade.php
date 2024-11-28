@extends('layouts.app')

@section('content')
    <div class="container my-5">
        <h1 class="mb-4">Edit Post</h1>

        @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <form action="{{ route('posts.update', $post) }}" method="POST">
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
