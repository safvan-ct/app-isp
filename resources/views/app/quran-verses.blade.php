@extends('layouts.app')

@section('content')
    <x-app.topbar :url="route('quran.index')">
        <x-slot:title>
            <span class="text-ar">{{ $chapter->name }}</span>
        </x-slot:title>
    </x-app.topbar>

    <div class="container my-3 pb-5">
        <x-app.banner :search="false">
            <x-slot:title>
                <span class="text-ar">سُورَةُ {{ $chapter->name }}</span> .1
            </x-slot:title>

            <p class="m-0 mt-2">
                {{ $chapter->translation?->name }} |

                <span class="small">
                    {{ $chapter->no_of_verses }} {{ __('app.ayahs') }} • {{ $chapter->revelation_place }}
                </span>
            </p>
        </x-app.banner>

        <div class="mt-2">
            @foreach ($chapter->verses as $item)
                <article class="base-card pt-4 mb-2 border rounded-2" tabindex="0" id="ayah-{{ $item->number_in_chapter }}">
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
