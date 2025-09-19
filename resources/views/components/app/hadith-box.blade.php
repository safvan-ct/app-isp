@props(['text' => '', 'reference' => '', 'class' => ''])

<div class="ref-box ref-hadith m-0 {{ $class }}" {{ $attributes }}>
    @if ($text)
        {!! $text !!}

        @if ($reference)
            <em class="small"> - {{ $reference }}</em>
        @endif
    @endif

    {{ $slot }}
</div>
