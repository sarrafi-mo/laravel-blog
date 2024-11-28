@extends('layouts.app')

@section('content')
    <div class="container my-5">
        <!-- Post Title -->
        <h1 class="display-4">Post Title</h1>

        <!-- Author and Date -->
        <p class="text-muted">
            <span>Date: <strong>post create date</strong></span>

            <!-- Categories -->
            <span class="badge bg-primary ms-lg-1">post category</span>
        </p>

        <!-- Post Image -->
        <div class="my-4">
            <img src="#" class="img-fluid rounded" style="width: 800px" alt="Post Image">
        </div>

        <!-- Post Content -->
        <div id="post-content" class="content my-4">
            <p>
                post content
            </p>
        </div>

        <!-- Like Section with Heart Icon -->
        <div id="likes-div" class="my-3">
            <form action="#">
                <button type="submit" class="btn btn-sm text-danger me-3">
                    <i class="bi bi-heart-fill" style="font-size: 1.5rem;"></i>
                    <span id="like-count">2</span>
                </button>
            </form>
            <form action="#">
                <button type="submit" class="btn btn-sm text-danger me-3">
                    <i class="bi bi-heart" style="font-size: 1.5rem;"></i>
                    <span id="like-count">1</span>
                </button>
            </form>
            <a href="#" class="text-danger me-3"><i class="bi bi-heart" style="font-size: 1.5rem;"></i>
                <span id="like-count">3</span></a>
        </div>

        <!-- Share Icons -->
        <div class="my-4">
            <a href="#" class="text-primary me-3" title="Share on Facebook"><i class="bi bi-facebook"
                    style="font-size: 1.5rem;"></i></a>
            <a href="#" class="text-success me-3" title="Share on WhatsApp"><i class="bi bi-whatsapp"
                    style="font-size: 1.5rem;"></i></a>
            <a href="#" class="text-info me-3" title="Share on Twitter"><i class="bi bi-twitter"
                    style="font-size: 1.5rem;"></i></a>
            <a href="#" class="text-danger" title="Share on Instagram"><i class="bi bi-instagram"
                    style="font-size: 1.5rem;"></i></a>
        </div>

        <!-- Comments Section -->
        <div class="comments-section my-5">
            <h3>User Comments</h3>

            <div class="comment my-3">
                <h5>comment user name</h5>
                <form action="#">
                    <button class="btn btn-sm text-danger float-end p-0" type="submit">
                        <i class="bi bi-trash" style="font-size: 1.5rem"></i>
                    </button>
                </form>
                <p>comment content</p>
                <small class="text-muted">comment create date</small>
            </div>
            <!-- No Results -->
            <p>No Results Found.</p>
        </div>

        <!-- Pagination -->
        <div id="pagination-div">
        </div>

        <!-- Comment Form -->
        <div class="comment-form my-5">
            <h3>Leave a Comment</h3>
            <form action="#">
                <div class="mb-3">
                    <label for="comment" class="form-label">Your Comment</label>
                    <textarea name="content" class="form-control" id="comment" rows="4"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit Comment</button>
            </form>
        </div>
        <!-- For Guest User -->
        <p class="text-info-emphasis lead">please <a href="#" class="btn btn-success btn-sm text-light">
                Login </a>
            or <a href="#" class="btn btn-dark btn-sm text-light"> Register </a> to leave a comment.
        </p>
    </div>
@endsection
