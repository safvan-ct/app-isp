@props(['title', 'desc' => '', 'reference' => ''])

<div class="card mb-3 shadow-sm p-3 rounded-2 border-accent-900">
    <h5 class="text-emerald-900 fw-bold m-0 mb-1">
        <i class="fas fa-lightbulb text-accent me-1"></i>
        {{ $title }}
    </h5>

    <hr class="m-0 mb-2" style="border: none; border-top: 2px solid #166534; opacity: 1;">

    {{ $desc }}

    <div class="d-flex flex-wrap align-items-center gap-2">{{ $reference }}</div>

    {{ $slot }}
</div>
