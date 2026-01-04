@props(['title'])

<div class="card mb-3 shadow-sm p-3 rounded-2 border-accent-900" {{ $attributes }}>
    <h6 class="text-black fw-bold m-0 mb-1">
        <i class="fas fa-lightbulb text-gold me-1"></i>
        {{ $title }}
    </h6>

    <x-app.hr />

    {{ $slot }}
</div>
