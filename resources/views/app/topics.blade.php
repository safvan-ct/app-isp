@extends('layouts.app')

@section('content')
    <div class="topbar d-flex align-items-center justify-content-between notranslate">
        <a href="{{ route('home') }}" class="me-2">
            <i class="fas fa-chevron-left fs-3 text-secondary"></i>
        </a>
        <h6 class="fw-bold mb-0 text-emerald">{{ __('app.topics') }}</h6>

        <form class="d-flex ms-3">
            <div class="input-group input-group-sm">
                <input type="search" class="form-control" placeholder="Search topics..." aria-label="Search">
                <button class="btn btn-secondary" type="button"><i class="fas fa-search"></i></button>
            </div>
        </form>
    </div>

    <div class="app-header text-center bg-app">
        <h4 class="fw-bold mt-3 mb-1">{{ __('app.topics') }}</h4>
        <p class="text-muted m-0 mb-0">📖 അറിവ് തേടൂ, വിശ്വാസം വളർത്തൂ ✨</p>
    </div>

    <div class="container my-3 pb-5">
        <div class="row g-3">
            <div class="col-6 col-md-4">
                <div class="base-card">
                    <div class="icon-box">🎉</div>
                    <h6 class="fw-bold">
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
                    <h6 class="fw-bold text-tr">മൗലിദ് പാരായണം</h6>
                    <p class="text-muted small m-0">5 Lessons</p>
                </div>
            </div>
        </div>
    </div>
@endsection
