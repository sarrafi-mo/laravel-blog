@extends('layouts.app')

@section('content')
    @include('admin.shared.top-menu')

    <div class="container my-5">
        <h2 class="mb-4">Dashboard</h2>

        <div class="row">
            <div class="col-sm-6 col-md-4">
                @include('admin.shared.widget', [
                    'title' => 'Total Users',
                    'icon' => 'bi bi-people-fill',
                    'data' => $totalUsers,
                ])
            </div>
            <div class="col-sm-6 col-md-4">
                @include('admin.shared.widget', [
                    'title' => 'Total Posts',
                    'icon' => 'bi bi-lightbulb-fill',
                    'data' => $totalPosts,
                ])
            </div>
            <div class="col-sm-6 col-md-4">
                @include('admin.shared.widget', [
                    'title' => 'Total Comments',
                    'icon' => 'bi bi-chat-square-text-fill',
                    'data' => $totalComments,
                ])
            </div>
        </div>

    </div>
@endsection
