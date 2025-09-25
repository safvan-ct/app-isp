@props(['title', 'desc' => ''])

<div class="m-0 p-0 mb-4">
    <h5 class="text-emerald-900 fw-bold">
        <i class="fas fa-lightbulb text-accent me-1"></i>
        {{ $title }}
    </h5>

    <x-app.hr />

    @if (!empty($desc))
        {!! $desc !!}
    @endif

    {{ $slot }}
</div>
