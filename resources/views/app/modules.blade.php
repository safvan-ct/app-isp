@extends('layouts.app')

@section('title', $topic['title'] . ' | ' . __('app.chapters'))

@section('content')
    <x-app.banner :type="'Topic'" :title="$topic['title']" :desc="$topic['desc']" />

    <main class="container px-1 px-sm-0 p-0 my-3 pb-3 pb-sm-0 notranslate">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <section class="mb-5">
                    <h6 class="fw-bold mb-2 text-dark border-bottom pb-2 d-none">അനുബന്ധ വിഷയങ്ങൾ</h6>

                    <div class="accordion accordion-flush" id="">
                        @foreach ($topic['modules'] as $key => $module)
                            <div class="accordion-item mb-2">
                                <h2 class="accordion-header shadow-sm">
                                    <a class="accordion-button fw-bold text-decoration-none accordion-link border border-3 border-gold"
                                        href="{{ route('module.lessons', ['topic_slug' => $topic['slug'], 'module_slug' => $module['slug']]) }}">
                                        <i class="fas fa-play-circle text-gold me-2"></i>
                                        {{ $loop->index + 1 }}. {{ $module['title'] }}
                                    </a>
                                </h2>

                                @if (!empty($module['lessons']))
                                    <div id="{{ $key }}" class="accordion-collapse collapse show ms-3"
                                        style="border-left: 3px solid var(--clr-gold); padding: 10px 0 10px 10px;">
                                        <div class="accordion-body p-0">
                                            <div class="list-group list-group-flush">

                                                @foreach ($module['lessons'] as $lessonSlug => $lesson)
                                                    <a class="list-group-item list-group-item-action small"
                                                        href="{{ route('module.lessons', ['topic_slug' => $topic['slug'], 'module_slug' => $module['slug'], 'lesson_slug' => $lessonSlug]) }}">
                                                        {{ $loop->parent->index + 1 }}.{{ $loop->index + 1 }}:
                                                        {{ $lesson }}
                                                    </a>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </section>
            </div>
        </div>
    </main>
@endsection
