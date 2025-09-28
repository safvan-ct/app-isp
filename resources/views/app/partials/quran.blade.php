@foreach ($verses as $item)
    <article class="border-0 rounded-2 notranslate">
        <h6 class="text-ar mb-2 text-emerald-900 lh-xl">
            {{ $item->text }}
            <span dir="ltr" class="ar-number fs-6">﴾{{ $item->number_in_chapter }}﴿</span>
        </h6>

        @if ($item->translation)
            <p class="mb-2 small">{{ $item->translation->text }} ({{ $item->number_in_chapter }})</p>
        @endif

        <p class="text-muted small fst-italic m-0">
            <span class="notranslate">{{ $item->chapter->id }}:</span>
            <span class="notranslate">{{ $item->chapter->translation?->name }} ({{ $item->chapter->name }})</span>,
            <span class="notranslate">{{ $item->number_in_chapter }}</span>
        </p>
    </article>
@endforeach
