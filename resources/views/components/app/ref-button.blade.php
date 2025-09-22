@props(['slug', 'number', 'type', 'ref', 'class' => ''])

<a role="button" class="me-2 text-decoration-none text-{{ $type == 'hadith' ? 'primary' : 'success' }} authentic {{ $class }}"
    data-slug="{{ $slug }}" data-number="{{ $number }}" data-type="{{ $type }}">
    {{ $ref }}
</a>
