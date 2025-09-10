@extends('layouts.app')

@section('content')
    <div class="topbar d-flex align-items-center justify-content-between notranslate">
        <a href="{{ route('questions.show', ['menu_slug' => 'topics', 'module_slug' => $questions['slug']]) }}"
            class="me-2">
            <i class="fas fa-chevron-left fs-3 text-secondary"></i>
        </a>

        <h6 class="fw-bold m-0 text-emerald text-center">{{ $questions['title'] }}</h6>

        <a href="javascript:void(0);" data-bs-toggle="offcanvas" data-bs-target="#overviewPanel">
            <i class="fas fa-list fs-3 text-muted"></i>
        </a>
    </div>

    <div class="app-header text-center bg-app mb-4">
        <h5 class="text-emerald-900">{{ $questions['chapters'][$questionSlug] }}</h5>
        <p class="text-muted mb-2">{{ $questions['desc'] }}</p>
        <div class="small">
            ✍️ Author: Author Name • Reviewed • Verified <br>
            ⏱️ Last review: Sep 04, 2025 by Reviewer Name
        </div>
    </div>

    <div class="container my-3 pb-5">
        <!-- Lesson Body -->
        <div class="lesson-body text-center">
            Loading....
        </div>
    </div>
@endsection
