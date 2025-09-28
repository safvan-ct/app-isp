@extends('layouts.app')

@section('content')
    <header class="container-fluid py-3 bg-clr-surface shadow-sm notranslate">
        <div class="container text-center">
            <p class="mb-0 text-muted small">Module {{ $questionSlug + 1 }}: </p>
            <h4 class="fw-bold text-emerald m-0 mb-1">{{ $question['chapters'][$questionSlug]['title'] }}</h4>
            <p class="m-0 text-muted"> {{ $question['chapters'][$questionSlug]['desc'] }}</p>
        </div>
    </header>

    <main class="container py-4 notranslate">
        <div class="row justify-content-center">
            <div class="col-lg-11">
                @if ($answer['div_type'] != 'timeline')
                    {{-- <section id="video-class" class="mb-5 p-4 bg-clr-surface rounded shadow">
                        <h2 class="text-emerald mb-3"><i class="fas fa-video me-2 text-accent"></i> Video Demonstration</h2>
                        <div class="ratio ratio-16x9 mb-3 rounded">
                            <iframe src="https://www.youtube.com/embed/dQw4w9WgXcQ" title="Wudu Video Demonstration" allowfullscreen></iframe>
                        </div>
                        <p class="text-muted fst-italic">Watch the full practical demonstration by Sheikh Abdullah. Ensure full body parts are visible during the process.</p>
                    </section> --}}

                    {{-- <hr class="my-5 border-2 border-emerald opacity-25"> --}}

                    <section id="steps-guide" class="mb-5">
                        <div class="sideline">
                            @foreach ($answer['notes'] as $key => $note)
                                <div class="sideline-item" id="div-{{ $key }}">
                                    <h4 class="text-emerald fw-bold">{{ $key + 1 }}. {{ $note['title'] }}</h4>

                                    @foreach ($note['points'] as $key2 => $point)
                                        @foreach ($point['desc'] as $desc)
                                            <div class="m-0 text-justify {{ $loop->last ? '' : 'mb-1' }}"
                                                style="text-indent: 2em">
                                                {!! $desc !!}
                                            </div>
                                        @endforeach

                                        @foreach ($point['ref'] as $ref)
                                            @if (!isset($ref['active']) || (isset($ref['active']) && $ref['active']))
                                                <div
                                                    class="source-callout mt-2 {{ $ref['type'] == 'quran' ? 'border-dark' : '' }}">
                                                    <p class="small fst-italic mb-0">
                                                        {{ $ref['title'] }}

                                                        @foreach ($ref['info'] as $info)
                                                            <x-app.ref-button :slug="$info['slug']" :number="$info['number']"
                                                                :type="isset($info['type'])
                                                                    ? $info['type']
                                                                    : $ref['type']" :class="$loop->last ? '' : 'mb-1'" />
                                                        @endforeach
                                                    </p>
                                                </div>
                                            @endif
                                        @endforeach

                                        @if ($point['alert'])
                                            <x-app.reference :text="$point['alert']" type="summary" class="mt-2" />
                                        @endif

                                        @if (!$loop->last)
                                            <x-app.hr class="my-3" />
                                        @endif
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                    </section>
                @else
                    <div class="timeline mb-5">
                        @foreach ($answer['notes'] as $note)
                            <div class="timeline-item">
                                <div class="circle"></div>
                                <div class="timeline-content pb-1">
                                    <h5>{{ $note['title'] }}</h5>
                                    @foreach ($note['desc'] as $desc)
                                        <div class="m-0 text-justify {{ $loop->last ? '' : 'mb-1' }}"
                                            style="text-indent: 2em">{!! $desc !!}</div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </main>

    {{-- <x-app.topbar :title="$questions['title']" :url="route('questions.show', ['menu_slug' => 'topics', 'module_slug' => $questions['slug']])" /> --}}

    <div class="container my-3 pb-5 notranslate d-none">
        <x-app.banner :title="$question['chapters'][$questionSlug]['title']" :desc="$questions['desc']" />

        <div class="row mt-4 notranslate">
            <div class="col-12 col-lg-8">

                @if ($answer['div_type'] != 'timeline')
                    @php
                        $isAccordion = $answer['div_type'] == 'accordion';
                        $componentName = $answer['div_type'] == 'accordion' ? 'app.accordion' : 'app.study-card';
                    @endphp
                    <div class="{{ $isAccordion ? 'accordion' : '' }}" id="{{ $isAccordion ? 'accordions' : '' }}">
                        @foreach ($answer['notes'] as $key => $note)
                            <x-dynamic-component :component="$componentName" :id="'topic' . $key" :title="$note['title']" :active="$note['active']"
                                :class="$loop->last ? 'mb-4' : ''">
                                @foreach ($note['points'] as $key2 => $point)
                                    @foreach ($point['desc'] as $desc)
                                        <div class="m-0 text-justify {{ $loop->last ? '' : 'mb-1' }}"
                                            style="text-indent: 2em">
                                            {!! $desc !!}
                                        </div>
                                    @endforeach

                                    @if ($point['alert'])
                                        <x-app.reference :text="$point['alert']" type="summary" class="mt-1" />
                                    @endif

                                    <div class="text-center mt-2">
                                        <button id="btn-{{ $key }}-{{ $key2 }}"
                                            class="btn btn-outline-success btn-sm" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapse-{{ $key }}-{{ $key2 }}"
                                            aria-expanded="false"
                                            aria-controls="collapse-{{ $key }}-{{ $key2 }}">
                                            📖 റഫറൻസുകൾ
                                        </button>
                                    </div>

                                    <div id="collapse-{{ $key }}-{{ $key2 }}"
                                        class="collapse m-0 p-0 mt-2">
                                        @foreach ($point['ref'] as $ref)
                                            <x-app.reference :type="$ref['type']" :text="$ref['title']" :class="$loop->last ? '' : 'mb-1'">

                                                @foreach ($ref['info'] as $info)
                                                    <x-app.ref-button :slug="$info['slug']" :number="$info['number']"
                                                        :type="$ref['type']" :class="$loop->last ? '' : 'mb-1'" />
                                                @endforeach
                                            </x-app.reference>
                                        @endforeach
                                    </div>

                                    @if (!$loop->last)
                                        <x-app.hr class="my-3" />
                                    @endif
                                @endforeach
                            </x-dynamic-component>
                        @endforeach
                    </div>
                @else
                    <div class="timeline">
                        @foreach ($answer['notes'] as $note)
                            <div class="timeline-item">
                                <div class="circle"></div>
                                <div class="timeline-content pb-1">
                                    <h5>{{ $note['title'] }}</h5>
                                    @foreach ($note['desc'] as $desc)
                                        <p class="m-0 text-justify" style="text-indent: 2em">{{ $desc }}</p>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            {{-- <div class="col-12 col-lg-4 mb-4">
                <x-app.related-topics :data="$questions['chapters']" :current="$questionSlug" :menu_slug="'topics'" :module_slug="$questions['slug']" />
            </div> --}}
        </div>
    </div>

    <div class="offcanvas offcanvas-end notranslate" tabindex="-1" id="curriculumOffcanvas"
        aria-labelledby="curriculumLabel">
        <div class="offcanvas-header bg-emerald text-white">
            <h5 class="offcanvas-title" id="curriculumLabel">Topic: {{ $questions['title'] }}</h5>
            <button type="button" class="btn-close text-reset btn-close-white" data-bs-dismiss="offcanvas"
                aria-label="Close"></button>
        </div>
        <div class="offcanvas-body p-0">
            <div class="accordion accordion-flush" id="curriculumAccordionOffcanvas">
                @foreach ($questions['chapters'] as $key => $item)
                    <div class="accordion-item">
                        @if (!empty($item['lessons']))
                            <h2 class="accordion-header">
                                <button
                                    class="accordion-button fw-bold text-emerald {{ $questionSlug == $key ? '' : 'collapsed' }} px-3"
                                    type="button" data-bs-toggle="collapse" data-bs-target="#{{ $key }}">
                                    <i
                                        class="fas {{ $questionSlug == $key ? 'fa-check-circle text-success' : 'fa-circle text-accent' }} me-2 "></i>
                                    {{ $key + 1 }}. {{ $item['title'] }}
                                </button>
                            </h2>
                        @else
                            <h2 class="accordion-header {{ $questionSlug == $key ? 'bg-success-subtle' : '' }}">
                                <a href="{{ route('answers.show', ['menu_slug' => 'topics', 'module_slug' => $question['slug'], 'question_slug' => $key]) }}"
                                    class="h6 px-3 fw-bold text-emerald text-decoration-none">
                                    <i class="fas fa-circle me-2 text-warning"></i>
                                    {{ $key + 1 }}. {{ $item['title'] }}
                                </a>
                            </h2>
                        @endif

                        @if (!empty($item['lessons']))
                            <div id="{{ $key }}"
                                class="accordion-collapse collapse {{ $questionSlug == $key ? 'show' : '' }}"
                                data-bs-parent="#curriculumAccordionOffcanvas">
                                <div class="accordion-body p-0">
                                    <div class="list-group list-group-flush">

                                        @foreach ($item['lessons'] as $lesson)
                                            <a href="{{ route('answers.show', ['menu_slug' => 'topics', 'module_slug' => $question['slug'], 'question_slug' => $key]) }}#div-{{ $loop->index }}"
                                                class="list-group-item list-group-item-action small">
                                                <i class="fas fa-file-alt me-2"></i> {{ $lesson }}
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </div>

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

    <div class="offcanvas offcanvas-start notranslate" tabindex="-1" id="referencePanel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title">References</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"></button>
        </div>

        <div class="offcanvas-body py-0">
            <div class="ref-box ref-hadith mt-2" id="ref1">
                <span class="fw-bold">[1]. ഹി. 132 - 656 (അബ്ബാസിദ് ഖിലാഫത്)</span><br>
                <p class="m-0 mb-1">
                    അബ്ബാസിദ് ആദ്യ കാലഘട്ടങ്ങളിൽ (ഹി. 132 - 350) ആണ് ഹദീസുകൾ കൃത്യമായി രേഖപ്പെടുത്തിയതും ഇസ്‌ലാമിക നിയമങ്ങൾ
                    രൂപപ്പെടുത്തിയതും.
                </p>

                <ul class="m-0">
                    <li class="mb-2">
                        ഹദീസ് ശേഖരണത്തിന്റെ വികാസം:<br>
                        <span class="small">
                            ഹി. 200 - 303: ഇമാം ബുഖാരി, മുസ്‌ലിം, തിർമിദി, അബൂ ദാവൂദ്, നസാഇ,
                            ഇബ്നു മാജ എന്നിവർ ഹദീസുകൾ കൃത്യമായി രേഖപ്പെടുത്തിയത്.
                        </span>
                    </li>

                    <li class="mb-2">
                        ഇസ്‌ലാമിക നിയമങ്ങളുടെ വളർച്ച:<br>
                        <span class="small">
                            ഹി. 100 - 241: ഹദീസുകളുടെയും ഖുർആനിന്റെയും അടിസ്ഥാനത്തിൽ ഇസ്‌ലാമിക നിയമങ്ങൾ രൂപപ്പെടുത്തി. ഇമാം
                            അബൂ ഹനീഫ, മാലിക്, ഷാഫി, അഹ്മദ് ബിൻ ഹൻബൽ.
                        </span>
                    </li>
                </ul>
            </div>

            <div class="ref-box ref-hadith mt-2" id="ref2">
                <span class="fw-bold">[2]. ഹി. 297 - 567 (ഫാതിമി ഖിലാഫത്)</span><br>
                <p class="small">
                    ആദ്യ കാല അബ്ബാസിദുകൾക്ക് ഇത്തരം ചടങ്ങുകൾ ഇല്ലാതിരുന്നതിനാൽ, ഫാതിമിദുകൾ “ഞങ്ങളാണ് അഹ്ലുൽ ബൈത്-ന്റെ
                    യഥാർത്ഥ അവകാശികൾ.” എന്ന് തെളിയിക്കാൻ മീലാദിനെ ഉപയോഗിച്ചു.
                </p>

                <ul class="m-0">
                    <li class="mb-2">
                        <span class="fw-bold">അൽ-മക്രിസി (Al-Maqrīzī 845 ഹി.)</span><br>
                        <span>
                            ഫാത്തിമിദ് ഖലീഫമാർ വർഷം മുഴുവൻ ആഘോഷിച്ചിരുന്ന ഉത്സവങ്ങളിൽ മൗലിദ് അന്നബി ﷺ, കൂടാതെ അലി,
                            ഫാത്തിമ, ഹസൻ, ഹുസൈൻ, ഖലീഫയുടെ ജന്മദിനങ്ങൾ ഉൾപ്പെടുന്നു.
                        </span>
                        <a href="https://archive.org/search?query=%D8%A7%D9%84%D8%AE%D8%B7%D8%B7+%D8%A7%D9%84%D9%85%D9%82%D8%B1%D9%8A%D8%B2%D9%8A"
                            target="_blank">
                            Archive.org
                        </a>
                        <a href="https://shamela.ws/" target="_blank">Shamela</a>
                        <br>
                        <em>- അൽ-ഖിത്തത് (അൽ-മവാഇസ് വൽ-ഇഅ്തിബാർ ബി-ദിക്രി അൽ-ഖിതത് വൽ-ആഥാർ)</em><br>
                        <em>- ഇത്തിആസുൽ ഹുനഫാ ബി അഖ്ബാരി അൽ-ഐമ്മത്തി അൽ-ഫാത്വിമിയ്യീനൽ ഖുലഫാ (ഫാത്വിമി ഖിലാഫത്തിൻ്റെ ചരിത്രം
                            മാത്രം പ്രതിപാദിക്കുന്ന ഒരു പുസ്തകമാണിത്.)</em>
                    </li>

                    <li>
                        <span class="fw-bold">ബ്രിട്ടാനിക്ക (എൻസൈക്ലോപീഡിയ)</span><br>
                        <span>
                            11-ആം നൂറ്റാണ്ടിൽ ഈജിപ്തിലെ ശിയാ ഫാത്തിമിദ് ഭരണാധികാരികൾ നാല് മൗലിദുകൾ ആഘോഷിച്ചിരുന്നു: നബി ﷺ,
                            അലി, ഫാത്തിമ, ഭരണത്തിലുള്ള ഖലീഫ.
                        </span>
                        <a href="https://www.britannica.com/topic/mawlid" target="_blank"> Britannica.com</a>
                        <br>
                        <em>- Mawlid article</em>
                    </li>

                    {{-- <li class="mb-2">
                        <span class="fw-bold">ഡോ. യാസിർ ഖാദി (ആധുനിക പണ്ഡിതൻ)</span><br>
                        <span>
                            അൽ-മക്രിസിയും ഇബ്‌നു അൽ-മഅ്മൂനും അടക്കം ചരിത്രകാരന്മാരെ ഉദ്ധരിച്ച് → ഫാത്തിമിദ് ഭരണകാലത്താണ്
                            ആദ്യമായി സർക്കാർ തലത്തിൽ മൗലിദ് ആഘോഷം തുടങ്ങിയത്.
                        </span>
                        <a href="https://5pillarsuk.com/2015/01/01/dr-yasir-qadhi-on-the-origin-of-the-mawlid-and-the-fatimids/"
                            target="_blank"> 5pillarsuk.com</a>
                        <br>
                        <em>- ലേഖനം: Origin of Mawlid and the Fatimids</em>
                    </li>

                    <li class="m-0">
                        <span class="fw-bold">Islamic Centre UK</span><br>
                        <span>
                            മൗലിദിന്റെ ചരിത്രം സംഗ്രഹിച്ച്: ഫാത്തിമിദുകൾ ആണ് ആദ്യമായി സർക്കാർ തലത്തിൽ മൗലിദ് ആരംഭിച്ചത്.
                        </span>
                        <a href="https://5pillarsuk.com/2015/01/01/dr-yasir-qadhi-on-the-origin-of-the-mawlid-and-the-fatimids/"
                            target="_blank"> 5pillarsuk.com</a>
                        <br>
                        <em>- PDF: History of Mawlid</em>
                    </li> --}}
                </ul>
            </div>

            <div class="ref-box ref-hadith mt-2" id="ref3">
                <span class="fw-bold">[3]. ഹി. 586 - 630 (എർബിൽ കാലഘട്ടം - മുളഫ്ഫറുദ്ദീൻ ഗോക്ബുരി)</span><br>

                <p class="small fst-italic">
                    ഫാത്വിമി കാലഘട്ടത്തിലെ ആഘോഷങ്ങൾ ശിയാ സ്വാധീനത്തിലായിരുന്നത് കൊണ്ട് സുന്നി പണ്ഡിതന്മാർക്ക്
                    മൗലിദിനോട് എതിർപ്പുണ്ടായിരുന്നു.
                </p>

                <p class="small">
                    സലാഹുദ്ദീൻ അയ്യൂബി യുടെ സഹോദരിയുടെ ഭർത്താവായിരുന്ന മുളഫ്ഫറുദ്ദീൻ ഗോക്ബുരി മൗലിദ് വലിയ
                    ജനപങ്കാളിത്തത്തോടെ, ദാനധർമ്മം, കവിതകളും പ്രസംഗങ്ങളും ഉൾപ്പെടുത്തി ആഴ്ചകളോളം ആഘോഷിച്ചു.
                </p>

                <ul class="m-0">
                    <li>
                        <span class="fw-bold">ഇബ്ന്‍ ദഹിയ (Ibn Dihya, d. 633H)</span><br>
                        അദ്ദേഹം തന്നെ ഗോക്ബുരിക്കു വേണ്ടി “മൗലിദ്” ഗ്രന്ഥം എഴുതിയിരുന്നു.<br>
                        <em>- al-Tanwīr fī Mawlid al-Bashīr al-Nadhīr</em>
                    </li>

                    <li>
                        <span class="fw-bold">ഇമാദ് അൽദീൻ അൽ-ഇസ്ഫഹാനി (d. 597H)</span><br>
                        അദ്ദേഹം സലാഹുദ്ദീൻ അയ്യൂബിയുടെ കാലഘട്ട ചരിത്രകാരൻ ആണ്. (Ibn Khallikān, Ibn Kathir മുതലായവർ) ഈ രേഖകൾ
                        ആശ്രയിച്ചു.<br>
                        <em>- al-Barq al-Shāmī</em>
                    </li>

                    <li>
                        <span class="fw-bold">ഇബ്ന്‍ ഖലികാൻ (Ibn Khallikān, d. 681H)</span><br>
                        <em>- 'വഫയാത്തുൽ അഅ്യാൻ' (Wafayāt al-Aʿyān)</em>
                    </li>

                    <li>
                        <span class="fw-bold">ഇബ്ന്‍ കസീർ (Ibn Kathīr, d. 774H)</span><br>
                        <em>- 'അൽ-ബിദായ വൻ നിഹായ' (al-Bidāyah wa-l-Nihāyah)</em>
                    </li>

                    <li>
                        <span class="fw-bold">അൽ-സൂയൂത്തി (al-Suyūṭī, d. 911H)</span><br>
                        പ്രശസ്ത ശാഫിഈ പണ്ഡിതൻ.
                        <em>- Husn al-Maqṣid fī ʿAmal al-Mawlid</em>
                    </li>

                    <li class="mb-2">
                        <span class="fw-bold">അൽ-മക്രിസി (Al-Maqrīzī 845 ഹി.)</span><br>
                        <a href="https://archive.org/search?query=%D8%A7%D9%84%D8%AE%D8%B7%D8%B7+%D8%A7%D9%84%D9%85%D9%82%D8%B1%D9%8A%D8%B2%D9%8A"
                            target="_blank">
                            Archive.org
                        </a>
                        <em>- അൽ-ഖിത്തത് </em>
                    </li>
                </ul>
            </div>

            <div class="ref-box ref-hadith mt-2" id="ref4">
                <span class="fw-bold">[4]. ഹി. 648 - 923 (മമ്ലുക് സാമ്രാജ്യം)</span><br>
                <p class="small">
                    മമ്ലുക്കുകാർ ഫാത്വിമി കാലഘട്ടത്തിലെ ആഘോഷങ്ങൾ ഏറ്റെടുത്ത് കൂടുതൽ സങ്കീര്‍ണമായ ആഘോഷമായി വികസിപ്പിച്ചു.
                </p>

                <ul class="m-0">
                    <li>
                        <span class="fw-bold">ഇബ്ന്‍ തഘ്രി-ബർദീ (Ibn Taghribirdi)</span><br>
                        <em>- al-Nujūm al-Zāhirah fī Mulūk Miṣr wa-al-Qāhirah</em>
                    </li>

                    <li>
                        <span class="fw-bold">ഇബ്ന്‍ ഇയാസ് (Ibn Iyas)</span><br>
                        <em>- Badā'iʿ al-Zuhūr fī Waqā'iʿ al-Duhūr</em>
                    </li>

                    <li class="mb-2">
                        <span class="fw-bold">അൽ-മക്രിസി (Al-Maqrīzī 845 ഹി.)</span><br>
                        <a href="https://archive.org/search?query=%D8%A7%D9%84%D8%AE%D8%B7%D8%B7+%D8%A7%D9%84%D9%85%D9%82%D8%B1%D9%8A%D8%B2%D9%8A"
                            target="_blank">
                            Archive.org
                        </a>
                        <em>- അൽ-ഖിത്തത് </em>
                    </li>
                </ul>

                <ul class="m-0">
                    <li class="mb-2">
                        <span class="fw-bold">അനുകൂലിച്ച പണ്ഡിതന്മാർ</span><br>
                        <span class="small">
                            അൽ-സുയൂതി (Al-Suyuti ഹിജ്റി 849-911) <em>- Husn al-Maqṣid fī ʿAmal al-Mawlid.</em>
                        </span><br>
                        <span class="small">
                            അൽ-ദിംയാത്തി (Al-Dimyati ഹിജ്റി 850-908) <em>- Al-Mawlid al-Nabawi.</em>
                        </span><br>
                    </li>

                    <li class="mb-2">
                        <span class="fw-bold">എതിർത്ത പണ്ഡിതന്മാർ</span><br>
                        <span class="small">
                            ഇബ്ന്‍ തയ്മിയ്യ (Ibn Taymiyyah ഹിജ്റി 661-728) <em>- Iqtidā' al-Sirāt al-Mustaqīm.</em>
                        </span><br>
                        <span class="small">
                            ഇമാം അൽ-ഷാതിബി (Imam al-Shatibi ഹിജ്റി 538-790) <em>- Al-I'tisām.</em>
                        </span><br>
                        <span class="small">
                            ഇബ്ന്‍ അൽ-ഹാജ് (Ibn al-Hajj ഹിജ്റി 723-799) <em>- Madkhal al-Hawāyi.</em>
                        </span><br>
                    </li>
                </ul>
            </div>

            <div class="ref-box ref-hadith mt-2 mb-3" id="ref5">
                <span class="fw-bold">[5]. ഹി. 648 - 923 ഹി. 699 - 1342 (ഒട്ടോമാൻ സാമ്രാജ്യം)</span><br>
                <ul class="m-0">
                    <li>
                        <span class="fw-bold">Halil İnalcık</span><br>
                        <em>- The Ottoman Empire and Its Heritage</em><br>
                        <em>- The Ottoman Empire: The Classical Age 1300-1600</em>
                    </li>

                    <li>
                        <span class="fw-bold">Daniel Goffman</span><br>
                        <em>- The Ottoman Empire and Early Modern Europe</em>
                    </li>

                    <li>
                        <span class="fw-bold">ames M. Perry</span><br>
                        <em>- Ottoman Imperialism and the Bosnian Ulema</em>
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // document.querySelectorAll('.accordion-collapse').forEach(collapseEl => {
        //     collapseEl.addEventListener('shown.bs.collapse', function() {
        //         const header = this.previousElementSibling; // accordion-header
        //         header.scrollIntoView({
        //             behavior: 'smooth',
        //             block: 'start'
        //         });
        //     });
        // });

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
