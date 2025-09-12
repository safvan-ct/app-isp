@props(['title' => '', 'desc' => '', 'search' => true, 'author' => '', 'review' => ''])

<div class="card text-center bg-emerald mb-3">
    @if ($title)
        <h2 class="m-0 fw-bold text-accent">{{ $title }}</h2>
    @endif

    @if ($desc)
        <div class="m-0 my-1">{!! $desc !!}</div>
    @endif

    @if ($author || $review)
        <div class="small text-accent my-1">
            ✍️ Author: {{ $author ? $author : 'Author Name' }} • {{ $review ? 'Reviewed • ' : '' }} Verified <br>
            {{ $review ? '⏱️ Last review: ' . $review : '' }}
        </div>
    @endif

    {{ $slot }}

    @if ($search)
        <div class="search-bar input-group">
            <input type="search" class="form-control" placeholder="Search..." aria-label="Search">
            <button class="btn bg-warning" type="button"><i class="fas fa-search"></i></button>
        </div>
    @endif
</div>
