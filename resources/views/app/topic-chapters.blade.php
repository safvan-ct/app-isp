@extends('layouts.app')

@section('content')
    <x-app.banner :type="'Topic'" :title="$topic['title']" :desc="$topic['desc']" />

    <main class="container py-4 notranslate">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                @foreach ($topic['modules'] as $item)
                    <x-app.topic-chapter :title="$loop->index + 1 . ' : ' . $item['title']" :url="route('answers.show', [
                        'menu_slug' => 'topics',
                        'module_slug' => $topic['slug'],
                        'question_slug' => $loop->index,
                    ])" />
                @endforeach
            </div>
        </div>
    </main>
@endsection
