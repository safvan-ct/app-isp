@extends('layouts.app')

@section('title', __('app.topics'))

@section('content')
    <x-app.banner :title="__('app.topics')" :desc="'അറിവ് തേടൂ, വിശ്വാസം വളർത്തൂ'" />

    <main class="container py-4 notranslate">
        <div class="row g-2">
            @foreach (exploreTopics() as $key => $item)
                <div class="col-6 col-md-3">
                    <x-app.topic-card :title="$item" :url="route('questions.show', ['menu_slug' => 'topic', 'module_slug' => $key])" />
                </div>
            @endforeach

            @foreach (exploreTopics() as $key => $item)
                <div class="col-6 col-md-3">
                    <x-app.topic-card :title="$item . ' - 1'" :url="route('modules.show', ['topic_slug'  => $key.'-1'])" />
                </div>
            @endforeach
        </div>
    </main>
@endsection
