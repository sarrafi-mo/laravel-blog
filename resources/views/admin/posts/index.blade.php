@extends('layouts.app')

@section('content')
    @include('admin.shared.top-menu')

    <div class="container my-5">
        <div>
            <h2 class="mb-4 d-inline">All Posts</h2>
            <a class="btn btn-success btn-sm float-end" href="{{ route('admin.posts.create') }}">Create +</a>
        </div>
        <div class="mt-3">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Content</th>
                        <th>Category</th>
                        <th>Image</th>
                        <th>Created At</th>
                        <th>Comments</th>
                        <th>Likes</th>
                        <th>#</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($posts as $post)
                        <tr>
                            <td>{{ $post->id }}</td>
                            <td><a class="text-dark" href="{{ route('posts.show', $post->slug) }}"><u>{{ Str::limit($post->title, 20) }}</u></a></td>
                            <td>{{ Str::limit($post->content, 30) }}</td>
                            <td>{{ $post->category }}</td>
                            <td><img src="{{ asset('images/blog/thumbnail/' . $post->image) }}"
                                    class="card-img-top" style="width: 75px;" alt="#"></td>
                            <td>{{ $post->created_at }}</td>
                            <td>{{ $post->comments->count() }}</td>
                            <td>{{ $post->likes->count() }}</td>
                            <td>
                                <!-- Delete form -->
                                <form action="{{ route('admin.posts.destroy', $post->slug) }}" method="POST" class="d-inline">
                                    @method('delete')
                                    @csrf
                                    <button class="btn btn-sm text-danger float-end p-0" type="submit">
                                        <i class="bi bi-trash" style="font-size: 1.5rem"></i>
                                    </button>
                                </form>

                                <!-- Edit page link -->
                                <a href="{{ route('admin.posts.edit', $post->slug) }}" class="text-primary">
                                    <i class="bi bi-pencil-square" style="font-size: 1.5rem"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <p>No Results Found.</p>
                    @endforelse

                </tbody>
            </table>
            <!-- Pagination -->
            <div class="mt-4">
                {{ $posts->links() }}
            </div>
        </div>
    </div>
@endsection
