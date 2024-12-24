<div>
    <!-- Blog Posts -->
    <div class="row">
        @if ($posts->currentPage() > 5 && !isset($archive))
            <div class="text-center my-5 py-5">
                <h5>To read more, visit the <a href="{{ route('posts.index', 'archive' . '?page=6') }}"
                        class="btn btn-sm btn-outline-secondary">Archive</a> page.
                </h5>
            </div>
        @else
            @forelse ($posts as $post)
                <!-- Example of a single blog post card -->
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="{{ asset('images/blog/thumbnail/' . $post->image) }}" class="card-img-top"
                            alt="#">
                        <div class="card-body">
                            <h5 class="card-title"> {{ $post->title }} </h5>
                            <p class="card-text"> {{ Str::limit($post->content, 35) }} </p>
                            <a href="{{ route('posts.show', $post->slug) }}" class="btn btn-primary">Read More</a>

                            @auth
                                @can('admin')
                                    <!-- Delete form -->
                                    <form action="{{ route('admin.posts.destroy', $post->slug) }}" method="POST" class="d-inline">
                                        @method('delete')
                                        @csrf
                                        <button class="btn btn-sm text-danger float-end p-0" type="submit">
                                            <i class="bi bi-trash" style="font-size: 1.5rem"></i>
                                        </button>
                                    </form>

                                    <!-- Edit page link -->
                                    <a href="{{ route('admin.posts.edit', $post->slug) }}" class="text-dark float-end me-2">
                                        <i class="bi bi-pencil-square" style="font-size: 1.5rem"></i>
                                    </a>
                                @endcan
                            @endauth
                        </div>
                    </div>
                </div>
            @empty
            <div class="text-center">
                <p>No Results Found.</p>
            </div>
            @endforelse
        @endif
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $posts->links() }}
    </div>
</div>
