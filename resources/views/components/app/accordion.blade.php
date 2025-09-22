@props([
    'id',
    'parent' => 'accordions',
    'icon' => '<i class="fas fa-lightbulb text-accent me-2"></i>',
    'title',
    'active' => false,
    'class' => '',
])

<div class="accordion-item {{ $class }}">
    <h2 class="accordion-header">
        <button class="accordion-button {{ $active ? '' : 'collapsed' }} text-emerald" type="button"
            data-bs-toggle="collapse" data-bs-target="#{{ $id }}" aria-expanded="true">
            {!! $icon !!} <span class="fw-bold">{{ $title }}</span>
        </button>
    </h2>

    <div id="{{ $id }}" class="accordion-collapse collapse {{ $active ? 'show' : '' }}"
        data-bs-parent="#{{ $parent }}">
        <div class="accordion-body p-3">
            {{ $slot }}
        </div>
    </div>
</div>
