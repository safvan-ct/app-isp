@extends('layouts.app')

@section('content')
    <div class="topbar d-flex align-items-center justify-content-between">
        <a href="{{ route('home') }}" class="me-2"><i class="fas fa-chevron-left fs-3 text-secondary"></i></a>
        <h6 class="fw-bold mb-0 text-emerald">{{ __('app.quran') }}</h6>

        <form class="d-flex ms-3">
            <div class="input-group input-group-sm">
                <input type="search" class="form-control" placeholder="Search surah..." aria-label="Search">
                <button class="btn bg-success-subtle" type="button"><i class="fas fa-search"></i></button>
            </div>
        </form>
    </div>

    <div class="container my-3 pb-5">
        <div class="row g-2">
            @foreach ($chapters as $chapter)
                <div class="col-md-6 col-lg-4" style="cursor: pointer"
                    onclick="window.location.href = '{{ route('quran.chapter', $chapter->id) }}'">
                    <div class="base-card d-flex justify-content-between align-items-center flex-row rounded-0"
                        data-surah="{{ $chapter->id }}">
                        <div class="d-flex gap-3 align-items-center">
                            <div class="number-box"><span>{{ $chapter->id }}</span></div>

                            <div>
                                <h6 class="text-emerald fw-bold m-0">{{ $chapter->translation?->name }}</h6>
                                <p class="text-muted m-0 small">{{ $chapter->translation?->translation }}</p>
                            </div>
                        </div>

                        <div class="justify-content-end">
                            <p class="text-ar m-0">{{ $chapter->name }}</p>
                            <p class="small m-0 text-muted">{{ $chapter->no_of_verses }} Ayahs</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
