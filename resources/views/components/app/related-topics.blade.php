@props(['title', 'url'])

<a class="lesson-item text-decoration-none text-primary shadow-sm" href="{{ $url }}">
    <span><i class="fas fa-play-circle me-2 text-primary"></i> {{ $title }}</span>
</a>
