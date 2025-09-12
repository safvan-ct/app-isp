@extends('layouts.app')

@section('content')
    @php
        $topics = [
            // 'ശുദ്ധി',
            'namaz' => 'നിസ്കാരം',
            'meelad' => 'നബിദിനം (റ.അ. 12)',
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

    <x-app.topbar :title="__('app.topics')" :url="route('home')" />

    <div class="container my-3 pb-5">
        <x-app.banner />

        <div class="row g-2">
            @foreach ($topics as $key => $item)
                <div class="col-6 col-md-3">
                    <x-app.topic-card :title="$item" :url="route('questions.show', ['menu_slug' => 'topic', 'module_slug' => $key])" />
                </div>
            @endforeach
        </div>
    </div>
@endsection
