@props(['slug', 'number', 'type', 'class' => ''])

<span role="button" class="small text-muted authentic {{ $class }}" data-slug="{{ $slug }}"
    data-number="{{ $number }}" data-type="{{ $type }}">
    {{ $type == 'hadith' ? $number : $slug . ':' . $number }}
</span>
