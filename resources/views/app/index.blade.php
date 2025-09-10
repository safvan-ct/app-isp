@extends('layouts.app')

@section('content')
    @php
        $topics = [
            // 'ശുദ്ധി',
            'namaz' => 'നിസ്കാരം',
            // 'നോമ്പ്',
            // 'സകാത്',
            // 'ഹജ്ജ്',
            // 'വിശ്വാസം',
            // 'വിവാഹം',
            // 'അഖീഖത്',
            // 'ഈദ് (പെരുന്നാൾ)',
            // 'അറിവ് (വിദ്യാഭ്യാസം)',
            // 'മരണം & ചടങ്ങുകൾ ',
            // 'ജീവിത ശൈലി',
            // 'സമ്പാദ്യം',
        ];
    @endphp

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

        <div class="row g-2">
            <div class="col-6 col-md-3">
                <div class="base-card d-flex flex-column h-100 justify-content-between rounded-3 border shadow-sm">
                    <a href="{{ route('questions.show', ['menu_slug' => 'festival', 'module_slug' => 'meelad']) }}"
                        class="d-flex align-items-center text-decoration-none">
                        <div class="icon-thumb me-2 bg-success-subtle" style="width: 35px; height: 35px">
                            <i class="fa-regular fa-star"></i>
                        </div>
                        <h6 class="text-emerald-900 fw-bold m-0 small">നബിദിനം (റ. അവ്വൽ 12)</h6>
                    </a>
                </div>
            </div>

            @foreach ($topics as $key => $item)
                <div class="col-6 col-md-3">
                    <div class="base-card d-flex flex-column h-100 justify-content-between rounded-3 border shadow-sm">
                        <a href="{{ route('questions.show', ['menu_slug' => 'topic', 'module_slug' => $key]) }}"
                            class="d-flex align-items-center text-decoration-none">
                            <div class="icon-thumb me-2 bg-success-subtle" style="width: 35px; height: 35px">
                                <i class="fa-regular fa-star"></i>
                            </div>
                            <h6 class="text-emerald-900 fw-bold m-0 small">{{ $item }}</h6>
                        </a>
                    </div>
                </div>
            @endforeach
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
