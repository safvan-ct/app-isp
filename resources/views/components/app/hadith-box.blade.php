@props(['text', 'reference', 'class' => ''])

<p class="ref-box ref-hadith m-0 {{ $class }}" {{ $attributes }}>
    {!! $text !!} <em class="small"> - {{ $reference }}</em>
</p>
