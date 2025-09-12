@props(['text', 'reference', 'class' => ''])

<p class="ref-box ref-quran m-0 {{ $class }}" {{ $attributes }}>
    {!! $text !!} <em class="small"> - {{ $reference }}</em>
</p>
