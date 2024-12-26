@extends('layouts.app')

@section('content')
    @include('admin.shared.top-menu')

    <div class="container my-5">
        <div class="mb-4">
            <h2>All Comments</h2>
        </div>

        @include('admin.shared.searchbar', [
            'route' => 'admin.comments.index',
            'placeholder' => 'Search in Contents ...',
        ])

        <div class="mt-3">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>User</th>
                        <th>Post</th>
                        <th>Content</th>
                        <th>Created At</th>
                        <th>#</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($comments as $comment)
                        <tr>
                            <td>{{ $comment->id }}</td>
                            <td>{{ $comment->user->name }}</td>
                            <td>{{ $comment->post->title }}</td>
                            <td>{{ $comment->content }}</td>
                            <td>{{ $comment->created_at }}</td>
                            <td>
                                <!-- Delete form -->
                                <form action="{{ route('admin.comments.destroy', $comment->id) }}" method="POST"
                                    class="">
                                    @method('delete')
                                    @csrf
                                    <button class="btn btn-sm text-danger p-0" type="submit">
                                        <i class="bi bi-trash" style="font-size: 1.5rem"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <p>No Results Found.</p>
                    @endforelse

                </tbody>
            </table>
            <!-- Pagination -->
            <div class="mt-4">
                {{ $comments->links() }}
            </div>
        </div>
    </div>
@endsection
