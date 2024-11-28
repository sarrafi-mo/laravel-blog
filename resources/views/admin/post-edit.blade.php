@extends('layouts.app')

@section('content')
    <div class="container my-5">
        <h1 class="mb-4">Edit Post</h1>

        <form action="#">

            <!-- Post Content -->
            <div class="mb-3">
                <label for="postContent" class="form-label">Current Content</label>
                <textarea name="content" class="form-control" id="postContent" rows="6" placeholder="Write your post content here"
                    required>post content</textarea>
            </div>

            <!-- Post Category -->
            <div class="mb-3">
                <label for="postCategory" class="form-label">Current Category : post category</label>
                <select name="category" class="form-select" id="postCategory" required>
                    <option value="" disabled selected>Select a new category</option>
                </select>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">Update Post</button>
        </form>
    </div>
@endsection
