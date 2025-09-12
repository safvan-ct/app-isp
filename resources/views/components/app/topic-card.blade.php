@props(['title', 'url'])

<div class="base-card d-flex flex-column h-100 justify-content-between rounded-3 border shadow-sm">
    <a href="{{ $url }}" class="d-flex align-items-center text-decoration-none">
        <div class="icon-thumb me-2 bg-success-subtle" style="width: 35px; height: 35px">
            <i class="fa-regular fa-star"></i>
        </div>

        <h6 class="text-emerald-900 fw-bold m-0 small">{{ $title }}</h6>
    </a>
</div>
