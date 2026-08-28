@extends('layouts.admin')

@push('styles')
    <style>
        .chapter-banner-card {
            background: linear-gradient(135deg, #0f4c81 0%, #1a6bb5 60%, #2196f3 100%);
            color: #ffffff;
            border-radius: 20px;
            padding: 1.75rem;
            box-shadow: 0 10px 25px rgba(15, 76, 129, 0.25);
            position: relative;
            overflow: hidden;
        }

        .chapter-banner-card::before {
            content: "";
            position: absolute;
            right: -50px;
            top: -50px;
            width: 200px;
            height: 200px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 50%;
            pointer-events: none;
        }

        .chapter-banner-card::after {
            content: "";
            position: absolute;
            left: -20px;
            bottom: -40px;
            width: 150px;
            height: 150px;
            background: rgba(255, 255, 255, 0.04);
            border-radius: 50%;
            pointer-events: none;
        }

        .badge-lang {
            padding: 6px 14px;
            border-radius: 10px;
            font-weight: 700;
            letter-spacing: 0.5px;
            font-size: 0.8rem;
            text-transform: uppercase;
        }

        .badge-lang-en {
            background: #e0e7ff;
            color: #3730a3;
        }

        .badge-lang-ar {
            background: #fef3c7;
            color: #92400e;
        }

        .badge-lang-ml {
            background: #dcfce7;
            color: #166534;
        }

        .badge-lang-default {
            background: #f3f4f6;
            color: #374151;
        }

        .translation-card {
            border: 1px solid rgba(0, 0, 0, 0.06);
            border-radius: 16px;
            background: #ffffff;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.03);
            transition: all 0.25s ease;
        }

        .translation-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
            border-color: rgba(33, 150, 243, 0.2);
        }

        .custom-switch .form-check-input {
            width: 2.75em;
            height: 1.4em;
            cursor: pointer;
        }

        .form-card {
            border-radius: 20px;
            border: 1px solid #f0f0f0;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
            background: #ffffff;
        }
    </style>
@endpush

@section('content')
    <x-admin.page-header title="Chapter Translations" :breadcrumb="[
        ['label' => 'Dashboard', 'link' => route('admin.dashboard')],
        ['label' => 'Chapters', 'link' => route('admin.hadith-chapters.index')],
        ['label' => $chapter->name ?? 'Chapter'],
    ]" />

    {{-- Parent Chapter Details Banner --}}
    <div class="chapter-banner-card mb-4">
        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
            <div>
                <div class="d-flex align-items-center gap-2 mb-2">
                    <span class="badge bg-white text-primary fw-bold px-3 py-1 rounded-3">
                        CH #{{ $chapter->chapter_number }}
                    </span>
                    @if ($chapter->book)
                        <span class="badge bg-white bg-opacity-20 text-white rounded-pill px-3">
                            {{ $chapter->book->abbreviation ?? $chapter->book->name }}
                        </span>
                    @endif
                </div>

                <h2 class="fw-bold text-white mb-1 font-arabic" dir="rtl">{{ $chapter->name }}</h2>
                <p class="text-white text-opacity-75 mb-0">
                    <i class="ti ti-subtitles me-1"></i> {{ number_format($chapter->hadith_count ?? 0) }} Hadiths
                    @if ($chapter->slug)
                        <span
                            class="ms-3 badge bg-white bg-opacity-10 text-white font-monospace">{{ $chapter->slug }}</span>
                    @endif
                </p>
            </div>

            <div class="d-flex align-items-center gap-3">
                <div class="text-end d-none d-md-block">
                    <span class="d-block text-white text-opacity-75 small">Translations</span>
                    <h3 class="text-white fw-bold mb-0">{{ $translations->count() }}</h3>
                </div>

                <a href="{{ route('admin.hadith-chapters.index') }}" class="btn btn-light rounded-3 fw-semibold shadow-sm">
                    <i class="ti ti-arrow-left me-1"></i> Back to Chapters
                </a>
            </div>
        </div>
    </div>

    <div class="row g-4">
        {{-- Form Section: Create or Edit Translation --}}
        <div class="col-lg-5">
            <div class="form-card p-4">
                <div class="d-flex align-items-center justify-content-between mb-3 pb-3 border-bottom">
                    <div>
                        <h5 class="fw-bold mb-0 text-dark">
                            {{ $translation?->id ? 'Edit Translation' : 'Add New Translation' }}
                        </h5>
                        <small class="text-muted">Manage localized content for this chapter</small>
                    </div>

                    @if ($translation?->id)
                        <a href="{{ route('admin.hadith-chapter-translations.index', [$chapter->id]) }}"
                            class="btn btn-sm btn-light-secondary rounded-pill">
                            <i class="ti ti-plus me-1"></i> New
                        </a>
                    @endif
                </div>

                <x-admin.alert type="success" />
                <x-admin.alert type="error" />

                @if ($errors->any())
                    <div class="alert alert-danger rounded-3 mb-3">
                        <ul class="mb-0 ps-3">
                            @foreach ($errors->all() as $error)
                                <li class="small">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @php
                    $url = $translation?->id
                        ? route('admin.hadith-chapter-translations.update', $translation->id)
                        : route('admin.hadith-chapter-translations.store');

                    $method = $translation?->id ? 'PUT' : 'POST';
                @endphp

                <form class="row g-3 needs-validation" novalidate action="{{ $url }}" method="POST">
                    @csrf
                    @method($method)

                    <input type="hidden" name="hadith_chapter_id" value="{{ $chapter->id }}">

                    <div class="col-12">
                        <label for="lang" class="form-label fw-semibold">Language <span
                                class="text-danger">*</span></label>
                        <select class="form-select rounded-3 @error('lang') is-invalid @enderror" name="lang" required
                            {{ $translation?->id ? 'disabled' : '' }}>
                            <option value="">Select language</option>
                            @foreach (config('app.languages') as $key => $langName)
                                @continue($key == 'ar')
                                <option value="{{ $key }}"
                                    {{ old('lang', $translation?->lang) == $key ? 'selected' : '' }}>
                                    {{ $langName }} ({{ strtoupper($key) }})
                                </option>
                            @endforeach
                        </select>
                        @if ($translation?->id)
                            <input type="hidden" name="lang" value="{{ $translation->lang }}">
                        @endif
                        <div class="invalid-feedback">Please select a language.</div>
                    </div>

                    <div class="col-12">
                        <label for="name" class="form-label fw-semibold">Chapter Title <span
                                class="text-danger">*</span></label>
                        <input type="text" class="form-control rounded-3 @error('name') is-invalid @enderror"
                            name="name" id="name" value="{{ old('name', $translation?->name) }}"
                            placeholder="Localized chapter title" required>
                        <div class="invalid-feedback">Chapter title is required.</div>
                    </div>

                    <div class="col-12">
                        <label for="name_romanized" class="form-label fw-semibold">Title (Romanized)</label>
                        <input type="text" class="form-control rounded-3" name="name_romanized" id="name_romanized"
                            value="{{ old('name_romanized', $translation?->name_romanized) }}"
                            placeholder="e.g. Babu fi salat al-fajr">
                        <small class="text-muted">Transliteration of the Arabic/original title.</small>
                    </div>

                    <div class="col-12">
                        <label for="description" class="form-label fw-semibold">Description</label>
                        <textarea class="form-control rounded-3" name="description" id="description" rows="4"
                            placeholder="Chapter overview, context or notes...">{{ old('description', $translation?->description) }}</textarea>
                    </div>

                    <div class="col-12 text-end pt-2">
                        <button class="btn btn-primary rounded-3 px-4 shadow-sm" type="submit">
                            <i class="ti ti-device-floppy me-1"></i>
                            {{ $translation?->id ? 'UPDATE TRANSLATION' : 'SAVE TRANSLATION' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Existing Translations Cards Section --}}
        <div class="col-lg-7">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-header border-0 bg-white pt-4 px-4 pb-0 d-flex align-items-center justify-content-between">
                    <div>
                        <h5 class="fw-bold text-dark mb-0">Translations List</h5>
                        <p class="text-muted small mb-0">All available language translations for this chapter</p>
                    </div>

                    <span class="badge bg-light-primary text-primary fw-bold px-3 py-2 rounded-3">
                        {{ $translations->count() }} Available
                    </span>
                </div>

                <div class="card-body p-4">
                    <div class="row g-3">
                        @forelse ($translations as $item)
                            @php
                                $langClass = match ($item->lang) {
                                    'en' => 'badge-lang-en',
                                    'ar' => 'badge-lang-ar',
                                    'ml' => 'badge-lang-ml',
                                    default => 'badge-lang-default',
                                };
                                $langLabel = config("app.languages.{$item->lang}", strtoupper($item->lang));
                            @endphp

                            <div class="col-12">
                                <div class="translation-card p-3">
                                    <div class="d-flex align-items-start justify-content-between gap-3">
                                        <div class="d-flex align-items-start gap-3 flex-grow-1">
                                            <span
                                                class="badge-lang {{ $langClass }} mt-1 flex-shrink-0">{{ $item->lang }}</span>

                                            <div class="flex-grow-1">
                                                <h6 class="fw-bold text-dark mb-1">{{ $item->name }}</h6>

                                                @if ($item->name_romanized)
                                                    <p class="text-muted small mb-1 font-monospace">
                                                        <i class="ti ti-language me-1"></i> {{ $item->name_romanized }}
                                                    </p>
                                                @endif

                                                @if ($item->description)
                                                    <p class="text-muted small mb-0 text-truncate"
                                                        style="max-width: 320px;">
                                                        {{ $item->description }}
                                                    </p>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="d-flex align-items-center gap-2 flex-shrink-0">
                                            <div class="form-check form-switch custom-switch mb-0" title="Toggle Active">
                                                <input class="form-check-input" type="checkbox" role="switch"
                                                    {{ $item->is_active ? 'checked' : '' }}
                                                    onchange="toggleActive('{{ route('admin.hadith-chapter-translations.status', $item->id) }}')">
                                            </div>

                                            <a href="{{ route('admin.hadith-chapter-translations.index', [$chapter->id, $item->id]) }}"
                                                class="btn btn-sm {{ $translation?->id == $item->id ? 'btn-primary' : 'btn-light-secondary' }} rounded-3">
                                                <i class="ti ti-edit me-1"></i> Edit
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12 text-center py-5">
                                <i class="ti ti-language text-muted display-4 d-block mb-2"></i>
                                <h6 class="text-muted">No translations added yet.</h6>
                                <p class="text-muted small">Use the form on the left to add a translation.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Bootstrap 5 form validation
        (function() {
            'use strict';
            var forms = document.querySelectorAll('.needs-validation');
            Array.prototype.slice.call(forms).forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        })();
    </script>
@endpush
