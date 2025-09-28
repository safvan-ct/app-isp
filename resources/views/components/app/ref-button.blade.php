@props(['slug', 'number', 'type', 'class' => ''])

<a role="button"
    class="me-2 text-decoration-none text-{{ $type == 'hadith' ? 'primary' : 'success' }} authentic {{ $class }}"
    data-slug="{{ $slug }}" data-number="{{ $number }}" data-type="{{ $type }}">

    {{ $type == 'hadith' ? hadithBookName($slug) . ':' . $number : __('app.quran') . ' ' . $slug . ':' . $number }}
</a>
