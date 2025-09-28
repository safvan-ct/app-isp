@extends('layouts.app')

@section('title', __('app.quran'))
@section('navbar_title', __('app.quran'))

@section('content')
    <main class="container py-4 notranslate">
        <div class="row g-2 mb-5">
            @foreach ($chapters as $chapter)
                <div class="col-md-6 col-lg-4" style="cursor: pointer"
                    onclick="window.location.href = '{{ route('quran.chapter', $chapter->id) }}'">
                    <div class="base-card d-flex justify-content-between align-items-center flex-row rounded-0 border border-success shadow-none"
                        data-surah="{{ $chapter->id }}">
                        <div class="d-flex gap-3 align-items-center">
                            <div class="number-box"><span>{{ $chapter->id }}</span></div>

                            <div>
                                <h6 class="text-emerald fw-bold m-0">{{ $chapter->translation?->name }}</h6>
                                <p class="text-muted m-0 small">{{ $chapter->translation?->translation }}</p>
                            </div>
                        </div>

                        <div class="justify-content-end">
                            <p class="text-ar m-0 text-accent-900">{{ $chapter->name }}</p>
                            <p class="small m-0 text-muted">{{ $chapter->no_of_verses }} Ayahs</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </main>
@endsection
