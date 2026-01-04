@extends('layouts.app')

@push('styles')
    <style>
        .accordion-item {
            border: none;
            margin-bottom: 1rem;
            position: relative;
        }

        /* Vertical Line for Timeline */
        .module-steps-accordion .accordion-item::before {
            content: '';
            position: absolute;
            left: 17px;
            top: 35px;
            bottom: -1.2rem;
            width: 3px;
            background-color: var(--clr-dark);
            z-index: 0;
        }

        .module-steps-accordion .accordion-item:last-child::before {
            display: none;
        }

        .accordion-button {
            background-color: var(--clr-white);
            border-radius: 8px !important;
            padding: 1rem;
            position: relative;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);
            z-index: 1;
        }

        .accordion-button::after {
            background: none !important;
        }

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
        }

        .step-marker.fard {
            background-color: var(--clr-yl-900);
        }

        .step-marker.sunnah {
            background-color: var(--clr-dark);
        }

        .accordion-collapse {
            border-left: .2rem solid var(--clr-dark);
            margin-left: 17px;
            padding: 20px 0 10px 10px;
            background-color: var(--clr-white);
            border-radius: none !important;
        }

        .accordion-item:last-of-type>.accordion-collapse {
            border-bottom-right-radius: 0 !important;
            border-bottom-left-radius: 0 !important;
        }
    </style>
@endpush

@section('content')
    <x-app.banner :type="'Topic'" :title="$topic['title']" :desc="$topic['desc']" />

    <main class="container px-1 px-sm-0 p-0 my-3 pb-3 pb-sm-0 notranslate">
        <div class="row justify-content-center">
            {{-- <div class="col-lg-8">
                <h6 class="fw-bold mb-2 text-dark">അനുബന്ധ വിഷയങ്ങൾ</h6>

                @foreach ($topic['modules'] as $item)
                    <x-app.topic-chapter :title="$loop->index + 1 . ' : ' . $item['title']" :url="route('answers.show', [
                        'menu_slug' => 'topics',
                        'module_slug' => $topic['slug'],
                        'question_slug' => $loop->index,
                    ])" />
                @endforeach
            </div> --}}

            <div class="col-lg-8">
                <section class="mb-5">
                    <h6 class="fw-bold mb-2 text-dark border-bottom pb-2 d-none">അനുബന്ധ വിഷയങ്ങൾ</h6>

                    {{-- <h2 class="h5 text-dark mb-3 border-bottom pb-2 fw-bold">
                        <i class="fas fa-lightbulb text-gold me-1"></i>
                        ബന്ധപ്പെട്ട വിഷയങ്ങൾ
                    </h2> --}}

                    <div class="accordion accordion-flush" id="">
                        @foreach ($topic['modules'] as $key => $item)
                            <div class="accordion-item">
                                <h2 class="accordion-header shadow-sm">
                                    {{-- @if (!empty($item['lessons']))
                                        <button class="accordion-button fw-bold text-dark" type="button"
                                           >
                                            <i class="fas fa-check-circle text-success me-2 "></i>
                                            {{ $key + 1 }}. {{ $item['title'] }}
                                        </button>
                                    @else
                                        <a href="{{ route('answers.show', ['menu_slug' => 'topics', 'module_slug' => $topic['slug'], 'question_slug' => $key]) }}"
                                            class="accordion-button fw-bold text-dark text-decoration-none accordion-link">
                                            <i class="fas fa-check-circle text-success me-2 "></i>
                                            {{ $key + 1 }}. {{ $item['title'] }}
                                        </a>
                                    @endif --}}

                                    <a href="{{ route('answers.show', ['menu_slug' => 'topics', 'module_slug' => $topic['slug'], 'question_slug' => $key]) }}"
                                        class="accordion-button fw-bold text-decoration-none accordion-link">
                                        <i class="fas fa-play-circle text-gold me-2 "></i>
                                        {{ $key + 1 }}. {{ $item['title'] }}
                                    </a>
                                </h2>

                                @if (!empty($item['lessons']))
                                    <div id="{{ $key }}" class="accordion-collapse collapse show"
                                        style="border-left: 3px solid var(--clr-gold);">
                                        <div class="accordion-body p-0">
                                            <div class="list-group list-group-flush">

                                                @foreach ($item['lessons'] as $lesson)
                                                    <a class="list-group-item list-group-item-action small"
                                                        href="{{ route('answers.show', [
                                                            'menu_slug' => 'topics',
                                                            'module_slug' => $topic['slug'],
                                                            'question_slug' => $key,
                                                        ]) }}?lesson_slug={{ $loop->index + 1 }}">
                                                        {{ $key + 1 }}.{{ $loop->index + 1 }}: {{ $lesson }}
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
