<div>
    <form action="{{ route($route) }}" class="input-group">
        <input wire:model='search' name="search" type="text" class="form-control w-50 d-inline"
            placeholder="{{ $placeholder }}" value="{{ request('search', '') }}">
        <button type="submit" class="btn btn-dark"> Search </button>
        @if (request()->has('search'))
            <a href="{{ route($route) }}" class="btn btn-danger">X</a>
        @endif
    </form>
</div>
