@foreach ($verses as $item)
    <article class="border-0 rounded-2 notranslate">
        <h6 class="text-ar m-0 p-0 mb-1 text-black lh-xl" style="font-size: 20px">
            {{ $item->text }}
            <span dir="ltr" class="ar-number fs-6">﴾{{ $item->number_in_chapter }}﴿</span>
        </h6>

        @if ($item->translation)
            <p class="m-0 p-0 mb-1 small text-justify">{{ $item->translation->text }} ({{ $item->number_in_chapter }})
            </p>
        @endif

        <p class="text-muted small fst-italic m-0">
            <span class="notranslate">{{ $item->chapter->id }}:</span>
            <span class="notranslate">{{ $item->chapter->translation?->name ?? $item->chapter->name }}</span>,
            <span class="notranslate">{{ $item->number_in_chapter }}</span>
        </p>
    </article>

    {!! !$loop->last ? '<hr class="border-2 my-2 mb-3 text-black opacity-100">' : '' !!}
@endforeach
