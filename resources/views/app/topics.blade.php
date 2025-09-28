@extends('layouts.app')

@section('content')
    <x-app.topbar :title="__('app.topics')" />

    <div class="container my-3 pb-5 notranslate">
        <x-app.banner class="accent" :title="'വിഷയങ്ങൾ'" :desc="'📖 അറിവ് തേടൂ, വിശ്വാസം വളർത്തൂ ✨'" />

        <div class="row g-2">
            @foreach (exploreTopics() as $key => $item)
                <div class="col-6 col-md-3">
                    <x-app.topic-card :title="$item" :url="route('questions.show', ['menu_slug' => 'topic', 'module_slug' => $key])" />
                </div>
            @endforeach
        </div>
    </div>
@endsection
