@extends('layouts.app')

@section('content')
    <div class="app-header">
        <h5 class="mb-1 text-dark fw-bold">Welcome back 👋</h5>
        <h4 class="fw-bold">
            <span class="text-emerald">Islamic</span>
            <span class="text-accent">Study Portal</span>
        </h4>
    </div>

    <div class="container my-4 pb-5">
        <div class="base-card mb-4 bg-geometry">
            <div class="text-center mx-auto">
                <h3 class="mb-3">{{ __('app.seek_knowledge') }}</h3>

                <div class="ayah-box mb-2 text-emerald">
                    <h5 class="text-ar">
                        <span class="mt-2">﴿ وَقُل رَّبِّ زِدْنِي عِلْمًا ﴾</span>
                        <em class="text-muted small"> - 20:114</em>
                    </h5>
                </div>

                <p class="text-muted mb-0">
                    Quran, Hadith and subjects — organized for focused, distraction-free learning.
                </p>
            </div>
        </div>

        <!-- Featured Courses -->
        <h5 class="m-0 text-emerald text-center">{{ __('app.foundational_subjects') }}</h5>
        <p class="text-center m-0">📖 അറിവ് തേടൂ, വിശ്വാസം വളർത്തൂ ✨</p>
        <div class="geo-divider my-1"></div>

        <div class="row g-3">
            <div class="col-6 col-md-4">
                <div class="base-card">
                    <div class="icon-box">🎉</div>
                    <h6 class="fw-bold m-0">
                        <a href="{{ route('questions.show', ['menu_slug' => 'festival', 'module_slug' => 1]) }}"
                            class="text-dark">
                            നബിദിനം (റ. അവ്വൽ 12)
                        </a>
                    </h6>
                    <p class="text-muted small m-0">3 Lessons</p>
                </div>
            </div>

            <div class="col-6 col-md-4">
                <div class="base-card">
                    <div class="icon-box">🎉</div>
                    <h6 class="fw-bold m-0">മൗലിദ് പാരായണം</h6>
                    <p class="text-muted small m-0">5 Lessons</p>
                </div>
            </div>
        </div>

        <h5 class="mb-3 mt-4 d-none">{{ __('app.explore_by_topics') }}</h5>
        <div class="d-flex gap-2 flex-wrap d-none">
            <span class="badge bg-primary-subtle text-primary rounded-pill px-3 py-2">Development</span>
            <span class="badge bg-success-subtle text-success rounded-pill px-3 py-2">Design</span>
            <span class="badge bg-warning-subtle text-warning rounded-pill px-3 py-2">Business</span>
            <span class="badge bg-danger-subtle text-danger rounded-pill px-3 py-2">Languages</span>
        </div>
    </div>
@endsection
