@props(['title'])

<div class="card mb-3 shadow-sm p-3 rounded-2 border-accent-900" {{ $attributes }}>
    <h6 class="text-emerald-900 fw-bold m-0 mb-1">
        <i class="fas fa-lightbulb text-accent me-1"></i>
        {{ $title }}
    </h6>

    <x-app.hr />

    {{ $slot }}
</div>
