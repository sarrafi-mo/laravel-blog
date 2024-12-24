<div class="container bg-light-subtle p-2">
    <ul class="nav nav-pills">
        <li class="nav-item">
            <a class="nav-link py-1 {{ Route::is('admin.dashboard') ? 'active' : '' }}"
                href="{{ route('admin.dashboard') }}">Dashboard</a>
        </li>
        <li class="nav-item">
            <a class="nav-link py-1" href="#">Users</a>
        </li>
        <li class="nav-item">
            <a class="nav-link py-1 {{ Route::is('admin.posts.index') ? 'active' : '' }}"
                href="{{ route('admin.posts.index') }}">Posts</a>
        </li>
        <li class="nav-item">
            <a class="nav-link py-1" href="#">Comments</a>
        </li>
        {{-- <li class="nav-item">
            <a class="nav-link p-2 {{ Route::is('post.categories') ? 'active' : '' }}"
                href="{{ route('post.categories') }}">Categories</a>
        </li> --}}
    </ul>
</div>
