@extends('layouts.app')

@section('title', __('app.topics'))

@section('content')
    <x-app.banner :title="__('app.topics')" :desc="'അറിവ് തേടൂ, വിശ്വാസം വളർത്തൂ'" />

    <main class="container py-4 notranslate">
        <div class="row g-2">
            @foreach (exploreTopics() as $key => $item)
                <div class="col-6 col-md-3">
                    <x-app.topic-card :title="$item" :url="route('topic.modules', ['topic_slug' => $key])" />
                </div>
            @endforeach
        </div>
    </main>
@endsection
