@extends('layouts.app')

@section('title', __('app.hadith'))
@section('navbar_title', __('app.hadith'))

@section('content')
    <x-app.banner :title="__('app.hadith_title')" :desc="'തിരുസുന്നത്തിലൂടെ വിജയപഥത്തിലേക്ക്: പ്രവാചക വചനങ്ങളുടെ സമ്പൂർണ്ണ ഡിജിറ്റൽ ശേഖരം.'">
        <div class="py-1"></div>
        <x-app.search :books="$books" />
    </x-app.banner>

    <main class="container px-1 px-sm-0 p-0 my-3 pb-3 pb-sm-0 notranslate">
        <div class="row g-2 mb-5">
            @foreach ($books as $item)
                <div class="col-12 col-sm-6 col-lg-4 {{ $loop->remaining < 3 ? 'mb-4' : '' }}">
                    <div class="base-card d-flex flex-column h-100 justify-content-between rounded-2 border border-gold">
                        <div class="d-flex align-items-center mb-1">
                            @php
                                $ignore = ['the', 'of', 'and', 'in'];
                                $string = $item->slug;
                                $words = explode('-', $string);
                                $acronym = '';

                                foreach ($words as $word) {
                                    if (!in_array(strtolower($word), $ignore)) {
                                        $acronym .= strtoupper($word[0]);
                                    }
                                }
                            @endphp

                            <div class="icon-thumb accent me-3">{{ $acronym }}</div>

                            <div class="flex-1">
                                <h6 class="text-black fw-bold m-0">{{ $item->translation?->name ?: $item->name }}</h6>
                                <p class="small m-0">
                                    {{ $item->translation?->writer ?: $item->writer }}
                                    {{ $item->writer_death_year ? "({$item->writer_death_year}H)" : '' }}
                                </p>
                            </div>
                        </div>

                        <p class="small text-muted mb-2">
                            {{ __('app.hadiths') }}: <strong>{{ $item->hadith_count }}</strong> •
                            {{ __('app.chapters') }}: <strong>{{ $item->chapter_count }}</strong>
                        </p>

                        <div class="d-flex justify-content-end gap-2">
                            <a class="btn btn-sm btn-outline-dark" href="{{ route('hadith.chapters', [$item->id]) }}">
                                {{ __('app.chapters') }}
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endsection
