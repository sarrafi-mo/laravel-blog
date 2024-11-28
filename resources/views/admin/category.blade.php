@extends('layouts.app')

@section('content')
    <div class="container my-5">
        <h1 class="mb-4">Categories</h1>
        <div class="container mt-3">
            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th class="text-center">Category</th>
                        <th class="text-end">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td class="text-center">{{ $category->category }}</td>
                            <td>
                                <form action="{{ route('post.categories.delete', $category) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-sm text-danger float-end p-0" type="submit">
                                        <i class="bi bi-trash" style="font-size: 1.5rem"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="container">
            <h2 class="mt-5">Create New Category</h2>
            <form action="{{ route('post.categories.store') }}" method="POST">
                @csrf
                <!-- Category -->
                <div class="mb-3">
                    <label for="category" class="form-label">Category</label>
                    <input name="category" type="text" class="form-control" id="category" placeholder="Enter category"
                        required>
                </div>

                <!-- Submit Button -->
                <button class="btn btn-success" type="submit">Create</button>

                @error('category')
                    <span class="text-danger"> {{ $message }} </span>
                @enderror
            </form>
        </div>
    </div>
@endsection
