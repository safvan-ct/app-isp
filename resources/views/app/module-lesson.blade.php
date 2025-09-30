@extends('layouts.app')

@section('title', $topic['title'])
@section('navbar_title', $topic['title'])
@section('navbar_url', route('questions.show', ['menu_slug' => 'topics', 'module_slug' => $topic['slug']]))

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
            background-color: var(--clr-emerald);
            z-index: 0;
        }

        .module-steps-accordion .accordion-item:last-child::before {
            display: none;
        }

        .accordion-button {
            background-color: var(--clr-surface);
            border-radius: 8px !important;
            padding: 1rem;
            position: relative;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);
            z-index: 1;
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
            border: 2px solid var(--clr-surface);
            box-shadow: 0 0 0 2px var(--clr-emerald-900);
        }

        .step-marker.fard {
            background-color: var(--clr-accent-900);
        }

        .step-marker.sunnah {
            background-color: var(--clr-emerald);
        }

        .accordion-collapse {
            border-left: .2rem solid var(--clr-emerald);
            margin-left: 17px;
            padding: 20px 0 10px 10px;
            background-color: var(--clr-surface);
            border-radius: none !important;
        }

        .accordion-item:last-of-type>.accordion-collapse {
            border-bottom-right-radius: 0 !important;
            border-bottom-left-radius: 0 !important;
        }
    </style>
@endpush

@section('content')
    <x-app.banner :number="$moduleId + 1" :type="'Module'" :title="$topic['modules'][$moduleId]['title']" :desc="$topic['modules'][$moduleId]['desc']" />

    <main class="container py-4 notranslate">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <section id="" class="mb-5">
                    <h2 class="h5 text-emerald mb-3 border-bottom pb-2">
                        <i class="fas fa-list-check me-2 text-accent"></i>
                        Step-by-Step Guide
                    </h2>

                    <div class="accordion module-steps-accordion" id="moduleAccordion">
                        @foreach ($module['lessons'] as $key => $lesson)
                            @php
                                $active = isset($_GET['lesson_slug'])
                                    ? $_GET['lesson_slug'] == $key + 1
                                    : (isset($lesson['active'])
                                        ? $lesson['active']
                                        : false);
                            @endphp

                            <div class="accordion-item">
                                <h2 class="accordion-header shadow-sm">
                                    <button class="accordion-button {{ $active ? '' : 'collapsed' }} fw-bold text-emerald"
                                        type="button" data-bs-toggle="collapse" data-bs-target="#module{{ $key + 1 }}"
                                        aria-expanded="false" aria-controls="module{{ $key + 1 }}">
                                        <span class="step-marker sunnah">{{ $key + 1 }}</span>
                                        {{ $lesson['title'] }}
                                    </button>
                                </h2>

                                <div id="module{{ $key + 1 }}"
                                    class="accordion-collapse collapse {{ $active ? 'show' : '' }} module-accordion-collapse"
                                    data-bs-parent="#moduleAccordion">
                                    <div class="accordion-body p-0">
                                        @if (isset($lesson['img']))
                                            <img src="{{ asset($lesson['img']) }}" class="img-fluid mb-3 w-100 w-md-50">
                                        @endif

                                        @foreach ($lesson['points'] as $key2 => $point)
                                            @if ($point['title'])
                                                <h6 class="text-accent-900 fw-bold text-break">
                                                    <span class="text-emerald-900">
                                                        {{ $key + 1 }}.{{ $key2 + 1 }}:
                                                    </span>
                                                    {!! $point['title'] !!}
                                                </h6>
                                            @endif

                                            @foreach ($point['desc'] as $desc)
                                                <div class="m-0 text-justify {{ $loop->last ? '' : 'mb-1' }}"
                                                    style="text-indent: 2em">
                                                    {!! $desc !!}
                                                </div>
                                            @endforeach

                                            @if (isset($point['list']))
                                                <ul class="m-0">
                                                    @foreach ($point['list'] as $list)
                                                        <li class="m-0 text-justify">
                                                            {!! $list !!}
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @endif

                                            @foreach ($point['ref'] as $ref)
                                                @if (!isset($ref['active']) || (isset($ref['active']) && $ref['active']))
                                                    <div
                                                        class="source-callout mt-2 {{ $ref['type'] == 'quran' ? 'border-dark' : '' }}">
                                                        <p class="small fst-italic mb-0">
                                                            {{ isset($ref['title']) ? $ref['title'] : '' }}

                                                            @php
                                                                $infos = isset($ref['info']) ? $ref['info'] : [];
                                                            @endphp

                                                            @foreach ($infos as $info)
                                                                @php
                                                                    $sahih = isset($info['sahih'])
                                                                        ? $info['sahih']
                                                                        : true;

                                                                    $cls = $sahih ? '' : 'text-danger';
                                                                @endphp

                                                                <x-app.ref-button :slug="$info['slug']" :number="$info['number']"
                                                                    :class="$cls . (!$loop->last ? ' mb-1' : '')" :type="isset($info['type'])
                                                                        ? $info['type']
                                                                        : $ref['type']" />
                                                            @endforeach
                                                        </p>
                                                    </div>
                                                @endif
                                            @endforeach

                                            @if (isset($point['alert']) && $point['alert'])
                                                <x-app.reference :text="$point['alert']" type="quran" class="mt-2" />
                                            @endif

                                            @if (!$loop->last)
                                                <x-app.hr class="my-3" />
                                            @endif
                                        @endforeach

                                        @if (isset($lesson['extra_notes']) && count($lesson['extra_notes']) > 0)
                                            @php
                                                $extra_notes = $lesson['extra_notes'][0];
                                            @endphp
                                            <x-app.reference :text="$extra_notes['title']" type="summary" class="mt-2">

                                                <ul class="m-0">
                                                    @foreach ($extra_notes['points'] as $point)
                                                        <li class="m-0 text-justify">
                                                            {!! $point !!}
                                                        </li>
                                                    @endforeach
                                                </ul>

                                                @foreach ($extra_notes['ref'] as $ref)
                                                    @if (!isset($ref['active']) || (isset($ref['active']) && $ref['active']))
                                                        <div
                                                            class="source-callout mt-1 {{ $ref['type'] == 'quran' ? 'border-dark' : '' }}">
                                                            <p class="small fst-italic mb-0">
                                                                {{ $ref['title'] }}

                                                                @foreach ($ref['info'] as $info)
                                                                    @php
                                                                        $sahih = isset($info['sahih'])
                                                                            ? $info['sahih']
                                                                            : true;

                                                                        $cls = $sahih ? '' : 'text-danger';
                                                                    @endphp

                                                                    <x-app.ref-button :slug="$info['slug']" :number="$info['number']"
                                                                        :class="$cls . (!$loop->last ? ' mb-1' : '')" :type="isset($info['type'])
                                                                            ? $info['type']
                                                                            : $ref['type']" />
                                                                @endforeach
                                                            </p>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </x-app.reference>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </section>
            </div>

            <div class="col-lg-4">
                <section id="full-curriculum" class="mb-5">
                    <h2 class="h5 text-emerald mb-3 border-bottom pb-2">
                        ബന്ധപ്പെട്ട വിഷയങ്ങൾ
                    </h2>

                    <div class="accordion accordion-flush" id="curriculumAccordion">

                        @foreach ($topic['modules'] as $key => $item)
                            <div class="accordion-item">
                                <h2 class="accordion-header shadow-sm">
                                    @if (!empty($item['lessons']))
                                        <button
                                            class="accordion-button related fw-bold text-emerald-900 {{ $moduleId == $key ? '' : 'collapsed' }}"
                                            type="button" data-bs-toggle="collapse" data-bs-target="#{{ $key }}">
                                            <i
                                                class="fas fa-circle {{ $moduleId == $key ? 'text-success' : 'text-accent' }} me-2 "></i>
                                            {{ $key + 1 }}. {{ $item['title'] }}
                                        </button>
                                    @else
                                        <a href="{{ route('answers.show', ['menu_slug' => 'topics', 'module_slug' => $topic['slug'], 'question_slug' => $key]) }}"
                                            class="accordion-button related fw-bold text-emerald-900 {{ $moduleId == $key ? '' : 'collapsed' }} text-decoration-none accordion-link">
                                            <i
                                                class="fas fa-circle {{ $moduleId == $key ? 'text-success' : 'text-accent' }} me-2 "></i>
                                            {{ $key + 1 }}. {{ $item['title'] }}
                                        </a>
                                    @endif
                                </h2>

                                @if (!empty($item['lessons']))
                                    <div id="{{ $key }}"
                                        class="accordion-collapse collapse {{ $moduleId == $key ? 'show' : '' }}"
                                        data-bs-parent="#curriculumAccordion"
                                        style="border-left: 3px solid var(--clr-accent);">
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

    <!-- References Offcanvas -->
    <div class="offcanvas offcanvas-start notranslate" tabindex="-1" id="referencesPanel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title">References</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"></button>
        </div>
        <div class="offcanvas-body py-0">
            <div class="ref-box ref-hadith m-0 mb-1" id="ref1">
                <span class="fw-bold">[1]. ഇമാം അബൂ ഹനീഫ (80 - 150 ഹി)</span><br>

                <p class="m-0 small mb-1">
                    നിശ്ചിത സമയങ്ങളെ, ശരീഅത്ത് നിർദ്ദേശിക്കാതെ, ആരാധനയ്‌ക്കായി വേർതിരിക്കുന്നത് ബിദ്അത് ആണ്. - <em>അൽ-ഹിദായ,
                        അൽ-മബ്സൂത്</em>
                </p>

                <p class="m-0 small mb-2">
                    ഇമാം അബൂ യൂസുഫ് (d. 182H), ഇമാം മുഹമ്മദ് (d. 189H) എന്നിവരുടെ പുസ്തകങ്ങളിലോ (അഥവാ ആസാർ, ഫിഖ്ഹ് രചനകൾ) റ.
                    അ. മാസത്തെ ശ്രേഷ്ടതയെ കുറിച് രേഖപ്പെടുത്തിയിട്ടില്ല.
                </p>

                <p class="m-0 small">
                    <span class="fw-bold">ഇമാം അൽ-മർഘീനാനി (d - 593 ഹി)</span><br>
                    <em>- അൽ-ഹിദായ, Vol. 4, (Dar al-Fikr ed.)</em><br>

                    <span class="fw-bold">ഇമാം സർഖസി (d - 483 ഹി)</span><br>
                    <em>- അൽ-മബ്സൂത്, vol. 2, Dar al-Maʿrifah ed.</em><br>

                    <span class="fw-bold">Ibn ʿĀbidīn (d - 483 ഹി)</span><br>
                    <em>- Radd al-Muhtār, vol. 2</em><br>

                    <br><em>- Al-Fatawa al-Hindiyya (Fatāwā ʿĀlamgīriyya) (vol. 1)</em><br>
                </p>
            </div>

            <div class="ref-box ref-hadith m-0 mb-1" id="ref2">
                <span class="fw-bold">[2]. ഇമാം മാലിക് (93 - 179 ഹി)</span><br>

                <p class="m-0 small mb-2">
                    സലഫുകൾ (ആദ്യകാല സഹാബികൾ, താബിഉൻ) ആരും ചെയ്തിട്ടില്ല, അത് ബിദ്അത് ആണ്.
                </p>

                <p class="m-0 small">
                    <span class="fw-bold">ഇമാം അൽ-ഷാതിബി (d - 790 ഹി)</span><br>
                    <em>- അൽ-ഇ'തിസാം, Vol. 1, (Dar Ibn 'Affan print)</em><br>

                    <span class="fw-bold">Ibn al-Hajj al-Maliki (d - 737 ഹി)</span><br>
                    <em>- Al-Maddkhal (vol. 2, Dar al-Kutub al-'Ilmiyyah print)</em><br>

                    <span class="fw-bold">Imam Sahnun</span><br>
                    <em>- Al-Mudawwana al-Kubra (vol. 1)</em><br>
                </p>
            </div>

            <div class="ref-box ref-hadith m-0 mb-1" id="ref3">
                <span class="fw-bold">[3]. ഇമാം ശാഫിഈ (150 - 204 ഹി)</span><br>

                <p class="m-0 small mb-2">
                    <em>നേരിട്ട് മീലാദിനെക്കുറിച്ച് പറഞ്ഞിട്ടില്ല.</em><br>
                    ഒരു കാര്യത്തെ നല്ല ബിദ്അത് എന്നും, മോശം ബിദ്അത് എന്നും പറയാം. - <em>മനാഖിബ് അൽ-ശാഫിഈ</em>
                </p>

                <p class="m-0 small">
                    <span class="fw-bold">അൽ-ബൈഹഖി (d - 458 ഹി)</span><br>
                    <em>- മനാഖിബ് അൽ-ശാഫിഈ, Vol. 1</em><br>

                    <span class="fw-bold">ഇമാം നവവി (d - 676 ഹി)</span><br>
                    <em>- Tahdhib al-Asma' wa'l-Lughat, vol. 3</em> (ബിദ്അത്തെ “ഹസന” / “സയ്യിഅ” തരം തിരിച്ചു.)<br>

                    <span class="fw-bold">ഇമാം സുയൂത്തി (d - 911 ഹി)</span><br>
                    <em>- Husn al-Maqsid fi 'Amal al-Mawlid (മീലാദിനെ “ബിദ്അത് ഹസന” എന്ന് അഭിപ്രായപ്പെടുന്നു.)</em><br>
                </p>
            </div>

            <div class="ref-box ref-hadith m-0 mb-1" id="ref4">
                <span class="fw-bold">[4]. ഇമാം അഹ്മദ് ബിൻ ഹൻബൽ (164 - 241 ഹി)</span><br>

                <p class="m-0 small mb-2">
                    എനിക്ക് അത് ബിദ്അത് ആയി തോന്നുന്നു - <em>ഇഖ്തിദാഉൽ സിറാത്ത്</em>
                </p>

                <p class="m-0 small">
                    <span class="fw-bold">ഇബ്ന് തൈമിയ്യ (d - 728 ഹി)</span><br>
                    <em>- Iqtidā' aṣ-Ṣirāṭ al-Mustaqīm, (Dar al-'Āṣimah ed.)</em><br>

                    <span class="fw-bold">Ibn Qudāmah al-Maqdisi (d - 620 ഹി)</span><br>
                    <em>- al-Mughnī, vol. 2, (Dar al-Fikr ed.)</em><br>

                    <span class="fw-bold">Ibn al-Jawzī (d - 597 ഹി)</span><br>
                    <em>- Talbīs Iblīs, (Dar al-Kutub al-'Ilmiyyah ed.)</em><br>
                </p>
            </div>

            <div class="ref-box ref-hadith m-0 mb-3" id="ref5">
                <span class="fw-bold">[5].</span><br>

                <p class="m-0 small mb-2">
                    <span class="fw-bold">റ. അ. 8 - ഇബ്നു ഹസ്മ് (d - 456 ഹി)</span><br>
                    <em>- Volume 1. (<span class="text-ar">الفصل في الملل والأهواء والنحل</span>)</em><br>
                    <em>- ഇബ്ന്‍ കതീർ തന്റെ “അൽ-ബിദായ വൽ നിഹായ” - ൽ ഇബ്നു ഹസ്മ്-ന്റെ ഈ അഭിപ്രായം റ. അ. 8 ആയി
                        ഉദ്ധരിച്ചിരിക്കുന്നു.</em>
                </p>

                <p class="m-0 small mb-2">
                    <span class="fw-bold">റ. അ. 9 - ഇബ്ന്‍ ദിഹ്യ (d ~ 633 ഹി)</span><br>
                    <em>- ഇബ്ന്‍ കതീർ “അൽ-ബിദായ വൽ നിഹായ” - ൽ “in his book” എന്ന പരാമർശത്തോടെ ഇബ്ന്‍ ദിഹ്യ-യുടെ
                        വാദമയിന്നു സൂചിപ്പിക്കുന്നു.</em>
                </p>

                <p class="m-0 small">
                    <span class="fw-bold">റ. അ. 12 - ഇബ്നു ഇഷാഖ് (d ~ 150 ഹി)</span><br>
                    <em>- Volume 1, early chapters (“Mawlid al-Nabi ﷺ”). (“അൽ-സീറ”)</em><br>
                    <em>- ഇബ്ന്‍ ഇഷാഖിന്റെ ഒറിജിനൽ പുസ്തകം നഷ്ടപ്പെട്ടു. ഇപ്പോൾ കിട്ടുന്നത് ഇബ്ന്‍ ഹിഷാം (d. 218
                        ഹി) ചെയ്ത സംഗ്രഹത്തിലൂടെയാണ് “സീരത്തുൽ നബവിയ്യ” (Seerah Ibn Hisham).</em>
                </p>

                <p class="m-0 small">
                    <span class="fw-bold">ഇബ്ന്‍ കതീർ (d - 774 ഹി)</span><br>
                    <em>- “അൽ-ബിദായ വൽ നിഹായ” (Vol. 3, Chapter: Dhikr Mawlidihi al-Sharif) -ൽ വ്യക്തമാക്കുന്നു: “ഇബ്നു
                        ഇഷാഖിന്റെ അഭിപ്രായത്തിൽ ഏറ്റവും പ്രസിദ്ധമായ അഭിപ്രായം - റ. അ. 12”</em>
                </p>
            </div>
        </div>
    </div>
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

        document.querySelectorAll('[data-bs-toggle="offcanvas"]').forEach(el => {
            el.addEventListener('click', function() {
                const refId = this.getAttribute('data-ref-id');
                const targetId = this.getAttribute('data-bs-target');
                if (!targetId) return;

                const offcanvasEl = document.querySelector(targetId);
                if (!offcanvasEl) return;

                const offcanvasBody = offcanvasEl.querySelector('.offcanvas-body');

                offcanvasEl.addEventListener('shown.bs.offcanvas', function() {
                    offcanvasBody.querySelectorAll('.ref-quran').forEach(child => {
                        child.classList.remove('ref-quran');
                        child.classList.add('ref-hadith');
                    });

                    if (refId) {
                        const target = document.getElementById(refId);
                        if (target) {
                            target.scrollIntoView({
                                behavior: 'smooth',
                                block: 'start'
                            });

                            target.classList.remove('ref-hadith');
                            target.classList.add('ref-quran');
                        }
                    }
                }, {
                    once: true
                });
            });
        });
    </script>
@endpush
