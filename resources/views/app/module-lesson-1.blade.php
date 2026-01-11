@extends('layouts.app')

@section('title', $topic['title'] . ' | ' . $topic['modules'][$moduleSlug]['title'])

@push('styles')
    <style>
        .step-marker {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            text-align: center;
            line-height: 28px;
            font-weight: 700;
            color: white;
            flex-shrink: 0;
            margin-right: 15px;
            border: 2px solid var(--clr-white);
            box-shadow: 0 0 0 2px var(--clr-black);
            background-color: var(--clr-gold);
        }

        .module-accordion-collapse {
            border-left: .2rem solid var(--clr-dark);
            padding: 20px 0 10px 10px;
        }

        .module-steps-accordion .accordion-item {
            border: none;
            margin-bottom: 1rem;
            border-radius: 10px !important;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .curriculum-sidebar {
            background: #f8f9fa;
            border-radius: 12px;
            border: 1px solid #e9ecef;
        }
    </style>
@endpush

@section('content')
    @php
        $modules = $topic['modules'] ?? [];
        $lessons = $module['lessons'] ?? [];
    @endphp

    <main class="container mt-4 pb-5 notranslate">
        <div class="row g-4">
            <div class="col-lg-3 order-2 order-lg-1 mb-4">
                <aside class="curriculum-sidebar p-3 sticky-top" style="top: 80px; z-index: 10;">
                    <h6 class="fw-bold text-uppercase tracking-wider mb-3 text-dark small">
                        <i class="fas fa-book-open me-2"></i> {{ __('app.related_topics') }}
                    </h6>

                    <div class="accordion accordion-flush" id="curriculumAccordion">
                        @foreach ($modules as $key => $module)
                            <div class="accordion-item mb-2 shadow-sm border border-gold">
                                <h6 class="accordion-header shadow-sm">
                                    @if (!empty($module['lessons']))
                                        <button
                                            class="accordion-button bg-light text-dark {{ $moduleSlug == $key ? '' : 'collapsed' }}"
                                            type="button" data-bs-toggle="collapse" data-bs-target="#{{ $key }}"
                                            style="font-size: 14px">
                                            <i
                                                class="fas fa-circle {{ $moduleSlug == $key ? 'text-black' : 'text-gold' }} me-2 "></i>
                                            {{ $loop->index + 1 }}. {{ $module['title'] }}
                                        </button>
                                    @else
                                        <a href="{{ route('lessons.show', ['topic_slug' => $topic['slug'], 'module_slug' => $module['slug']]) }}"
                                            class="accordion-button bg-light text-dark {{ $moduleSlug == $key ? '' : 'collapsed' }} text-decoration-none accordion-link"
                                            style="font-size: 14px">
                                            <i
                                                class="fas fa-circle {{ $moduleSlug == $key ? 'text-black' : 'text-gold' }} me-2 "></i>
                                            {{ $loop->index + 1 }}. {{ $module['title'] }}
                                        </a>
                                    @endif
                                </h6>

                                @if (!empty($module['lessons']))
                                    <div id="{{ $key }}"
                                        class="accordion-collapse collapse {{ $moduleSlug == $key ? 'show' : '' }}"
                                        data-bs-parent="#curriculumAccordion"
                                        style="border-left: 3px solid var(--clr-gold);">
                                        <div class="accordion-body p-0">
                                            <div class="list-group list-group-flush">

                                                @foreach ($module['lessons'] as $lessonKey => $lesson)
                                                    <a class="list-group-item list-group-item-action small"
                                                        href="{{ route('lessons.show', ['topic_slug' => $topic['slug'], 'module_slug' => $module['slug'], 'lesson_slug' => $lessonKey]) }}">
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
                </aside>
            </div>

            <div class="col-lg-9 order-1 order-lg-2">
                <header class="mb-3 d-flex align-items-end justify-content-between">
                    <div>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-2">
                                <li class="breadcrumb-item small">
                                    <a href="{{ route('modules.show', 'topics') }}" class="text-dark">
                                        {{ __('app.topics') }}
                                    </a>
                                </li>
                                <li class="breadcrumb-item small active">
                                    <a href="{{ route('modules.show', ['topic_slug' => $topic['slug']]) }}"
                                        class="text-dark">
                                        {{ $topic['title'] }}
                                    </a>
                                </li>
                            </ol>
                        </nav>
                        <h5 class="h5 fw-bold m-0">
                            <i class="fas fa-list-check me-2 text-gold"></i>{{ $topic['modules'][$moduleSlug]['title'] }}
                        </h5>
                    </div>
                </header>

                <div class="accordion module-steps-accordion" id="moduleAccordion">
                    @foreach ($lessons as $lesson)
                        @php
                            $active = $lessonSlug == $lesson['slug'] ? true : $lesson['active'];
                            $descriptions = isset($lesson['desc']) ? $lesson['desc'] : [];
                            $subTopics = isset($lesson['sub_topics']) ? $lesson['sub_topics'] : [];
                        @endphp

                        <div class="accordion-item border border-gold">
                            <h2 class="accordion-header shadow-sm">
                                <button class="accordion-button {{ $active ? '' : 'collapsed' }} fw-bold" type="button"
                                    @if (count($lessons) > 1) data-bs-toggle="collapse" @endif
                                    data-bs-target="#module{{ $lesson['slug'] }}" aria-expanded="false"
                                    aria-controls="module{{ $lesson['slug'] }}">
                                    <span class="step-marker sunnah">{{ $loop->index + 1 }}</span>
                                    {{ $lesson['title'] }}
                                </button>
                            </h2>

                            <div id="module{{ $lesson['slug'] }}"
                                class="accordion-collapse collapse {{ $active ? 'show' : '' }} module-accordion-collapse ms-3"
                                data-bs-parent="#moduleAccordion">
                                <div class="accordion-body p-0 pe-2 ">
                                    @if (isset($lesson['img']))
                                        <img src="{{ asset($lesson['img']) }}" class="img-fluid mb-3 w-100 w-md-50">
                                    @endif

                                    @foreach ($descriptions as $desc)
                                        @isset($desc['title'])
                                            @foreach ((array) $desc['title'] as $para)
                                                {!! !empty($para) ? $para : '' !!}
                                            @endforeach
                                        @endisset

                                        @isset($desc['points'])
                                            <ul class="m-0 {{ empty($desc['title']) ? '' : 'mt-1' }}">
                                                @foreach ($desc['points'] as $point)
                                                    <li class="m-0 text-justify">
                                                        <strong>{{ $point['title'] }}</strong>: {{ $point['desc'] }}
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endisset

                                        @if (isset($desc['list']))
                                            <ul class="m-0 mt-1">
                                                @foreach ($desc['list'] as $list)
                                                    <li class="m-0 text-justify">
                                                        {!! $list !!}
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif

                                        @if (isset($desc['ref']) && !empty($desc['ref']))
                                            @foreach ($desc['ref'] as $ref)
                                                @php $infos = isset($ref['info']) ? $ref['info'] : []; @endphp

                                                <div
                                                    class="source-callout mt-2 border-gold small mb-0 text-black d-inline-block text-justify">
                                                    {!! $ref['title'] !!}

                                                    @foreach ($infos as $info)
                                                        @php
                                                            $numbers = explode(',', $info['number']);
                                                            $type = isset($info['type']) ? $info['type'] : $ref['type'];
                                                            $sahih = isset($info['sahih']) ? $info['sahih'] : true;
                                                            $madhab = isset($info['madhab']) ? $info['madhab'] : false;
                                                        @endphp

                                                        @foreach ($numbers as $number)
                                                            <span role="button"
                                                                class="small authentic {{ $madhab ? 'text-primary' : ($sahih ? 'text-muted' : 'text-danger') }}"
                                                                data-slug="{{ $info['slug'] }}"
                                                                data-number="{{ $number }}"
                                                                data-type="{{ $type }}">
                                                                @if ($loop->first)
                                                                    {{ $type == 'hadith' ? hadithBookName($info['slug']) . ':' . $number : $info['slug'] . ':' . $number }}{{ !$loop->last ? ', ' : '' }}
                                                                @else
                                                                    {{ $number }}{{ !$loop->last ? ', ' : '' }}
                                                                @endif
                                                            </span>
                                                        @endforeach

                                                        {{ !$loop->last ? ' | ' : '' }}
                                                    @endforeach
                                                </div>
                                            @endforeach
                                        @endif

                                        {!! !$loop->last ? '<hr class="border-2 my-2 mb-3 text-black opacity-100">' : '' !!}
                                    @endforeach

                                    @if (!empty($subTopics) && !empty($descriptions))
                                        <hr class="border-2 my-2 mb-3 text-black opacity-100">
                                    @endif

                                    @foreach ($subTopics as $key2 => $subTopic)
                                        @if ($subTopic['title'])
                                            <h6 class="text-yl-900 fw-bold text-break">
                                                <span class="text-black">{{ $loop->index + 1 }}.</span>
                                                {!! $subTopic['title'] !!}
                                            </h6>
                                        @endif

                                        @isset($subTopic['desc'])
                                            @foreach ((array) $subTopic['desc'] as $para)
                                                {!! !empty($para) ? $para : '' !!}
                                            @endforeach
                                        @endisset

                                        @if (isset($subTopic['list']))
                                            <ul class="m-0 mt-1">
                                                @foreach ($subTopic['list'] as $list)
                                                    <li class="m-0 text-justify">
                                                        {!! $list !!}
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif

                                        @if (isset($subTopic['ref']) && !empty($subTopic['ref']))
                                            @foreach ($subTopic['ref'] as $ref)
                                                @php $infos = isset($ref['info']) ? $ref['info'] : []; @endphp

                                                <div
                                                    class="source-callout mt-2 border-gold small mb-0 text-black d-inline-block text-justify">
                                                    {!! $ref['title'] !!}

                                                    @foreach ($infos as $info)
                                                        @php
                                                            $numbers = explode(',', $info['number']);
                                                            $type = isset($info['type']) ? $info['type'] : $ref['type'];
                                                            $sahih = isset($info['sahih']) ? $info['sahih'] : true;
                                                            $madhab = isset($info['madhab']) ? $info['madhab'] : false;
                                                        @endphp

                                                        @foreach ($numbers as $number)
                                                            <span role="button"
                                                                class="small authentic {{ $madhab ? 'text-primary' : ($sahih ? 'text-muted' : 'text-danger') }}"
                                                                data-slug="{{ $info['slug'] }}"
                                                                data-number="{{ $number }}"
                                                                data-type="{{ $type }}">
                                                                @if ($loop->first)
                                                                    {{ $type == 'hadith' ? hadithBookName($info['slug']) . ':' . $number : $info['slug'] . ':' . $number }}{{ !$loop->last ? ', ' : '' }}
                                                                @else
                                                                    {{ $number }}{{ !$loop->last ? ', ' : '' }}
                                                                @endif
                                                            </span>
                                                        @endforeach

                                                        {{ !$loop->last ? ' | ' : '' }}
                                                    @endforeach
                                                </div>
                                            @endforeach
                                        @endif

                                        @if (!$loop->last)
                                            <x-app.hr class="my-3" />
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </main>
@endsection

@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            function scrollWithOffset(el) {
                const yOffset = -80; // adjust for sticky header height
                const y = el.getBoundingClientRect().top + window.scrollY + yOffset;
                window.scrollTo({
                    top: y,
                    behavior: 'smooth'
                });
            }

            // ---- On page load: scroll to active accordion ----
            const activeAccordion = document.querySelector(".module-accordion-collapse.show");
            if (activeAccordion) {
                const header = activeAccordion.previousElementSibling; // accordion-header h2
                if (header) {
                    scrollWithOffset(header);
                }
            }

            // ---- On accordion open: scroll to header ----
            document.querySelectorAll('.module-accordion-collapse').forEach(collapseEl => {
                collapseEl.addEventListener('shown.bs.collapse', function() {
                    const header = this.previousElementSibling;
                    if (header) {
                        scrollWithOffset(header);
                    }
                });
            });
        });
    </script>
@endpush
