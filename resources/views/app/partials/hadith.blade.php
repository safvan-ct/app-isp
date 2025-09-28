@foreach ($verses as $item)
    {{-- @if ($item->heading)
        <div class="row flex-column flex-md-row m-0 mb-2">
            <div class="col-12 col-md-6 order-1 order-md-2 p-0 ps-md-4">
                <h6 class="text-emerald-900 notranslate fw-bold fs-5 m-0 text-justify"
                    style="line-height: 1.4; direction: rtl">
                    {{ $item->heading }}
                </h6>
            </div>

            <div class="col-12 col-md-6 order-2 order-md-1 m-0 p-0">
                <h6 class="fw-bold fs-6 m-0 text-justify">{{ $item->translation?->heading }}</h6>
            </div>
        </div>
    @endif --}}

    <div class="row flex-column flex-md-row m-0 mb-1">
        <div class="col-12 col-md-6 order-1 order-md-2 p-0 ps-md-4">
            <h6 class="text-emerald-900 notranslate text-justify" style="line-height: 1.6;" dir="rtl">
                {{ $item->text }}
                <em class="small"> - {{ $item->hadith_number }}</em>
            </h6>
        </div>

        <div class="col-12 col-md-6 order-2 order-md-1 p-0">
            <div class="text-en text-justify small">{{ $item->translation?->text }}</div>
        </div>
    </div>

    <p class="text-muted small fst-italic m-0">
        <span class="notranslate">{{ $item->book->translation?->name ?? $item->book->name }},</span>
        <span class="notranslate">{{ __('app.volume') }}: {{ $item->volume }},</span>
        {{ $item->chapter->translation?->name }} <span class="notranslate text-ar"> ({{ $item->chapter->name }}),</span>
        <span class="notranslate">{{ $item->hadith_number }},</span>
        <span class="notranslate">{{ __('app.' . strtolower($item->status)) }}</span>
    </p>
@endforeach
