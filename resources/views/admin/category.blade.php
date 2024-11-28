@extends('layouts.app')

@section('content')
    <div class="container my-5">
        <h1 class="mb-4">Categories</h1>
        <div class="container mt-3">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th class="text-center">Category</th>
                        <th class="text-end">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>category id</td>
                        <td class="text-center">category name</td>
                        <td>
                            <form action="#">
                                <button class="btn btn-sm text-danger float-end p-0" type="submit">
                                    <i class="bi bi-trash" style="font-size: 1.5rem"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="container">
            <h2 class="mt-5">Create New Category</h2>
            <form action="#">
                <!-- Category -->
                <div class="mb-3">
                    <label for="category" class="form-label">Category</label>
                    <input name="category" type="text" class="form-control" id="category" placeholder="Enter category"
                        required>
                </div>
                <!-- Submit Button -->
                <button class="btn btn-success" type="submit">Create</button>
            </form>
        </div>
    </div>
@endsection
