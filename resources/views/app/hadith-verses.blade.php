@extends('layouts.app')

@section('title', __('app.hadith'))
@section('navbar_title', __('app.hadith'))
@section('navbar_url', route('hadith.chapters', [$chapter->book->id]))

@section('content')
    <x-app.banner :title="$chapter->translation?->name ?? $chapter->name" :url="route('hadith.chapter.verses', ['book' => $chapter->book->slug, 'chapter' => $chapter->id])">
        <div class="small m-0 mb-2">
            <a class='m-0 p-0 text-dark' href="{{ route('hadith.chapters', [$chapter->book->id]) }}">
                {{ $chapter->book->translation?->name ?? $chapter->book->name }}
            </a> •
            {{ __('app.chapter') }}: <strong>{{ $chapter->chapter_number }}</strong> •
            {{ __('app.hadiths') }}: <strong>{{ $chapter->verses->count() }}</strong>
        </div>

        <x-app.search :books="$books" :book_id="$chapter->book->id" :search="$verseNumber ?? ''" />

        <div id="google_translate_element" class="mt-2 mb-0"></div>
    </x-app.banner>

    <main class="container px-1 px-sm-0 p-0 my-3 pb-3 pb-sm-0">
        @foreach ($verses as $item)
            <article class="p-2 py-3 mb-2 rounded-2 shadow-sm border border-gold">
                @if ($item->heading)
                    <div class="row flex-column flex-md-row m-0 mb-2">
                        <div class="col-12 col-md-6 order-1 order-md-2 p-0 ps-md-4">
                            <h6 class="text-black notranslate fw-bold fs-5 m-0 text-justify"
                                style="font-size: 22px; line-height: 1.6; font-family: 'Scheherazade New', serif;"
                                dir="rtl">
                                {{ $item->heading }}
                            </h6>
                        </div>

                        <div class="col-12 col-md-6 order-2 order-md-1 m-0 p-0">
                            <h6 class="fw-bold fs-6 m-0 text-justify" style="font-size: 17px;">
                                {{ $item->translation?->heading }}
                            </h6>
                        </div>
                    </div>
                @endif

                <div class="row flex-column flex-md-row m-0 mb-1">
                    <div class="col-12 col-md-6 order-1 order-md-2 p-0 ps-md-4">
                        <div class="text-black notranslate text-justify"
                            style="font-size: 19px; line-height: 1.8; font-family: 'Scheherazade New', serif;"
                            dir="rtl">
                            {{ $item->text }}
                            (<span class="fst-italic fs-6">{{ $verses->firstItem() + $loop->index }}</span>)
                        </div>
                    </div>

                    <div class="col-12 col-md-6 order-2 order-md-1 p-0">
                        <div class="text-en text-justify" style="font-size: 14px;">
                            {{ $item->translation?->text }}
                        </div>
                    </div>
                </div>


                <x-app.hr class="mt-3 mb-2" />
                <p class="text-muted small notranslate fst-italic m-0">
                    🔖 {{ $chapter->book->translation?->name ?? $chapter->book->name }},
                    {{ __('app.volume') }}: {{ $item->volume }},
                    {{ __('app.chapter') }}: {{ $chapter->translation?->name ?? $chapter->name }},
                    {{ __('app.hadith') }}: {{ $item->hadith_number }},
                    {{ __('app.status') }}: {{ __('app.' . strtolower($item->status)) }}
                </p>
            </article>
        @endforeach

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
