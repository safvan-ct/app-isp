@props(['text', 'reference', 'class' => ''])

<div class="ref-box ref-hadith m-0 {{ $class }}" {{ $attributes }}>
    {!! $text !!} <em class="small"> - {{ $reference }}</em>
</div>
