@extends('layouts.app')

@section('content')
    <div class="container my-3">
        <div class="row">

            <!-- Post Title -->
            <h1 class="display-6 my-3">{{ $post->title }}</h1>

            <div class="mb-3">
                <span>
                    <a href="{{ url()->previous() === url()->current() ? route('posts.index') : url()->previous() }}">
                        <u class="text-dark">{{ url()->previous() === url()->current() ? 'All Posts' : 'Previous Page' }}</u>
                    </a>
                </span>
                <span class="bi bi-arrow-right"></span>
                <span> {{ $post->title }} </span>
            </div>

            <div class="col-md-8">

                <!-- Author and Date -->
                <p class="text-muted">
                    <span>Date: <strong>{{ $post->created_at->diffForHumans() }}</strong></span>

                    <!-- Categories -->
                    <span class="badge bg-primary ms-lg-1">{{ $post->category }}</span>
                </p>

                <!-- Post Image -->
                <div class="mb-4">
                    <img src="{{ asset('images/blog/orginal/' . $post->image) }}" class="img-fluid rounded"
                        style="width: 100%; max-width: 800px;" alt="Post Image">
                </div>

                <!-- Post Content -->
                <div id="post-content" class="content my-4">
                    <p>
                        {{ $post->content }}
                    </p>

                    @if (session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                </div>

                <!-- Like Section with Heart Icon -->
                <div id="likes-div" class="my-3">
                    @auth
                        @if (Auth::user()->likesPost($post))
                            <form action="{{ route('posts.unlike', $post->slug) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-sm text-danger me-3">
                                    <i class="bi bi-heart-fill" style="font-size: 1.5rem;"></i>
                                    <span id="like-count">{{ $post->likes_count }}</span>
                                </button>
                            </form>
                        @else
                            <form action="{{ route('posts.like', $post->slug) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-sm text-danger me-3">
                                    <i class="bi bi-heart" style="font-size: 1.5rem;"></i>
                                    <span id="like-count">{{ $post->likes_count }}</span>
                                </button>
                            </form>
                        @endif
                    @endauth
                    @guest
                        <a href="{{ route('login') }}" class="text-danger me-3"><i class="bi bi-heart"
                                style="font-size: 1.5rem;"></i>
                            <span id="like-count">{{ $post->likes_count }}</span></a>
                    @endguest
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
                    @forelse ($comments as $comment)
                        <div class="comment my-3">
                            <h5>{{ $comment->user->name }}</h5>
                            @auth
                                @can('comment.delete', $comment)
                                    <form
                                        action="{{ route('posts.comments.destroy', ['post' => $post->slug, 'comment' => $comment->id]) }}"
                                        method="POST">
                                        @method('delete')
                                        @csrf
                                        <button class="btn btn-sm text-danger float-end p-0" type="submit">
                                            <i class="bi bi-trash" style="font-size: 1.5rem"></i>
                                        </button>
                                    </form>
                                @endcan
                            @endauth
                            <p>{{ $comment->content }}</p>
                            <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                        </div>
                    @empty
                        <p>No Results Found.</p>
                    @endforelse
                </div>

                <div id="pagination-div">
                    {{ $comments->withQueryString()->links() }}
                </div>

                @auth
                    <!-- Comment Form -->
                    <div class="comment-form my-5">
                        <h3>Leave a Comment</h3>
                        <form action="{{ route('posts.comments.store', $post->slug) }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="comment" class="form-label">Your Comment</label>
                                <textarea name="content" class="form-control" id="comment" rows="4"></textarea>
                                @error('content')
                                    <span class="text-danger"> {{ $message }} </span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Submit Comment</button>
                        </form>
                    </div>
                @endauth
                @guest
                    <p class="text-info-emphasis lead">please <a href="{{ route('login') }}"
                            class="btn btn-success btn-sm text-light">
                            Login </a>
                        or <a href="{{ route('register') }}" class="btn btn-dark btn-sm text-light"> Register </a> to leave a
                        comment.
                    </p>
                @endguest
            </div>

            <!-- Suggested Posts -->
            <div class="col-md-4">
                <h5 class="mb-3">Suggested Posts</h5>
                <div class="list-group">
                    @foreach ($suggestedPosts as $suggestedPost)
                        <div class="card mb-3">
                            <a href="{{ route('posts.show', $suggestedPost->slug) }}" class="text-dark">
                                <img src="{{ asset('images/blog/thumbnail/' . $suggestedPost->image) }}"
                                    class="card-img-top" alt="#">
                                <div class="card-body">
                                    <h5 class="card-title"> <u>{{ $suggestedPost->title }} </u></h5>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
