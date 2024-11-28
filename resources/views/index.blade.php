@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <!-- Header -->
        <div class="text-center mb-5">
            <h1>Welcome to My Blog</h1>
            <p class="lead">Latest articles, tutorials, and news.</p>
        </div>

        <div class="row">
            <!-- Example of a single blog post card -->
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="#" class="card-img-top" alt="#">
                    <div class="card-body">
                        <h5 class="card-title"> post title </h5>
                        <p class="card-text"> post content </p>
                        <a href="#" class="btn btn-primary">Read More</a>

                        <!-- Delete form -->
                        <form action="#" class="d-inline">
                            <button class="btn btn-sm text-danger float-end p-0" type="submit">
                                <i class="bi bi-trash" style="font-size: 1.5rem"></i>
                            </button>
                        </form>

                        <!-- Edit page link -->
                        <a href="#" class="text-dark float-end me-2">
                            <i class="bi bi-pencil-square" style="font-size: 1.5rem"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
