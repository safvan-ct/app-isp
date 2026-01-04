@props(['number' => '', 'type' => '', 'title' => '', 'desc' => '', 'search' => false, 'url' => '#'])

<header class="container-fluid py-3 bg-clr-white shadow-sm notranslate">
    <div class="container text-center">
        @if ($type || $number)
            <p class="mb-0 text-muted small d-none">{{ $type }} {{ $number }}: </p>
        @endif

        @if ($title)
            <h4 class="fw-bold text-dark m-0 mb-1" onclick="window.location.href = '{{ $url }}'"
                @if ($url !== '#') style="cursor: pointer" @endif>
                {{ $title }}
            </h4>
        @endif

        @if ($desc)
            <div class="m-0 text-muted mt-1"> {!! $desc !!}</div>
        @endif

        {{ $slot }}

        @if ($search)
            <div class="search-bar input-group {{ $title || $desc || $slot ? 'mt-2' : '' }}">
                <input type="search" class="form-control" placeholder="Search..." aria-label="Search">
                <button class="btn  dark" type="button">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        @endif
    </div>
</header>


{{-- <div class="base-card text-center {{ $class }} mb-3 notranslate">
    @if ($title)
        <h3 class="m-0 fw-bold {{ $class == 'dark' ? 'text-gold  text-shadow' : 'text-dark' }}">{{ $title }}</h3>
    @endif

    @if ($desc)
        <div class="m-0 {{ $title ? 'mt-1' : '' }}">{!! $desc !!}</div>
    @endif

    @if ($author || $review)
        <div class="small {{ $class == 'dark' ? 'text-gold' : 'text-white' }} {{ $title || $desc ? 'mt-1' : '' }} d-none">
            ✍️ Author: {{ $author ? $author : 'Author Name' }} • {{ $review ? 'Reviewed • ' : '' }} Verified <br>
            {{ $review ? '⏱️ Last review: ' . $review : '' }}
        </div>
    @endif

    {{ $slot }}

    @if ($search)
        <div class="search-bar input-group {{ $title || $desc || $author || $review || $slot ? 'mt-2' : '' }}">
            <input type="search" class="form-control" placeholder="Search..." aria-label="Search">
            <button class="btn  {{ $class == 'dark' ? 'bg-warning' : 'bg-success' }}" type="button">
                <i class="fas fa-search"></i>
            </button>
        </div>
    @endif
</div> --}}
