@extends('layouts.app')

@section('content')
    <div class="topbar d-flex align-items-center justify-content-between notranslate">
        <a href="{{ route('modules.show', 'festivel') }}" class="me-2">
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

    <div class="course-hero">
        <div class="course-details pb-2">
            <h3 class="m-0 text-center">{{ $questions['title'] }}</h3>
            <p class="small m-0 text-center"> {{ $questions['desc'] }} </p>
        </div>
    </div>

    <div class="container my-4 pb-5">
        <h6 class="fw-bold mt-4 mb-3 text-emerald">അനുബന്ധ വിഷയങ്ങൾ</h6>

        @foreach ($questions['chapters'] as $item)
            <a href="{{ route('answers.show', ['menu_slug' => 'festival', 'module_slug' => $questions['slug'], 'question_slug' => $loop->index]) }}"
                class="lesson-item text-decoration-none text-dark">
                <span>
                    <i class="fas fa-play-circle me-2"></i> {{ $loop->index + 1 }} : {{ $item }}
                </span>
            </a>
        @endforeach

        <div class="d-grid mt-4 d-none">
            <a href="topic.html" class="btn btn-primary btn-lg rounded-pill">Start Learning</a>
        </div>
    </div>
@endsection
