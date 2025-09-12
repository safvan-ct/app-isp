@props(['title', 'desc' => ''])

<div class="m-0 p-0 mb-4">
    <h5 class="text-emerald-900 fw-bold" style="border-bottom: 2px solid #166534">
        <i class="fas fa-lightbulb text-accent me-1"></i>
        {{ $title }}
    </h5>

    @if (!empty($desc))
        <p class="m-0 my-1">{!! $desc !!}</p>
    @endif

    {{ $slot }}
</div>
