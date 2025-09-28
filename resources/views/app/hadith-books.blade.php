@extends('layouts.app')

@section('title', __('app.hadith'))
@section('navbar_title', __('app.hadith'))

@section('content')
    <x-app.banner :title="__('app.hadith_title')" :desc="'Canonical hadith books — authors, scope, and sample narrations. Search, filter, and open any book for details.'" />

    <main class="container py-4 notranslate">
        <div class="row g-2 mb-5">
            @foreach ($books as $item)
                <div class="col-12 col-sm-6 col-lg-4">
                    <div class="base-card d-flex flex-column h-100 justify-content-between rounded-2 border">
                        <div class="d-flex align-items-center mb-1">
                            @php
                                $slug = $item->slug;
                                $parts = explode('-', $slug);

                                $letters = array_map(function ($part) {
                                    return strtoupper(substr($part, 0, 1));
                                }, $parts);

                                $acronym = implode('', $letters);
                            @endphp
                            <div class="icon-thumb accent me-3">{{ $acronym }}</div>

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
