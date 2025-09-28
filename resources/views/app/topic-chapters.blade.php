@extends('layouts.app')

@section('content')
    <div class="container my-3 pb-5 notranslate">
        <header class="container-fluid py-3 bg-clr-surface shadow-sm notranslate">
            <div class="container text-center">
                <p class="mb-0 text-muted small">Topic : </p>
                <h4 class="fw-bold text-emerald m-0 mb-1">{{ $questions['title'] }}</h4>
                <p class="m-0 text-muted"> {{ $questions['desc'] }}</p>
            </div>
        </header>

        {{-- <x-app.banner :title="$questions['title']" :desc="$questions['desc']" />

        <h6 class="fw-bold mt-4 mb-2 text-emerald">അനുബന്ധ വിഷയങ്ങൾ</h6> --}}

        <div class="row justify-content-center">
            <div class="col-lg-8">
                @foreach ($questions['chapters'] as $item)
                    <x-app.topic-chapter :title="$loop->index + 1 . ' : ' . $item['title']" :url="route('answers.show', [
                        'menu_slug' => 'topics',
                        'module_slug' => $questions['slug'],
                        'question_slug' => $loop->index,
                    ])" />
                @endforeach
            </div>
        </div>

        <div class="d-grid mt-4 d-none">
            <a href="topic.html" class="btn btn-primary btn-lg rounded-pill">Start Learning</a>
        </div>
    </div>
@endsection
