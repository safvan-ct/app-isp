@extends('layouts.app')

@section('title', __('app.hadith'))
@section('navbar_title', __('app.hadith'))
@section('navbar_url', route('hadith.chapters', [$chapter->book->id]))

@section('content')
    <x-app.banner :title="$chapter->translation?->name ?? $chapter->name">
        <p class='small m-0'>
            {{ $chapter->book->translation?->writer ?? $chapter->book->writer }}
            ({{ $chapter->book->writer_death_year }}H)
        </p>
        <p class="small m-0 mb-2">
            {{ __('app.chapter') }}: <strong>{{ $chapter->chapter_number }}</strong> •
            {{ __('app.hadiths') }}: <strong>{{ $chapter->verses->count() }}</strong>
        </p>

        <div class="search-bar input-group">
            <input type="search" class="form-control shadow-sm" placeholder="Search..." aria-label="Search" id="search"
                data-book="{{ $chapter->book->id }}">
            <button class="btn bg-warning" type="button" onclick="searchHadithByNumber()">
                <i class="fas fa-search"></i>
            </button>
        </div>

        <div id="google_translate_element" class="mt-2 mb-0"></div>
    </x-app.banner>

    <main class="container py-4">
        <article class="p-1 mb-2">
            @foreach ($verses as $item)
                @if ($item->heading)
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
                @endif

                <div class="row flex-column flex-md-row m-0 mb-1">
                    <div class="col-12 col-md-6 order-1 order-md-2 p-0 ps-md-4">
                        <div class="text-emerald-900 notranslate text-justify" style="font-size: 20px; line-height: 1.6;"
                            dir="rtl">
                            {{ $item->text }}
                            (<span class="fst-italic fs-6">{{ $verses->firstItem() + $loop->index }}</span>)
                        </div>
                    </div>

                    <div class="col-12 col-md-6 order-2 order-md-1 p-0">
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
                    <x-app.hr class="my-3"/>
                @endif
            @endforeach
        </article>

        <div class="d-flex justify-content-center mb-5 notranslate">
            {{ $verses->onEachSide(1)->links() }}
        </div>
    </main>
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
