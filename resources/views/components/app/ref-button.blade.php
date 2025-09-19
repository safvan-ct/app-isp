@props(['slug', 'number', 'type', 'ref', 'class' => ''])

<button class="btn btn-sm btn-outline-{{ $type == 'hadith' ? 'primary' : 'success' }} authentic {{ $class }}"
    data-slug="{{ $slug }}" data-number="{{ $number }}" data-type="{{ $type }}">
    {{ $ref }}
</button>
