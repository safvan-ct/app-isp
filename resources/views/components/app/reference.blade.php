@props(['text' => '', 'class' => '', 'type' => 'hadith'])

<div class="ref-box m-0 ref-{{ $type }} {{ $class }}" {{ $attributes }}>
    @if ($text)
        {!! $text !!}
    @endif

    {{ $slot }}
</div>
