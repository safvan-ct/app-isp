@props(['title', 'url'])

<a href="{{ $url }}" class="lesson-item text-decoration-none text-dark">
    <span><i class="fas fa-play-circle me-2"></i> {{ $title }}</span>
</a>
