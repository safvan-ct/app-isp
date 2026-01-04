@props(['title', 'url', 'related' => false])

<a href="{{ $url }}"
    class="base-card d-flex justify-content-between align-items-center text-decoration-none border  my-1 rounded-2 shadow-sm {{ $related ? 'text-primary' : 'text-black' }}">
    <span>
        <i class="fas fa-play-circle me-2 {{ $related ? 'text-primary' : 'text-dark' }}"></i>
        {{ $title }}
    </span>
</a>
