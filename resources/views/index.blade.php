@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        
        <!-- Header -->
        <div class="text-center mb-5">
            @if (isset($archive))
                <h1>Archive Page</h1>
            @else
                <h1>Welcome to My Blog</h1>
            @endif
            <p class="lead">Latest articles, tutorials, and news.</p>
        </div>

        @livewire('paginate-posts' , ['archive' => $archive ?? null])
        
    </div>
@endsection
