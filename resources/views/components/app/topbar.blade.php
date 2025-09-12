@props(['title', 'url' => '', 'panel' => true])

<div class="topbar d-flex align-items-center justify-content-between notranslate">
    <div class="d-flex align-items-center">
        @if ($url)
            <a href="{{ $url }}" class="me-2 text-decoration-none">
                <i class="fas fa-chevron-left fs-3 text-secondary"></i>
            </a>
        @endif

        <h6 class="fw-bold mb-0 text-emerald">{{ $title }}</h6>
    </div>

    @if ($panel)
        <a href="javascript:void(0);" data-bs-toggle="offcanvas" data-bs-target="#menuPanel">
            <i class="fas fa-list fs-3 text-muted"></i>
        </a>
    @endif
</div>
