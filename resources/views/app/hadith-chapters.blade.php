@extends('layouts.app')

@section('content')
    <div class="topbar d-flex align-items-center justify-content-between">
        <a href="{{ route('hadith.index') }}" class="me-2"><i class="fas fa-chevron-left fs-3 text-secondary"></i></a>
        <h6 class="fw-bold mb-0 text-emerald">{{ __('app.chapters') }}</h6>

        <form class="d-flex ms-3">
            <div class="input-group input-group-sm">
                <input type="search" class="form-control" placeholder="Search chapters..." aria-label="Search" id="search" data-book="{{ $book->id }}">
                <button class="btn bg-success-subtle" type="button" onclick="searchHadithByNumber()">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </form>
    </div>

    <div class="app-header text-center bg-app">
        <h5 class="fw-bold text-emerald m-0 mt-3 mb-1">{{ $book->translation?->name ?? $book->name }}</h5>
        <p class="small m-0 text-dark">
            {{ $book->translation?->writer ?? $book->writer }} ({{ $book->writer_death_year }}H)
        </p>
        <p class="small text-muted m-0">
            {{ __('app.hadiths') }}: <strong>{{ $book->hadith_count }}</strong> •
            {{ __('app.chapters') }}: <strong>{{ $book->chapter_count }}</strong>
        </p>
    </div>

    <div class="container my-4 pb-5">
        <section class="row g-2">
            @foreach ($book->chapters as $chapter)
                <div class="col-md-6 col-lg-4 all-chapters"
                    onclick="window.location.href = '{{ route('hadith.chapter.verses', ['book' => $book->slug, 'chapter' => $chapter->id]) }}'"
                    style="cursor: pointer">
                    <div class="base-card d-flex justify-content-between align-items-center flex-row rounded-2"
                        data-surah="{{ $chapter->id }}">
                        <div class="d-flex gap-3 align-items-center">
                            <div class="rounded-circle bg-warning-subtle d-flex justify-content-center align-items-center fw-bold fs-6 flex-shrink-0"
                                style="width: 36px; height: 36px;">
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
        </section>
    </div>
@endsection
