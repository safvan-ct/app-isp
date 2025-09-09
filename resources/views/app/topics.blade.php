@extends('layouts.app')

@section('content')
    @php
        $topics = [
            // 'ശുദ്ധി',
            'നിസ്കാരം',
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

    <div class="topbar d-flex align-items-center justify-content-between notranslate">
        <a href="{{ route('home') }}" class="me-2">
            <i class="fas fa-chevron-left fs-3 text-secondary"></i>
        </a>
        <h6 class="fw-bold mb-0 text-emerald">{{ __('app.topics') }}</h6>

        <form class="d-flex ms-3">
            <div class="input-group input-group-sm">
                <input type="search" class="form-control" placeholder="Search topics..." aria-label="Search">
                <button class="btn bg-success-subtle" type="button"><i class="fas fa-search"></i></button>
            </div>
        </form>
    </div>

    <div class="app-header text-center bg-app">
        <h4 class="fw-bold mt-3 mb-1">{{ __('app.topics') }}</h4>
        <p class="text-muted m-0 mb-0">📖 അറിവ് തേടൂ, വിശ്വാസം വളർത്തൂ ✨</p>
    </div>

    <div class="container my-3 pb-5">
        <div class="row g-2">
            <div class="col-6 col-md-3">
                <div class="base-card d-flex flex-column h-100 justify-content-between rounded-3 border shadow-sm">
                    <a href="{{ route('questions.show', ['menu_slug' => 'festival', 'module_slug' => 1]) }}"
                        class="d-flex align-items-center text-decoration-none">
                        <div class="icon-thumb me-2 bg-success-subtle" style="width: 35px; height: 35px">
                            <i class="fa-regular fa-star"></i>
                        </div>
                        <h6 class="text-emerald-900 fw-bold m-0 small">നബിദിനം (റ. അവ്വൽ 12)</h6>
                    </a>
                </div>
            </div>

            {{-- <div class="col-6 col-md-3">
                <div class="base-card d-flex flex-column h-100 justify-content-between rounded-3 border shadow-sm">
                    <a href="{{ route('answers.show', ['menu_slug' => 'festival', 'module_slug' => 'meelad', 'question_slug' => 2]) }}"
                        class="d-flex align-items-center text-decoration-none">
                        <div class="icon-thumb me-2 bg-success-subtle" style="width: 35px; height: 35px">
                            <i class="fa-regular fa-star"></i>
                        </div>
                        <h6 class="text-emerald-900 fw-bold m-0 small">മൗലിദ് കൃതികൾ</h6>
                    </a>
                </div>
            </div> --}}

            @foreach ($topics as $item)
                <div class="col-6 col-md-3">
                    <div class="base-card d-flex flex-column h-100 justify-content-between rounded-3 border shadow-sm">
                        <a href="{{ route('answers.show', ['menu_slug' => 'festival', 'module_slug' => 'namaz', 'question_slug' => 0]) }}" class="d-flex align-items-center text-decoration-none">
                            <div class="icon-thumb me-2 bg-success-subtle" style="width: 35px; height: 35px">
                                <i class="fa-regular fa-star"></i>
                            </div>
                            <h6 class="text-emerald-900 fw-bold m-0 small">{{ $item }}</h6>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
