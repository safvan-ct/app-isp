@extends('layouts.app')

@section('content')
    <div class="topbar d-flex align-items-center justify-content-between">
        <a href="{{ route('quran.index') }}" class="me-2"><i class="fas fa-chevron-left fs-3 text-secondary"></i></a>
        <h6 class="fw-bold mb-0 text-emerald text-ar">{{ $chapter->name }}</h6>

        <form class="d-flex ms-3">
            <div class="input-group input-group-sm">
                <input type="search" class="form-control" placeholder="Search ayah..." aria-label="Search">
                <button class="btn bg-success-subtle" type="button"><i class="fas fa-search"></i></button>
            </div>
        </form>
    </div>

    <!-- App Header -->
    <div class="app-header text-center bg-app">
        <h4 class="fw-bold text-emerald text-ar mt-3">سُورَةُ {{ $chapter->name }} .1</h4>
        <p class="text-dark m-0 mb-0 text-tr">{{ $chapter->translation?->name }} |
            <span class="text-muted small">
                {{ $chapter->no_of_verses }} {{ __('app.ayahs') }} •
                {{ $chapter->revelation_place }}
            </span>
        </p>
    </div>

    <div class="container my-4 pb-5">
        <div class="mt-2">
            @foreach ($chapter->verses as $item)
                <article class="base-card pt-4 mb-2" tabindex="0" id="ayah-{{ $item->number_in_chapter }}">
                    <h4 class="text-ar mb-2 text-emerald-900 lh-xl">
                        {{ $item->text }}
                        <span dir="rtl" class="ar-number fs-6">﴿{{ $item->number_in_chapter }}﴾</span>
                    </h4>

                    @if ($item->translation)
                        <p class="mb-2">{{ $item->translation->text }} ({{ $item->number_in_chapter }})</p>
                    @endif

                    <div class="d-flex gap-2 align-items-center justify-content-end">
                        <button class="btn btn-sm btn-outline-success play-btn" title="Play Ayah"
                            data-surah="{{ $chapter->id }}" data-ayah="{{ $item->number_in_chapter }}">
                            <i class="far fa-play-circle"></i>
                        </button>
                        <button class="btn btn-sm btn-outline-warning bookmark-btn" title="Bookmark Ayah"
                            data-id="{{ $item->id }}" data-type="quran">
                            <i class="far fa-star"></i>
                        </button>
                        <button class="btn btn-sm btn-outline-danger like-btn" title="Like Ayah"
                            data-id="{{ $item->id }}" data-type="quran">
                            <i class="far fa-heart"></i>
                        </button>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
@endsection
