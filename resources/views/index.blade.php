@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <!-- Header -->
        <div class="text-center mb-5">
            <h1>Welcome to My Blog</h1>
            <p class="lead">Latest articles, tutorials, and news.</p>
        </div>

        @livewire('paginate-posts' , ['archive' => $archive ?? null])
        
    </div>
@endsection
