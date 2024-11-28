@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <!-- Header -->
        <div class="text-center mb-5">
            <h1>Welcome to My Blog</h1>
            <p class="lead">Latest articles, tutorials, and news.</p>
        </div>

        <!-- Blog Posts -->
        <div class="row">
            @foreach ($posts as $post)
                <!-- Example of a single blog post card -->
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="{{ asset('images/blog/thumbnail/' . $post->image) }}" class="card-img-top" alt="#">
                        <div class="card-body">
                            <h5 class="card-title"> {{ $post->title }} </h5>
                            <p class="card-text"> {{ Str::limit($post->content, 35) }} </p>
                            <a href="{{ route('posts.show', $post) }}" class="btn btn-primary">Read More</a>

                            @auth
                                @can('admin')
                                    <!-- Delete form -->
                                    <form action="{{ route('posts.destroy', $post) }}" method="POST" class="d-inline">
                                        @method('delete')
                                        @csrf
                                        <button class="btn btn-sm text-danger float-end p-0" type="submit">
                                            <i class="bi bi-trash" style="font-size: 1.5rem"></i>
                                        </button>
                                    </form>

                                    <!-- Edit page link -->
                                    <a href="{{ route('posts.edit', $post) }}" class="text-dark float-end me-2">
                                        <i class="bi bi-pencil-square" style="font-size: 1.5rem"></i>
                                    </a>
                                @endcan
                            @endauth
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $posts->links() }}
        </div>

    </div>
@endsection
