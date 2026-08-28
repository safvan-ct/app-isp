@extends('layouts.admin')

@push('styles')
    <style>
        .verse-banner-card {
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
            color: #ffffff;
            border-radius: 20px;
            padding: 1.75rem;
            box-shadow: 0 10px 30px rgba(15, 52, 96, 0.35);
            position: relative;
            overflow: hidden;
        }

        .verse-banner-card::before {
            content: "";
            position: absolute;
            right: -40px;
            top: -40px;
            width: 200px;
            height: 200px;
            background: rgba(255, 255, 255, 0.04);
            border-radius: 50%;
            pointer-events: none;
        }

        .verse-banner-card::after {
            content: "";
            position: absolute;
            left: -20px;
            bottom: -50px;
            width: 160px;
            height: 160px;
            background: rgba(255, 255, 255, 0.03);
            border-radius: 50%;
            pointer-events: none;
        }

        .arabic-verse-preview {
            font-family: 'Amiri', 'Traditional Arabic', serif;
            font-size: 1.1rem;
            direction: rtl;
            text-align: right;
            line-height: 2;
            color: rgba(255, 255, 255, 0.9);
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
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
            border-color: rgba(15, 52, 96, 0.15);
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

        .narrator-badge {
            background: rgba(255, 255, 255, 0.12);
            color: rgba(255, 255, 255, 0.85);
            border-radius: 20px;
            padding: 4px 12px;
            font-size: 0.8rem;
        }
    </style>
@endpush

@section('content')
    <x-admin.page-header title="Verse Translations" :breadcrumb="[
        ['label' => 'Dashboard', 'link' => route('admin.dashboard')],
        ['label' => 'Hadith Verses', 'link' => route('admin.hadith-verses.index')],
        ['label' => 'Translations'],
    ]" />

    {{-- Verse Banner Card --}}
    <div class="verse-banner-card mb-4">
        <div class="d-flex flex-wrap align-items-start justify-content-between gap-3">
            <div class="flex-grow-1">
                <div class="d-flex align-items-center gap-2 mb-2 flex-wrap">
                    <span class="badge bg-white text-dark fw-bold px-3 py-1 rounded-3">
                        Hadith #{{ $verse?->hadith_number }}
                    </span>
                    @if ($verse?->book)
                        <span class="badge bg-white bg-opacity-20 text-white rounded-pill px-3">
                            {{ $verse->book->abbreviation ?? $verse->book->name }}
                        </span>
                    @endif
                    @if ($verse?->chapter)
                        <span class="badge bg-white bg-opacity-15 text-white rounded-pill px-3">
                            CH #{{ $verse->chapter->chapter_number }}
                        </span>
                    @endif
                    @if ($verse?->volume)
                        <span class="badge bg-white bg-opacity-10 text-white rounded-pill px-3 font-monospace">
                            Vol. {{ $verse->volume }}
                        </span>
                    @endif
                    @if ($verse?->status)
                        <span class="badge bg-success bg-opacity-80 text-white rounded-pill px-3">
                            {{ ucfirst($verse->status) }}
                        </span>
                    @endif
                </div>

                @if ($verse?->heading)
                    <p class="text-white text-opacity-70 small mb-2 arabic-verse-preview">{{ $verse->heading }}</p>
                @endif

                @if ($verse?->text)
                    <div class="arabic-verse-preview">{{ $verse->text }}</div>
                @endif
            </div>

            <div class="d-flex align-items-center gap-3 flex-shrink-0">
                <div class="text-end d-none d-md-block">
                    <span class="d-block text-white text-opacity-75 small">Translations</span>
                    <h3 class="text-white fw-bold mb-0">{{ $translations->count() }}</h3>
                </div>

                <a href="{{ route('admin.hadith-verses.index') }}" class="btn btn-light rounded-3 fw-semibold shadow-sm">
                    <i class="ti ti-arrow-left me-1"></i> Back
                </a>
            </div>
        </div>
    </div>

    <div class="row g-4">
        {{-- Form: Create or Edit Translation --}}
        <div class="col-lg-5">
            <div class="form-card p-4">
                <div class="d-flex align-items-center justify-content-between mb-3 pb-3 border-bottom">
                    <div>
                        <h5 class="fw-bold mb-0 text-dark">
                            {{ $translation?->id ? 'Edit Translation' : 'Add New Translation' }}
                        </h5>
                        <small class="text-muted">Localized content for Hadith #{{ $verse?->hadith_number }}</small>
                    </div>

                    @if ($translation?->id)
                        <a href="{{ route('admin.hadith-verse-translations.index', [$verse->id]) }}"
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
                        ? route('admin.hadith-verse-translations.update', $translation->id)
                        : route('admin.hadith-verse-translations.store');
                    $method = $translation?->id ? 'PUT' : 'POST';
                @endphp

                <form class="row g-3 needs-validation" novalidate action="{{ $url }}" method="POST">
                    @csrf
                    @method($method)
                    <input type="hidden" name="hadith_verse_id" value="{{ $verse?->id }}">

                    <div class="col-12">
                        <label class="form-label fw-semibold">Language <span class="text-danger">*</span></label>
                        <select class="form-select rounded-3 @error('lang') is-invalid @enderror" name="lang" required
                            {{ $translation?->id ? 'disabled' : '' }}>
                            <option value="">Select language</option>
                            @foreach (config('app.languages') as $key => $langName)
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
                        <label class="form-label fw-semibold">Narrator</label>
                        <input type="text" class="form-control rounded-3" name="narrator"
                            value="{{ old('narrator', $translation?->narrator) }}" placeholder="e.g. Abu Huraira">
                        <small class="text-muted">Name of the hadith narrator in the target language.</small>
                    </div>

                    <div class="col-12">
                        <label class="form-label fw-semibold">Heading</label>
                        <input type="text" class="form-control rounded-3 @error('heading') is-invalid @enderror"
                            name="heading" value="{{ old('heading', $translation?->heading) }}"
                            placeholder="Chapter/section heading for this hadith">
                    </div>

                    <div class="col-12">
                        <label class="form-label fw-semibold">Hadith Text <span class="text-danger">*</span></label>
                        <textarea class="form-control rounded-3 @error('text') is-invalid @enderror" name="text" rows="8" required
                            placeholder="Full hadith text in the selected language...">{{ old('text', $translation?->text) }}</textarea>
                        <div class="invalid-feedback">Hadith text is required.</div>
                    </div>

                    <div class="col-12">
                        <label class="form-label fw-semibold">Status (Romanized)</label>
                        <input type="text" class="form-control rounded-3" name="status_romanized"
                            value="{{ old('status_romanized', $translation?->status_romanized) }}"
                            placeholder="e.g. Sahih, Hasan, Da'if">
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

        {{-- Translations List --}}
        <div class="col-lg-7">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-header border-0 bg-white pt-4 px-4 pb-0 d-flex align-items-center justify-content-between">
                    <div>
                        <h5 class="fw-bold text-dark mb-0">Translation List</h5>
                        <p class="text-muted small mb-0">Available translations for Hadith #{{ $verse?->hadith_number }}
                        </p>
                    </div>
                    <span class="badge bg-light-primary text-primary fw-bold px-3 py-2 rounded-3">
                        {{ $translations->count() }} Available
                    </span>
                </div>

                <div class="card-body p-4">
                    <div class="d-flex flex-column gap-3">
                        @forelse ($translations as $item)
                            @php
                                $langClass = match ($item->lang) {
                                    'en' => 'badge-lang-en',
                                    'ar' => 'badge-lang-ar',
                                    'ml' => 'badge-lang-ml',
                                    default => 'badge-lang-default',
                                };
                            @endphp

                            <div class="translation-card p-3">
                                <div class="d-flex align-items-start justify-content-between gap-3">
                                    <div class="d-flex align-items-start gap-3 flex-grow-1">
                                        <span
                                            class="badge-lang {{ $langClass }} mt-1 flex-shrink-0">{{ $item->lang }}</span>

                                        <div class="flex-grow-1">
                                            @if ($item->narrator)
                                                <p class="text-muted small mb-1 fw-semibold">
                                                    <i class="ti ti-user me-1"></i> {{ $item->narrator }}
                                                </p>
                                            @endif

                                            @if ($item->heading)
                                                <h6 class="fw-bold text-dark mb-1">{{ Str::limit($item->heading, 80) }}
                                                </h6>
                                            @endif

                                            @if ($item->text)
                                                <p class="text-muted small mb-1">
                                                    {{ Str::limit($item->text, 160) }}
                                                </p>
                                            @endif

                                            @if ($item->status_romanized)
                                                <span
                                                    class="badge bg-light text-secondary font-monospace">{{ $item->status_romanized }}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="d-flex align-items-center gap-2 flex-shrink-0">
                                        <div class="form-check form-switch custom-switch mb-0" title="Toggle Active">
                                            <input class="form-check-input" type="checkbox" role="switch"
                                                {{ $item->is_active ? 'checked' : '' }}
                                                onchange="toggleActive('{{ route('admin.hadith-verse-translations.status', $item->id) }}')">
                                        </div>
                                        <a href="{{ route('admin.hadith-verse-translations.index', [$verse->id, $item->id]) }}"
                                            class="btn btn-sm {{ $translation?->id == $item->id ? 'btn-primary' : 'btn-light-secondary' }} rounded-3">
                                            <i class="ti ti-edit me-1"></i> Edit
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-5">
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
