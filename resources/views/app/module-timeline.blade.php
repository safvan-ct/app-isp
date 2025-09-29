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
            background-color: #dee2e6;
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

        /* .accordion-button::after {
                                                                    content: none;
                                                                } */

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
            /* border-left: 3px solid var(--clr-accent); */
            margin-left: 20px;
            padding: 20px 0 10px 10px;
            background-color: var(--clr-surface);
            border-radius: 0 0 8px 8px;
        }

        .active-lesson {
            background-color: var(--clr-bg);
            border-left: 3px solid var(--clr-accent);
            font-weight: 600;
        }
    </style>
@endpush

@section('content')
    <x-app.banner :number="$moduleId + 1" :type="'Module'" :title="$topic['modules'][$moduleId]['title']" :desc="$topic['modules'][$moduleId]['desc']" />

    <main class="container py-4 notranslate">
        <div class="row justify-content-center">
            <div class="col-lg-11">
                <div class="timeline mb-5">
                    @foreach ($module['notes'] as $note)
                        <div class="timeline-item">
                            <div class="circle"></div>
                            <div class="timeline-content pb-1">
                                <h5>{{ $note['title'] }}</h5>

                                @foreach ($note['desc'] as $desc)
                                    <div class="m-0 text-justify {{ $loop->last ? '' : 'mb-1' }}" style="text-indent: 2em">
                                        {!! $desc !!}
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="col-lg-8">
                <section id="full-curriculum" class="mb-5">
                    <h2 class="h5 text-emerald mb-3 border-bottom pb-2 fw-bold">
                        <i class="fas fa-lightbulb text-accent me-1"></i>
                        ബന്ധപ്പെട്ട വിഷയങ്ങൾ
                    </h2>

                    <div class="accordion accordion-flush" id="curriculumAccordion">
                        @foreach ($topic['modules'] as $key => $item)
                            <div class="accordion-item">
                                <h2 class="accordion-header shadow-sm">
                                    @if (!empty($item['lessons']))
                                        <button
                                            class="accordion-button fw-bold text-emerald {{ $moduleId == $key ? '' : 'collapsed' }}"
                                            type="button" data-bs-toggle="collapse" data-bs-target="#{{ $key }}">
                                            <i
                                                class="fas {{ $moduleId == $key ? 'fa-check-circle text-success' : 'fa-circle text-accent' }} me-2 "></i>
                                            {{ $key + 1 }}. {{ $item['title'] }}
                                        </button>
                                    @else
                                        <a href="{{ route('answers.show', ['menu_slug' => 'topics', 'module_slug' => $topic['slug'], 'question_slug' => $key]) }}"
                                            class="accordion-button fw-bold text-emerald {{ $moduleId == $key ? '' : 'collapsed' }} text-decoration-none accordion-link">
                                            <i
                                                class="fas {{ $moduleId == $key ? 'fa-check-circle text-success' : 'fa-circle text-accent' }} me-2 "></i>
                                            {{ $key + 1 }}. {{ $item['title'] }}
                                        </a>
                                    @endif
                                </h2>

                                @if (!empty($item['lessons']))
                                    <div id="{{ $key }}"
                                        class="accordion-collapse collapse {{ $moduleId == $key ? 'show' : '' }}"
                                        data-bs-parent="#curriculumAccordionOffcanvas"
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
