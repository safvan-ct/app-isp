@extends('layouts.app')

@section('content')
    <div class="topbar d-flex align-items-center justify-content-between notranslate">
        <a href="{{ route('hadith.chapters', [$chapter->book->id]) }}" class="me-2"><i
                class="fas fa-chevron-left fs-3 text-secondary"></i></a>
        <h6 class="fw-bold mb-0 text-emerald">{{ $chapter->book->translation?->name ?? $chapter->book->name }}</h6>

        <form class="d-flex ms-3">
            <div class="input-group input-group-sm">
                <input type="search" class="form-control" placeholder="Search hadith..." aria-label="Search">
                <button class="btn btn-secondary" type="button"><i class="fas fa-search"></i></button>
            </div>
        </form>
    </div>

    <div class="app-header text-center bg-app notranslate">
        <h5 class="fw-bold mt-3 mb-1">
            {{ $chapter->translation?->name ?? $chapter->name }}
        </h5>
        <p class='small text-dark m-0'>
            {{ $chapter->book->translation?->writer ?? $chapter->book->writer }}
            ({{ $chapter->book->writer_death_year }}H)
        </p>
        <p class="small text-muted m-0">
            {{ __('app.chapter') }}: <strong>{{ $chapter->chapter_number }}</strong> •
            {{ __('app.hadiths') }}: <strong>{{ $chapter->verses->count() }}</strong>
        </p>

        <div id="google_translate_element" class="mt-2 mb-0"></div>
    </div>

    <div class="container my-4 pb-5">
        <article class="base-card mb-2">
            @foreach ($verses as $item)
                @if ($item->heading)
                    <div class="row flex-column flex-md-row m-0 mb-2">
                        <div class="col-12 col-md-6 order-1 order-md-2">
                            <h6 class="text-emerald-900 notranslate fw-bold fs-5 m-0" style="line-height: 1.4; direction: rtl">
                                {{ $item->heading }}
                            </h6>
                        </div>

                        <div class="col-12 col-md-6 order-2 order-md-1 m-0">
                            <h6 class="fw-bold fs-6 m-0">{{ $item->translation?->heading }}</h6>
                        </div>
                    </div>
                @endif

                <div class="row flex-column flex-md-row m-0 mb-1">
                    <div class="col-12 col-md-6 order-1 order-md-2">
                        <div class="text-emerald-900 notranslate" style="font-size: 20px; line-height: 1.6;" dir="rtl">
                            {{ $item->text }}
                            (<span class="fst-italic fs-6">{{ $verses->firstItem() + $loop->index }}</span>)
                        </div>
                    </div>

                    <div class="col-12 col-md-6 order-2 order-md-1">
                        <div class="text-en text-justify">{{ $item->translation?->text }}</div>
                    </div>
                </div>

                <p class="text-muted small notranslate fst-italic m-0">
                    {{--  {{ $chapter->book->translation?->name ?? $chapter->book->name }}, --}}
                    🔖 {{ __('app.volume') }}: {{ $item->volume }},
                    {{-- {{ __('app.chapter') }}: {{ $chapter->translation?->name ?? $chapter->name }}, --}}
                    {{ __('app.hadith') }}: {{ $item->hadith_number }},
                    {{ __('app.status') }}: {{ __('app.' . strtolower($item->status)) }}
                </p>

                @if (!$loop->last)
                    <hr class="m-2 fs-1">
                @endif
            @endforeach
        </article>

        <div class="d-flex justify-content-center mb-4">
            {{ $verses->onEachSide(1)->links() }}
        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        function googleTranslateElementInit() {
            new google.translate.TranslateElement({
                pageLanguage: 'en',
                includedLanguages: 'en,ml,hi',
                layout: google.translate.TranslateElement.InlineLayout.SIMPLE
            }, 'google_translate_element');
        }
    </script>
    <script type="text/javascript" src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit">
    </script>
@endpush
