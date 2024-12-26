@extends('layouts.app')

@section('content')
    @include('admin.shared.top-menu')

    <div class="container my-5">
        <div class="mb-4">
            <h2>All Users</h2>
        </div>

        @include('admin.shared.searchbar', [
            'route' => 'admin.users.index',
            'placeholder' => 'Search in Emails ...',
        ])

        <div class="mt-3">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Joined At</th>
                        <th>#</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->created_at }}</td>
                            <td>
                                <!-- Delete form -->
                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="">
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
                {{ $users->links() }}
            </div>
        </div>
    </div>
@endsection
