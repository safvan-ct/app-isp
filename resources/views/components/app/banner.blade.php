@props(['title' => '', 'desc' => '', 'search' => true, 'author' => '', 'review' => '', 'class' => 'emerald'])

<div class="base-card text-center {{ $class }} mb-3 notranslate">
    @if ($title)
        <h3 class="m-0 fw-bold {{ $class == 'emerald' ? 'text-accent  text-shadow' : 'text-emerald' }}">{{ $title }}</h3>
    @endif

    @if ($desc)
        <div class="m-0 {{ $title ? 'mt-1' : '' }}">{!! $desc !!}</div>
    @endif

    @if ($author || $review)
        <div class="small {{ $class == 'emerald' ? 'text-accent' : 'text-white' }} {{ $title || $desc ? 'mt-1' : '' }} d-none">
            ✍️ Author: {{ $author ? $author : 'Author Name' }} • {{ $review ? 'Reviewed • ' : '' }} Verified <br>
            {{ $review ? '⏱️ Last review: ' . $review : '' }}
        </div>
    @endif

    {{ $slot }}

    @if ($search)
        <div class="search-bar input-group {{ $title || $desc || $author || $review || $slot ? 'mt-2' : '' }}">
            <input type="search" class="form-control" placeholder="Search..." aria-label="Search">
            <button class="btn  {{ $class == 'emerald' ? 'bg-warning' : 'bg-success' }}" type="button">
                <i class="fas fa-search"></i>
            </button>
        </div>
    @endif
</div>
