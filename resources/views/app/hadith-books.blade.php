@extends('layouts.app')

@section('content')
    <div class="topbar d-flex align-items-center justify-content-between">
        <a href="{{ route('home') }}" class="me-2"><i class="fas fa-chevron-left fs-3 text-secondary"></i></a>
        <h6 class="fw-bold mb-0 text-emerald">{{ __('app.hadith') }}</h6>

        <form class="d-flex ms-3">
            <div class="input-group input-group-sm">
                <input type="search" class="form-control" placeholder="Search books..." aria-label="Search">
                <button class="btn btn-secondary" type="button"><i class="fas fa-search"></i></button>
            </div>
        </form>
    </div>

    <div class="app-header text-center bg-app">
        <h5 class="fw-bold text-emerald mt-3">{{ __('app.hadith_title') }}</h5>
        <p class="text-muted mb-0 small">
            Canonical hadith books — authors, scope, and sample narrations. Search, filter, and open any book for
            details.
        </p>
    </div>

    <div class="container my-4 pb-5">
        <div class="row g-2">
            @foreach ($books as $item)
                <div class="col-12 col-sm-6 col-lg-4">
                    <div class="base-card d-flex flex-column h-100 justify-content-between rounded-2">
                        <div class="d-flex align-items-center mb-1">
                            <div class="icon-thumb me-3">HB</div>

                            <div class="flex-1">
                                <h6 class="text-emerald-900 fw-bold m-0">{{ $item->translation?->name ?: $item->name }}</h6>
                                <p class="small m-0">{{ $item->translation?->writer ?: $item->writer }}
                                    ({{ $item->writer_death_year }}H)
                                </p>
                            </div>
                        </div>

                        <p class="small text-muted mb-2">
                            {{ __('app.hadiths') }}: <strong>{{ $item->hadith_count }}</strong> •
                            {{ __('app.chapters') }}: <strong>{{ $item->chapter_count }}</strong>
                        </p>

                        <div class="d-flex justify-content-end gap-2">
                            <button class="btn btn-sm btn-outline-secondary btn-open"
                                onclick="openBook({{ $item->id }})">
                                Details
                            </button>
                            <a class="btn btn-sm btn-outline-warning" href="{{ route('hadith.chapters', [$item->id]) }}">
                                Open
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
