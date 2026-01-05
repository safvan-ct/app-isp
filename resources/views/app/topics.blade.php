@extends('layouts.app')

@section('content')
    <x-app.banner :title="'വിഷയങ്ങൾ'" :desc="'അറിവ് തേടൂ, വിശ്വാസം വളർത്തൂ'" />

    <main class="container py-4 notranslate">
        <div class="row g-2">
            @foreach (exploreTopics() as $key => $item)
                <div class="col-6 col-md-3">
                    <x-app.topic-card :title="$item" :url="route('questions.show', ['menu_slug' => 'topic', 'module_slug' => $key])" />
                </div>
            @endforeach

            <div class="col-6 col-md-3">
                <div class="base-card d-flex flex-column h-100 justify-content-between rounded-3 border shadow-sm">
                    <a href="{{ route('modules.show', ['topic_slug' => 'namaz-1']) }}" class="d-flex align-items-center text-decoration-none">
                        <div class="icon-thumb me-2 bg-success-subtle" style="width: 35px; height: 35px">
                            <i class="fa-regular fa-star"></i>
                        </div>

                        <h6 class="text-black fw-bold m-0 small">Namaz</h6>
                    </a>
                </div>
            </div>
        </div>
    </main>
@endsection
