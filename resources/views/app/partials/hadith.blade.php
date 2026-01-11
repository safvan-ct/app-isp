@foreach ($verses as $item)
    <div class="row flex-column flex-md-row m-0 mb-1">
        <div
            class="col-12 {{ empty($item->translation?->text) ? 'col-md-12' : 'col-md-6' }} order-1 order-md-2 p-0 ps-md-4">
            <h6 class="text-black notranslate text-justify"
                style="font-size: 19px; line-height: 1.8; font-family: 'Scheherazade New', serif;" dir="rtl">
                {{ $item->text }}
                <em class="small"> - {{ $item->hadith_number }}</em>
            </h6>
        </div>

        <div class="col-12 col-md-6 order-2 order-md-1 p-0">
            @if (!empty($item->translation?->text))
                <p class="fw-bold m-0 p-0 text-justify" style="font-size: 14px;">{{ $item->translation?->narrator }}</p>
            @endif
            <div class="text-en text-justify" style="font-size: 14px;">{{ $item->translation?->text }}</div>
        </div>
    </div>

    <p class="text-muted small fst-italic m-0">
        <span class="notranslate">{{ $item->book->translation?->name ?? $item->book->name }},</span>

        @if (!is_null($item->volume))
            <span class="notranslate">{{ __('app.volume') }}: {{ $item->volume }},</span>
        @endif

        {{ $item->chapter->translation?->name }}
        <span class="notranslate text-ar">({{ $item->chapter->name }}),</span>

        <span class="notranslate">{{ $item->hadith_number }}{{ !is_null($item->status) ? ', ' : '' }}</span>

        @if (!is_null($item->status))
            <span class="notranslate">{{ __('app.' . strtolower($item->status)) }}</span>
        @endif
    </p>
@endforeach
