@props(['title', 'desc' => ''])

<div class="m-0 p-0 mb-4">
    <h5 class="text-emerald-900 fw-bold">
        <i class="fas fa-lightbulb text-accent me-1"></i>
        {{ $title }}
    </h5>

    <hr class="mt-1 mb-2" style="border: none; border-top: 2px solid #166534; opacity: 1;">

    @if (!empty($desc))
        {!! $desc !!}
    @endif

    {{ $slot }}
</div>
