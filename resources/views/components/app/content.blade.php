@props(['title', 'desc' => ''])

<div class="m-0 p-0 mb-4">
    <h5 class="text-black fw-bold">
        <i class="fas fa-lightbulb text-gold me-1"></i>
        {{ $title }}
    </h5>

    <x-app.hr />

    @if (!empty($desc))
        {!! $desc !!}
    @endif

    {{ $slot }}
</div>
