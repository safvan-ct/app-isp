@extends('layouts.app')

@section('content')
    <x-app.topbar :title="__('app.topics')" :url="route('modules.show', 'topics')" />

    <div class="container my-3 pb-5 notranslate">
        <x-app.banner :title="$questions['title']" :desc="$questions['desc']" />

        <h6 class="fw-bold mt-4 mb-2 text-emerald">അനുബന്ധ വിഷയങ്ങൾ</h6>

        @foreach ($questions['chapters'] as $item)
            <x-app.topic-chapter :title="$loop->index + 1 . ' : ' . $item" :url="route('answers.show', [
                'menu_slug' => 'topics',
                'module_slug' => $questions['slug'],
                'question_slug' => $loop->index,
            ])" />
        @endforeach

        <div class="d-grid mt-4 d-none">
            <a href="topic.html" class="btn btn-primary btn-lg rounded-pill">Start Learning</a>
        </div>
    </div>
@endsection
