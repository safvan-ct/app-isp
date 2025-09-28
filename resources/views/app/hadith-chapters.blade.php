@extends('layouts.app')

@section('title', __('app.hadith'))
@section('navbar_title', __('app.hadith'))
@section('navbar_url', route('hadith.index'))

@section('content')
    <x-app.banner :title="$book->translation?->name ?? $book->name" :desc="($book->translation?->writer ?? $book->writer) . ' (' . $book->writer_death_year . 'H)'">
        <p class="small m-0 mb-2">
            {{ __('app.hadiths') }}: <strong>{{ $book->hadith_count }}</strong> •
            {{ __('app.chapters') }}: <strong>{{ $book->chapter_count }}</strong>
        </p>

        <div class="search-bar input-group">
            <input type="search" class="form-control shadow-sm" placeholder="Search..." aria-label="Search" id="search"
                data-book="{{ $book->id }}">
            <button class="btn bg-warning" type="button" onclick="searchHadithByNumber()">
                <i class="fas fa-search"></i>
            </button>
        </div>
    </x-app.banner>

    <main class="container py-4 notranslate">
        <div class="row g-2 mb-5">
            @foreach ($book->chapters as $chapter)
                <div class="col-md-6 col-lg-4 all-chapters"
                    onclick="window.location.href = '{{ route('hadith.chapter.verses', ['book' => $book->slug, 'chapter' => $chapter->id]) }}'"
                    style="cursor: pointer">
                    <div class="base-card d-flex justify-content-between align-items-center flex-row rounded-2 border border-success shadow-none"
                        data-surah="{{ $chapter->id }}">
                        <div class="d-flex gap-3 align-items-center">
                            <div class="icon-thumb accent text-emerald-900 text-shadow" style="width: 36px; height: 36px">
                                {{ $chapter->chapter_number }}
                            </div>

                            <div class="flex-1">
                                <h6 class="text-emerald fw-bold m-0">{{ $chapter->translation?->name }}</h6>
                                <p class="text-muted m-0 small">{{ $chapter->translation?->translation }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </main>
@endsection
