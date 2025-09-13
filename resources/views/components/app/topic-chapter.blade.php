@props(['title', 'url', 'related' => false])

<a href="{{ $url }}"
    class="base-card d-flex justify-content-between align-items-center text-decoration-none border my-1 {{ $related ? 'text-primary' : 'text-emerald-900' }}">
    <span>
        <i class="fas fa-play-circle me-2 {{ $related ? 'text-primary' : 'text-emerald' }}"></i>
        {{ $title }}
    </span>
</a>
