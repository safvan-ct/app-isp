@extends('layouts.app')

@section('title', __('app.hadith'))
@section('navbar_title', __('app.hadith'))
@section('navbar_url', route('hadith.index'))

@section('content')
    <x-app.banner :title="$book->translation?->name ?? $book->name">
        <p class="small m-0 mb-2">
            {{ $book->translation?->writer ?? $book->writer }}
            <span class="text-muted">({{ $book->writer_death_year }}H)</span> •
            {{ __('app.hadiths') }}: <strong>{{ $book->hadith_count }}</strong> •
            {{ __('app.chapters') }}: <strong>{{ $book->chapter_count }}</strong>
        </p>

        <x-app.search :books="$books" :book_id="$book->id" />
    </x-app.banner>

    <main class="container px-1 px-sm-0 p-0 my-3 pb-3 pb-sm-0 notranslate">
        <div class="row g-2 mb-5">
            @foreach ($book->chapters as $chapter)
                <div class="col-md-6 col-lg-4 all-chapters"
                    onclick="window.location.href = '{{ route('hadith.chapter.verses', ['book' => $book->slug, 'chapter' => $chapter->id]) }}'"
                    style="cursor: pointer">
                    <div class="base-card d-flex justify-content-between align-items-center flex-row rounded-2 border border-gold shadow-sm"
                        data-surah="{{ $chapter->id }}">
                        <div class="d-flex gap-3 align-items-center">
                            <div class="icon-thumb dark text-black text-shadow" style="width: 36px; height: 36px">
                                {{ $chapter->chapter_number }}
                            </div>

                            <div class="flex-1">
                                <h6 class="text-dark fw-bold m-0">{{ $chapter->translation?->name }}</h6>
                                <p class="text-muted m-0 small">{{ $chapter->translation?->translation }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </main>
@endsection
