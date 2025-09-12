@extends('layouts.app')

@section('content')
    <x-app.topbar :title="$questions['title']" :url="route('questions.show', ['menu_slug' => 'topics', 'module_slug' => $questions['slug']])" />

    <div class="container my-2 pb-5">
        <x-app.banner :title="$questions['chapters'][$questionSlug]" :desc="'നിസ്കാരത്തിന്റെ ഫർളുകൾ (നിർബന്ധിത കാര്യങ്ങൾ)'" :search="false" :author="'Author Name'" :review="date('M d, Y') . ' by Reviewer Name'" />

        <!-- Step Card -->
        <div class="base-card shadow-sm mb-4 border rounded-2">
            <div class="row g-4 align-items-center">
                <!-- Left -->
                <div class="col-md-4 text-center">
                    <h4 id="actionTitle" class="h5 fw-bold"></h4>
                    <span id="actionIcon"></span>
                </div>

                <!-- Right -->
                <div class="col-md-8">

                    <span id="stepsPanel"></span>

                    <!-- Controls -->
                    <div class="mt-3 d-flex flex-wrap gap-2">
                        <button id="playBtn" class="btn btn-sm btn-primary">🔊 Play</button>
                        <button id="repeatBtn" class="btn btn-sm btn-warning">↺ Repeat</button>
                        <button id="showMoreBtn" class="btn btn-sm btn-outline-secondary">ℹ️ More</button>
                    </div>

                    <!-- Extra Info -->
                    <div id="morePanel" class="mt-2 d-none small">
                        <p> <span id="moreText"></span></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Navigation -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <button id="prevBtn" class="btn btn-outline-secondary">← Previous</button>
            <span class="small">Step <span id="stepNum">1</span> / <span id="stepTotal">0</span></span>
            <button id="nextBtn" class="btn btn-success">Next →</button>
        </div>

        <!-- Progress -->
        <div class="progress mb-4">
            <div id="progress" class="progress-bar bg-success" style="width: 0%"></div>
        </div>

        <h5 class="text-emerald fw-bold">Related Topics</h5>
        @foreach ($questions['chapters'] as $item)
            @continue($questionSlug == $loop->index)

            <x-app.related-topics :title="$loop->index + 1 . ' : ' . $item" :url="route('answers.show', [
                'menu_slug' => 'topics',
                'module_slug' => $questions['slug'],
                'question_slug' => $loop->index,
            ])" />
        @endforeach
    </div>
@endsection

@push('scripts')
    <script>
        const baseSteps = [{
                title: '1. ഖിബ്‌ലക്ക് മുന്നിടൽ, നിയ്യത്ത് (ഹൃദയത്തിലെ ഉറച്ച ഉദ്ദേശം) ഉണ്ടായിരിക്കണം.',
                icon: "{{ asset('img/namaz/st.jpg') }}",
                steps: [{
                        title: 'എവിടെയായിരുന്നാലും ഖിബ്‌ലക്ക് (മസ്ജിദുല്‍ ഹറാം) നേര്‍ക്ക് മുഖം തിരിക്കേണ്ടത്‌.',
                        dikr: [],
                        quran: [
                            "📖 ഏതൊരിടത്ത് നിന്ന് നീ പുറപ്പെടുകയാണെങ്കിലും മസ്ജിദുല്‍ ഹറാമിന്റെ നേര്‍ക്ക് (പ്രാര്‍ത്ഥനാവേളയില്‍) നിന്റെ മുഖം തിരിക്കേണ്ടതാണ്‌. <em class='small text-muted'> - Quran 2:144, 149-150</em>",
                        ],
                        hadith: []
                    },
                    {
                        title: 'നിയ്യത്ത് (ഹൃദയത്തിലെ ഉറച്ച ഉദ്ദേശം) - <span class="badge bg-success text-white rounded-pill px-3 py-2">നിർബന്ധം</span>',
                        dikr: [{
                                title: "നിയ്യത്ത് ചുരുങ്ങിയ രൂപം: <i>(നിസ്കാരത്തിന്റെ പേര്)</i> എന്ന ഫർള് ഞാൻ നിസ്കരിക്കുന്നു",
                                desc: "ഉദാ: <span class='fw-bold'>ളുഹർ</span> എന്ന ഫർള് ഞാൻ നിസ്കരിക്കുന്നു."
                            },
                            {
                                title: "നിയ്യത്ത് പൂർണ്ണ രൂപം: <i>(നിസ്കാരത്തിന്റെ പേര്)</i> എന്ന <i>(ഫർള്/സുന്നത്ത്)</i> നിസ്കാരം <i>(റകഅതുകളുടെ എണ്ണം)</i> റക്അത്ത് ഖിബ്ലക്ക് മുന്നിട്ട് <i>(അദാആയി/ഖളാആയി)</i> അല്ലാഹുവിന് വേണ്ടി ഞാൻ <i>(ജമാഅത്തായി(ഒറ്റക്ക് അല്ലെങ്കിൽ))</i> നിസ്കരിക്കുന്നു.",
                                desc: "ഉദാ: <span class='fw-bold'>ളുഹർ</span> എന്ന <span class='fw-bold'>ഫർള്</span> നിസ്കാരം <span class='fw-bold'>നാല്</span> റക്അത്ത് ഖിബ്ലക്ക് മുന്നിട്ട് <span class='fw-bold'>അദാആയി</span> അല്ലാഹുവിന് വേണ്ടി ഞാൻ നിസ്കരിക്കുന്നു."
                            }
                        ],
                        quran: [
                            "📖 നമസ്കാരത്തില്‍ ഭക്തിയുള്ളവരായ സത്യവിശ്വാസികള്‍ വിജയം പ്രാപിച്ചിരിക്കുന്നു. <em class='small text-muted'> - Quran 23:1-2</em>",
                        ],
                        hadith: [
                            '🕌 പ്രവൃത്തികൾ എല്ലാം നിയ്യത്തിനെ ആശ്രയിച്ചാണ്. ഓരോരുത്തർക്കും അവൻ ഉദ്ദേശിച്ചതു മാത്രമേ ലഭിക്കൂ. <em class="small text-muted"> - ബുഖാരി:1, Muslim:4927 </em>'
                        ]
                    }
                ],
                more: "സുന്നത്ത് നിസ്കാരത്തിന്റെ നിയ്യത്ത്: സമയമോ കാരണമോ ഇല്ലാത്ത കേവല സുന്നത്ത് നിസ്കാരമാണെങ്കിൽ <b>'ഞാൻ നിസ്കരിക്കുന്നു'</b> എന്ന് കരുതലേ നിർബന്ധമുള്ളൂ.<br><br> സമയമോ കാരണമോ ഉള്ള സുന്നത്ത് നിസ്കാരമാണെങ്കിൽ: </br>1) ഞാൻ നിസ്കരിക്കുന്നു എന്നും </br>(2) ഇന്ന സുന്നത്ത് നിസ്കാരമാണെന്നും കരുതണം. </br>(ഉദാ: ളുഹറിന്റെ മുമ്പുള്ള / ശേഷമുള്ള  സുന്നത്ത് ഞാൻ നിസ്കരിക്കുന്നു)",
            },
            {
                title: '2. തക്ബീറത്തുൽ ഇഹ്റാം',
                icon: [
                    "{{ asset('img/namaz/takbir.png') }}",
                ],
                steps: [{
                    title: 'തക്ബീറത്തുൽ ഇഹ്റാം (അല്ലാഹു അക്ബർ) - <span class="badge bg-success text-white rounded-pill px-3 py-2">നിർബന്ധം</span>',
                    dikr: [{
                        title: "അല്ലാഹു അക്ബർ",
                        desc: ''
                    }],
                    quran: [],
                    hadith: [
                        '🕌 നമസ്കാരം ആരംഭിക്കുമ്പോഴും, റുകൂവിനെ മുമ്പും, റുകൂവിനെ ശേഷം പഴയ സ്ഥാനത്തേക്ക് മടങ്ങിയപ്പോഴും നബി (സ) തന്റെ കൈകൾ തോളുകൾക്ക് നേരെ ഉയർത്തുന്നത് ഞാൻ കണ്ടു, <em class="small text-muted"> - ബുഖാരി:735, മുസ്ലിം:861,862,883,884</em>',
                        '🕌 നബി (ﷺ) നമസ്കാരം ആരംഭിക്കുമ്പോഴും തക്ബീർ ചൊല്ലി. <em class="small text-muted"> - ബുഖാരി:789, മുസ്ലിം:868</em>',
                    ]
                }],
                more: '',
            },
            {
                title: '3. നിൽക്കാൻ കഴിവുള്ളവൻ നിൽക്കൽ',
                icon: [
                    "{{ asset('img/namaz/qiyam.png') }}",
                ],
                steps: [{
                        title: 'നിൽക്കാൻ കഴിവുള്ളവൻ നിൽക്കൽ - <span class="badge bg-success text-white rounded-pill px-3 py-2">നിർബന്ധം</span>',
                        dikr: [],
                        quran: [
                            "📖 അല്ലാഹുവിന്റെ മുമ്പില്‍ ഭയഭക്തിയോടു കൂടി നിന്നുകൊണ്ടാകണം നിങ്ങള്‍ പ്രാര്‍ത്ഥിക്കുന്നത്‌. <em class='small text-muted'> - Quran 2:238 </em>",
                        ],
                        hadith: [
                            '🕌 നിന്നുകൊണ്ട് നമസ്കരിക്കുക, നിങ്ങൾക്ക് കഴിയില്ലെങ്കിൽ ഇരുന്നുകൊണ്ട് നമസ്കരിക്കുക, നിങ്ങൾക്ക് അതിനും കഴിയില്ലെങ്കിൽ, നിങ്ങളുടെ വശം ചെരിഞ്ഞ് കിടന്ന് നമസ്കരിക്കുക. <em class="small text-muted"> - ബുഖാരി:1117</em>',
                        ]
                    },
                    {
                        title: 'വലതു കൈ ഇടതു കൈയ്ക്കു മുകളിൽ വയ്ക്കുക',
                        dikr: [],
                        quran: [],
                        hadith: [
                            '🕌 നബി (ﷺ) വലതു കൈ ഇടതു കൈക്ക് മുകളിൽ വച്ചു. <em class="small text-muted"> - മുസ്ലിം:896</em>',
                        ]
                    },
                    {
                        title: 'തക്ബീറിനും ഖുർആൻ പാരായണത്തിനും ഇടയിൽ - <span class="badge bg-primary text-white rounded-pill px-3 py-2">സുന്നത്ത്</span>',
                        dikr: [{
                            title: "",
                            desc: '<p class="m-0 text-ar lh-lg" dir="rtl">اللَّهُمَّ بَاعِدْ بَيْنِي وَبَيْنَ خَطَايَاىَ كَمَا بَاعَدْتَ بَيْنَ الْمَشْرِقِ وَالْمَغْرِبِ، اللَّهُمَّ نَقِّنِي مِنَ الْخَطَايَا كَمَا يُنَقَّى الثَّوْبُ الأَبْيَضُ مِنَ الدَّنَسِ، اللَّهُمَّ اغْسِلْ خَطَايَاىَ بِالْمَاءِ وَالثَّلْجِ وَالْبَرَدِ</p>',
                        }],
                        quran: [],
                        hadith: [
                            '🕌 തക്ബീറിനും ഖുർആൻ പാരായണത്തിനും ഇടയിലുള്ള ഇടവേളയിൽ നിങ്ങൾ എന്താണ് പറയുന്നത്?" നബി (ﷺ) പറഞ്ഞു:അല്ലാഹുമ്മ, ബാഇദ് ബൈനി ... <em class="small text-muted"> - ബുഖാരി:744</em>'
                        ]
                    }
                ],
                more: '',
            },
            {
                title: '4. ഫാതിഹ & സൂറത്',
                icon: "{{ asset('img/namaz/qiyam.png') }}",
                steps: [{
                        title: 'ഓരോ റകഅത്തിലും ഫാത്തിഹ ഓതണം - <span class="badge bg-success text-white rounded-pill px-3 py-2">നിർബന്ധം</span>',
                        dikr: [],
                        quran: [
                            '📖 ആവര്‍ത്തിച്ചു പാരായണം ചെയ്യപ്പെടുന്ന ഏഴ് വചനങ്ങളും മഹത്തായ ഖുര്‍ആനും തീര്‍ച്ചയായും നിനക്ക് നാം നല്‍കിയിട്ടുണ്ട്‌. - <em class="small text-muted">Quran 15:87</em>',
                        ],
                        hadith: [
                            '🕌 ഉമ്മുൽ ഖുർആൻ പാരായണം ചെയ്യാത്തവൻ നമസ്കാരം നിർവഹിച്ചതായി കണക്കാക്കില്ല. <em class="small text-muted"> - മുസ്ലിം:875,878,883,884</em>',
                        ]
                    },
                    {
                        title: 'ഫാതിഹയിൽ ബിസ്മി ഉച്ചത്തിൽ ചൊല്ലൽ & ഫാതിഹക്ക് ശേഷം ആമീൻ പറയൽ',
                        dikr: [],
                        quran: [],
                        hadith: [
                            '🕌 ഞാൻ നബി (ﷺ), അബൂബക്കർ, ഉമർ, ഉസ്മാൻ (റ) എന്നിവർക്കൊപ്പവും പ്രാർത്ഥന നിരീക്ഷിച്ചു, എന്നാൽ അവരാരും ബിസ്മി... ചൊല്ലുന്നത് ഞാൻ കേട്ടിട്ടില്ല.  <em class="small text-muted"> - മുസ്ലിം:890,892</em>',
                            '🕌 നിങ്ങളിൽ ആരെങ്കിലും നിങ്ങളുടെ ഇമാമായി പ്രവർത്തിക്കട്ടെ. അവൻ ഓതുമ്പോൾ: {غَيْرِ الْمَغْضُوبِ عَلَيْهِمْ وَلَا الضَّالِّينَ}, ആമീൻ എന്ന് പറയുക. <em class="small text-muted"> - മുസ്ലിം:904,915,917,920</em>',
                        ]
                    },
                    {
                        title: 'ആദ്യത്തെ രണ്ട് റകഅത്തുകളിൽ ഫാതിഹക്ക് ശേഷം സൂറത് ഓതൽ - <span class="badge bg-primary text-white rounded-pill px-3 py-2">സുന്നത്ത്</span>',
                        dikr: [{
                            title: "ജമാഅത്തിൽ ചെറിയ സൂറത് ഓതൽ - <span class='badge bg-primary text-white rounded-pill px-3 py-2'>സുന്നത്ത്</span>",
                            desc: ''
                        }],
                        quran: [],
                        hadith: [
                            '🕌 നബി (ﷺ) ഞങ്ങൾക്ക് നമസ്കാരത്തിന് നേതൃത്വം നൽകി, ആദ്യത്തെ രണ്ട് റക്അത്തുകളിൽ സൂറത്തുൽ ഫിത്തിഹയും മറ്റ് രണ്ട് സൂറത്തുകളും ഓതി. <em class="small text-muted"> - മുസ്ലിം:1012-1015</em>',
                            '🕌 നിങ്ങളിൽ ആരെങ്കിലും ആളുകളെ നമസ്കാരത്തിന് നയിക്കുന്നുവെങ്കിൽ അവൻ അൽപ്പം മാത്രം സംസാരിക്കണം <em class="small text-muted"> - മുസ്ലിം:1044, 1046</em>'
                        ]
                    }
                ],
                more: ''
            },
            {
                title: '5. റുകൂഅ്',
                icon: [
                    "{{ asset('img/namaz/takbir.png') }}",
                    "{{ asset('img/namaz/rk.jpg') }}",
                ],
                steps: [{
                        title: 'റുകൂഅ് - <span class="badge bg-success text-white rounded-pill px-3 py-2">നിർബന്ധം</span>',
                        dikr: [],
                        quran: [
                            '📖 നിങ്ങള്‍ കുമ്പിടുകയും, സാഷ്ടാംഗം ചെയ്യുകയും, നിങ്ങളുടെ രക്ഷിതാവിനെ ആരാധിക്കുകയും, നന്‍മ പ്രവര്‍ത്തിക്കുകയും ചെയ്യുക. - <em class="small text-muted">Quran 22:77</em>',
                        ],
                        hadith: [
                            '🕌 നബി (ﷺ) നമസ്കാരം ആരംഭിക്കുമ്പോഴും, റുകൂവിനെ മുമ്പും, റുകൂവിനെ ശേഷം പഴയ സ്ഥാനത്തേക്ക് മടങ്ങിയപ്പോഴും നബി (സ) തന്റെ കൈകൾ തോളുകൾക്ക് നേരെ ഉയർത്തുന്നത് ഞാൻ കണ്ടു, <em class="small text-muted"> - ബുഖാരി:735, മുസ്ലിം:861,862,883,884</em>',
                            '🕌 നബി (ﷺ) കുമ്പിടുമ്പോൾ തക്ബീർ ചൊല്ലുകയും ചെയ്യുമായിരുന്നു. <em class="small text-muted"> - ബുഖാരി:789, മുസ്ലിം:868</em>',
                        ]
                    },
                    {
                        title: 'റുകൂഇലെ ദിക്ർ',
                        dikr: [{
                            title: '',
                            desc: '<p class="m-0 text-ar fw-bold text-center mt-2 mb-2"> سُبْحَانَ رَبِّيَ الْعَظِيمِ وَبِحَمْدِهِ / سُبْحَانَ رَبِّيَ الْعَظِيمِ</p>',
                        }],
                        quran: [],
                        hadith: [
                            '🕌 നബി (ﷺ) കുമ്പിട്ടപ്പോൾ പറഞ്ഞു: {سُبْحَانَ رَبِّيَ الْعَظِيمِ وَبِحَمْدِهِ} മൂന്ന് തവണ. <em class="small text-muted"> - തിർമിധി:262, മുസ്ലിം:1074,1086, അബു ദാവൂദ്:869,870,874</em>',
                        ]
                    },
                    {
                        title: "<span class='text-danger'>റുകൂഇൽ ഖുർആൻ പാരായണം ചെയ്യാൻ പാടില്ല.</span>",
                        dikr: [],
                        quran: [],
                        hadith: [
                            '🕌 നബി (ﷺ) എന്നെ റുകൂഇലും സുജൂദിലും (ഖുർആൻ) പാരായണം ചെയ്യുന്നത് വിലക്കി. <em class="small text-muted"> - മുസ്ലിം:1076,1077,1080</em>'
                        ]
                    },
                ],
                more: ''
            },
            {
                title: '6. ഇഅ്തിദാല്‍',
                icon: [
                    "{{ asset('img/namaz/takbir.png') }}",
                    "{{ asset('img/namaz/st.jpg') }}",
                ],
                steps: [{
                        title: 'ഇഅ്തിദാല്‍ - <span class="badge bg-success text-white rounded-pill px-3 py-2">നിർബന്ധം</span>',
                        dikr: [{
                            title: '',
                            desc: '<p class="m-0 text-ar fw-bold text-center mt-2 mb-2">سَمِعَ اللَّهُ لَمِنْ حَمِدَهُ‏.</p>',
                        }],
                        quran: [],
                        hadith: [
                            '🕌 നബി (ﷺ) നമസ്കാരം ആരംഭിക്കുമ്പോഴും, റുകൂവിനെ മുമ്പും, റുകൂവിനെ ശേഷം പഴയ സ്ഥാനത്തേക്ക് മടങ്ങിയപ്പോഴും നബി (സ) തന്റെ കൈകൾ തോളുകൾക്ക് നേരെ ഉയർത്തുന്നത് ഞാൻ കണ്ടു, <em class="small text-muted"> - ബുഖാരി:735, മുസ്ലിം:861,862,883,884</em>',
                            '🕌 നബി (ﷺ) റുകൂവിനെ ശേഷം എഴുന്നേൽക്കുമ്പോൾ "സമിഅല്ലാഹു ലിമൻ ഹമീദ" എന്ന് പറഞ്ഞു. <em class="small text-muted"> - ബുഖാരി:789, മുസ്ലിം:868</em>',
                        ]
                    },
                    {
                        title: 'ഇഅ്തിദാല്‍ലെ ദിക്ർ',
                        dikr: [{
                            title: '',
                            desc: '<p class="m-0 text-ar fw-bold text-center mt-2 mb-2 lh-lg"> رَبَّنَا وَلَكَ الْحَمْدُ / رَبَّنَا لَكَ الْحَمْدُ مِلْءَ السَّمَوَاتِ وَالأَرْضِ وَمِلْءَ مَا شِئْتَ مِنْ شَىْءٍ بَعْدُ.</p>',
                        }],
                        quran: [],
                        hadith: [
                            '🕌 എന്നിട്ട് നിൽക്കുമ്പോൾ പറയുക: ഞങ്ങളുടെ രക്ഷിതാവേ, നിനക്കു സ്തുതി. (رَبَّنَا وَلَكَ الْحَمْدُ) <em class="small text-muted"> - ബുഖാരി:789, മുസ്ലിം:868,913,1068,1069,1071,1072</em>',
                        ]
                    },
                    {
                        title: "ഖുനൂത്ത്",
                        dikr: [{
                            title: '',
                            desc: '<p class="m-0 text-ar fw-bold mt-2 mb-2 lh-lg">اللَّهُمَّ اهْدِنِي فِيمَنْ هَدَيْتَ، ‏‏‏‏‏‏وَعَافِنِي فِيمَنْ عَافَيْتَ، ‏‏‏‏‏‏وَتَوَلَّنِي فِيمَنْ تَوَلَّيْتَ، ‏‏‏‏‏‏وَبَارِكْ لِي فِيمَا أَعْطَيْتَ، ‏‏‏‏‏‏وَقِنِي شَرَّ مَا قَضَيْتَ إِنَّكَ تَقْضِي وَلَا يُقْضَى عَلَيْكَ، ‏‏‏‏‏‏وَإِنَّهُ لَا يَذِلُّ مَنْ وَالَيْتَ، ‏‏‏‏‏‏وَلَا يَعِزُّ مَنْ عَادَيْتَ، ‏‏‏‏‏‏تَبَارَكْتَ رَبَّنَا وَتَعَالَيْتَ</p>',
                        }],
                        quran: [],
                        hadith: [
                            '🕌 റൽ, ദഖ്‌വാൻ ഗോത്രങ്ങളെ ശിക്ഷിക്കാൻ അല്ലാഹുവിനോട് ആവശ്യപ്പെട്ടുകൊണ്ട് നബി (ﷺ) ഒരു മാസം ഫജ്ർ നമസ്കാരത്തിൽ ഖുനൂത്ത് പാരായണം ചെയ്തു. <em class="small text-muted"> - ബുഖാരി:1001-1003</em><br><br><em>ശാഫിഈ, മാലികി പണ്ഡിതന്മാർ അതിനെ സ്ഥിരം ആക്കി, ഹനഫി, ഹൻബലി പണ്ഡിതന്മാർ അത് ദുരന്തസമയങ്ങളിൽ മാത്രം എന്ന് പറഞ്ഞു.</em>',
                            '🕌 സഹീഹ് ഹദീസുകളിൽ വിറ്റർ നിസ്കാരത്തിലെ ഖുനൂത്ത് (ദുആ)യും ദുരന്തസമയത്തെ ഖുനൂത്ത്-വും തെളിഞ്ഞിട്ടുണ്ട്. <em class="small text-muted"> - അബു ദാവൂദ്:1425, തിർമിധി:464</em>'
                        ]
                    },
                ],
                more: ''
            },
            {
                title: '7. സുജൂദ്',
                icon: [
                    "{{ asset('img/namaz/sujood.webp') }}",
                    "{{ asset('img/namaz/sjd.png') }}",
                ],
                steps: [{
                        title: 'സുജൂദ് - <span class="badge bg-success text-white rounded-pill px-3 py-2">നിർബന്ധം</span>',
                        dikr: [{
                            title: '',
                            desc: '<p class="m-0 fw-bold text-center">അല്ലാഹു അക്ബർ</p>',
                        }],
                        quran: [
                            '📖 നിങ്ങള്‍ കുമ്പിടുകയും, സാഷ്ടാംഗം ചെയ്യുകയും, നിങ്ങളുടെ രക്ഷിതാവിനെ ആരാധിക്കുകയും, നന്‍മ പ്രവര്‍ത്തിക്കുകയും ചെയ്യുക. - <em class="small text-muted">Quran 22:77</em>',
                        ],
                        hadith: [
                            '🕌 നബി (ﷺ) സുജൂദ് ചെയ്യുമ്പോഴും തല ഉയർത്തുമ്പോഴും അദ്ദേഹം തക്ബീർ ചൊല്ലുമായിരുന്നു. <em class="small text-muted"> - ബുഖാരി:789, മുസ്ലിം:868</em>',
                            '🕌 നബി (ﷺ) ഏഴ് അസ്ഥികളിൽ സുജൂദ് ചെയ്യാൻ കൽപ്പിക്കപ്പെട്ടിരുന്നു, മുടിയും വസ്ത്രവും മടക്കുന്നത് അദ്ദേഹത്തിന് വിലക്കപ്പെട്ടിരുന്നു. <em class="small text-muted"> - മുസ്ലിം:1095, 1102, 1105, 1106, 1107</em>',
                        ]
                    },
                    {
                        title: 'സുജൂദിലെ ദിക്ർ',
                        dikr: [{
                            title: '',
                            desc: '<p class="m-0 text-ar fw-bold text-center mt-2 mb-2 lh-lg">سُبْحَانَ رَبِّيَ الْأَعْلَى / سُبْحَانَ رَبِّيَ الْأَعْلَى وَبِحَمْدِهِ</p>',
                        }],
                        quran: [],
                        hadith: [
                            '🕌 സുജൂദ് ചെയ്തപ്പോൾ പറഞ്ഞു: {سُبْحَانَ رَبِّيَ الْأَعْلَى وَبِحَمْدِهِ} മൂന്ന് തവണ. <em class="small text-muted"> - തിർമിധി:262, അബു ദാവൂദ്:869,870, മുസ്ലിം:1085</em>',
                        ]
                    },
                    {
                        title: "<span class='text-danger'>ഖുർആൻ പാരായണം ചെയ്യാൻ പാടില്ല.</span>",
                        dikr: [],
                        quran: [],
                        hadith: [
                            '🕌 നബി (ﷺ) എന്നെ റുകൂഇലും സുജൂദിലും (ഖുർആൻ) പാരായണം ചെയ്യുന്നത് വിലക്കി. <em class="small text-muted"> - മുസ്ലിം:1074,1076,1077,1080</em>'
                        ]
                    },
                ],
                more: ''
            },
            {
                title: '8. രണ്ട് സുജൂദുകള്‍ക്കിടയില്‍ അല്‍പനേരം ഇരിക്കുക',
                icon: [
                    "{{ asset('img/namaz/sitting.jpg') }}",
                ],
                steps: [{
                        title: 'രണ്ട് സുജൂദുകള്‍ക്കിടയില്‍ അല്‍പനേരം ഇരിക്കുക - <span class="badge bg-success text-white rounded-pill px-3 py-2">നിർബന്ധം</span>',
                        dikr: [{
                            title: '',
                            desc: '<p class="m-0 fw-bold text-center">അല്ലാഹു അക്ബർ</p>',
                        }],
                        quran: [],
                        hadith: [
                            '🕌 നബി (ﷺ) സുജൂദ് ചെയ്യുമ്പോഴും തല ഉയർത്തുമ്പോഴും അദ്ദേഹം തക്ബീർ ചൊല്ലുമായിരുന്നു. <em class="small text-muted"> - ബുഖാരി:789, മുസ്ലിം:868</em>',
                            '🕌 ഇടതു കാൽ (നിലത്ത്) നിവർത്തി വലതു കാൽ ഉയർത്തുമായിരുന്നു; കുനിഞ്ഞ് ഇരിക്കുന്ന പിശാചിന്റെ രീതി അദ്ദേഹം വിലക്കി, കാട്ടുമൃഗത്തെപ്പോലെ കൈകൾ വിരിച്ചു നിർത്തുന്നത് അദ്ദേഹം വിലക്കി. <em class="small text-muted"> - മുസ്ലിം:1110</em>'
                        ]
                    },
                    {
                        title: 'രണ്ട് സുജൂദുകള്‍ക്കിടയിലെ ദിക്ർ',
                        dikr: [{
                            title: '',
                            desc: '<p class="m-0 text-ar fw-bold text-center mt-2 mb-2 lh-lg">رَبِّ اغْفِرْ لِي / رَبِّ اغْفِرْ لِي وَارْحَمْنِي وَاجْبُرْنِي وَاهْدِنِي وَارْزُقْنِي</p>',
                        }],
                        quran: [],
                        hadith: [
                            '🕌 സുജൂദ് ചെയ്തിടത്തോളം ഇരുന്നുകൊണ്ട് പറഞ്ഞു: എന്റെ രക്ഷിതാവേ, എനിക്ക് മാപ്പ് നൽകണമേ <em class="small text-muted"> - അബു ദാവൂദ്:874, തിർമിധി:284</em>',
                        ]
                    }
                ],
                more: ''
            },
            {
                title: '9. ഥുമഅ്‌നീനത്ത് (അടങ്ങിപ്പാര്‍ക്കല്‍)',
                icon: [],
                steps: [{
                    title: 'പ്രാർത്ഥനയുടെ എല്ലാ സ്തംഭങ്ങളിലും മിതത്വം പാലിക്കുക - <span class="badge bg-success text-white rounded-pill px-3 py-2">നിർബന്ധം</span>',
                    dikr: [],
                    quran: [],
                    hadith: [
                        '🕌 മുഹമ്മദ് നബി (സ) യുടെ പ്രാർത്ഥന ഞാൻ ശ്രദ്ധിച്ചു, അദ്ദേഹത്തിന്റെ ഖിയാം (നിൽക്കുന്നതും, കുമ്പിടുന്നതും, കുമ്പിട്ട ശേഷം നിൽക്കുന്ന നിലയിലേക്ക് മടങ്ങുന്നതും, സുജൂദ് ചെയ്യുന്നതും, രണ്ട് സുജൂദുകൾക്കിടയിലുള്ള ഇരിപ്പും, സലാമിനും യാത്രയ്ക്കും ഇടയിൽ സുജൂദ് ചെയ്യുന്നതും ഇരിക്കുന്നതും എല്ലാം ഏതാണ്ട് പരസ്പരം തുല്യമായിരുന്നു. <em class="small text-muted"> - മുസ്ലിം:1057</em>',
                    ]
                }],
                more: ''
            },
            {
                title: '10. അത്തഹിയ്യാത്ത് ഓതുക',
                icon: [
                    "{{ asset('img/namaz/sitting.jpg') }}",
                ],
                steps: [{
                        title: 'ഓരോ രണ്ട് റക്അത്തിന്റെയും അവസാനം അത്തഹിയ്യാത്ത് ഓതുക - <span class="badge bg-success text-white rounded-pill px-3 py-2">നിർബന്ധം</span>',
                        dikr: [{
                            title: '',
                            desc: '<p class="m-0 fw-bold text-center">അല്ലാഹു അക്ബർ</p>',
                        }],
                        quran: [],
                        hadith: [
                            '🕌 നബി (ﷺ) സുജൂദ് ചെയ്യുമ്പോഴും തല ഉയർത്തുമ്പോഴും അദ്ദേഹം തക്ബീർ ചൊല്ലുമായിരുന്നു. <em class="small text-muted"> - ബുഖാരി:789, മുസ്ലിം:868</em>',
                            '🕌 ഓരോ രണ്ട് റക്അത്തിന്റെയും അവസാനം അദ്ദേഹം തഹിയ്യാ ചൊല്ലി; ഇടതു കാൽ (നിലത്ത്) നിവർത്തി വലതു കാൽ ഉയർത്തുമായിരുന്നു; കുനിഞ്ഞ് ഇരിക്കുന്ന പിശാചിന്റെ രീതി അദ്ദേഹം വിലക്കി, കാട്ടുമൃഗത്തെപ്പോലെ കൈകൾ വിരിച്ചു നിർത്തുന്നത് അദ്ദേഹം വിലക്കി. <em class="small text-muted"> - മുസ്ലിം:1110, ബുഖാരി:828</em>'
                        ]
                    },
                    {
                        title: 'അത്തഹിയ്യാത്ത്',
                        dikr: [{
                            title: '',
                            desc: '<p class="m-0 text-ar fw-bold text-center mt-2 mb-2 lh-lg">التَّحِيَّاتُ الْمُبَارَكَاتُ، الصَّلَوَاتُ الطَّيِّبَاتُ لِلَّهِ، السَّلَامُ عَلَيْكَ أَيُّهَا النَّبِيُّ وَرَحْمَةُ اللهِ وَبَرَكَاتُهُ، السَّلَامُ عَلَيْنَا وَعَلَى عِبَادِ اللهِ الصَّالِحِينَ، أَشْهَدُ أَنْ لَا إِلَهَ إِلَّا اللهُ، وَأَشْهَدُ أَنَّ مُحَمَّدًا رَسُولُ اللهِ.</p>',
                        }],
                        quran: [],
                        hadith: [
                            '🕌 നബി (ﷺ) ഖുർആനിലെ ഒരു സൂറത്ത് പഠിപ്പിച്ചു തന്നതുപോലെ തശഹ്ഹുദ് പഠിപ്പിച്ചു തന്നു. <em class="small text-muted"> - മുസ്ലിം:897,902</em>',
                        ]
                    },
                    {
                        title: 'അത്തഹിയാത്തിലെ വിരൽ അനക്കൽ',
                        dikr: [],
                        quran: [],
                        hadith: [
                            '🕌 നബി (ﷺ) വലതു കൈത്തണ്ട വലതു തുടയിൽ വെച്ച് ചൂണ്ടുവിരൽ ഉയർത്തിപ്പിടിച്ച് അദ്ദേഹം പ്രാർത്ഥിക്കുകയായിരുന്നു. <em class="small text-muted"> - അന-നസാഈ:1275</em>',
                        ]
                    }
                ],
                more: ''
            },
            {
                title: '11. നബി (സ) യുടെ മേല്‍ സ്വലാത്ത് ചൊല്ലല്‍',
                icon: [
                    "{{ asset('img/namaz/last.jpg') }}",
                ],
                steps: [{
                        title: 'അത്തഹിയ്യാത്തിനു ശേഷം നബി (സ) യുടെ മേല്‍ സ്വലാത്ത് ചൊല്ലല്‍ - <span class="badge bg-success text-white rounded-pill px-3 py-2">നിർബന്ധം</span>',
                        dikr: [{
                            title: '',
                            desc: '<p class="m-0 text-ar fw-bold text-center mt-2 mb-2 lh-lg">اللهُمَّ صَلِّ عَلَى مُحَمَّدٍ وَعَلَى آلِ مُحَمَّدٍ، كَمَا صَلَّيْتَ عَلَى آلِ إِبْرَاهِيمَ وَبَارِكْ عَلَى مُحَمَّدٍ وَعَلَى آلِ مُحَمَّدٍ كَمَا بَارَكْتَ عَلَى آلِ إِبْرَاهِيمَ فِي الْعَالَمِينَ، إِنَّكَ حَمِيدٌ مَجِيدٌ</p>',
                        }],
                        quran: [],
                        hadith: [
                            '🕌 തശഹ്ഹുദിന് ശേഷം നബി (സ) യുടെ മേൽ സ്വലാത്ത് ചൊല്ലൽ <em class="small text-muted"> - മുസ്ലിം:907,908,911</em>',
                        ]
                    },
                    {
                        title: 'ദുആ - <span class="badge bg-primary text-white rounded-pill px-3 py-2">സുന്നത്ത്</span>',
                        dikr: [{
                            title: '<p class="m-0 text-ar fw-bold text-center mt-2 lh-lg">اللهُمَّ إِنِّي أَعُوذُ بِكَ مِنْ عَذَابِ الْقَبْرِ، وَمِنْ عَذَابِ النّار، وَمِنْ فِتْنَةِ الْمَحْيَا وَالْمَمَاتِ، وَمِنْ فِتْنَةِ الْمَسِيحِ الدَّجَّالِ.</p>',
                            desc: '<p class="fw-bold text-center m-0">OR</p><br><p class="m-0 text-ar fw-bold text-center lh-lg">اللَّهُمَّ اغْفِرْ لِي ذُنُوبِى مَا قَدَّمْتُ وَمَا أَخَّرْتُ، وَمَا أَسْرَرْتُ، وَمَا أَعْلَنْتُ، وَمَا أَسْرَفْتُ، وَمَا أَنْتَ أَعْلَمُ بِهِ مِنِّي.إنَّكَ أَنْتَ الْمُقَدِّمُ، وَأَنْتَ الْمُؤَخِّرُ لَا إِلهَ إِلَاَّ أَنْتَ. اللهُمَّ إِنِّي أَعُوذُ بِكَ مِنْ عَذَابِ الْقَبْرِ، وَمِنْ عَذَابِ النّار، وَمِنْ فِتْنَةِ الْمَحْيَا وَالْمَمَاتِ، وَمِنْ فِتْنَةِ الْمَسِيحِ الدَّجَّالِ.</p>',
                        }],
                        quran: [],
                        hadith: [
                            '🕌 (തശഹുദ് ഓതിയതിന് ശേഷം) അവന് ഏത് പ്രാർത്ഥനയും തിരഞ്ഞെടുക്കാം. <em class="small text-muted"> - മുസ്ലിം:898-900</em>',
                            '🕌 നബി (ﷺ) പറഞ്ഞു: നിങ്ങളിൽ ആരെങ്കിലും (നമസ്കാരത്തിൽ) തശഹ്ഹുദ് ചൊല്ലിയാൽ നാല് (പരീക്ഷകളിൽ) നിന്ന് അവൻ അല്ലാഹുവിനോട് അഭയം തേടട്ടെ. <em class="small text-muted"> - മുസ്ലിം:1023-1026</em>'
                        ]
                    }
                ],
                more: ''
            },
            {
                title: '12. അവസാന ഇരുത്തം (അത്തഹിയ്യാത്തിനും സ്വലാത്തിനും സലാമിനും വേണ്ടിയുള്ള ഇരുത്തം)',
                icon: [
                    "{{ asset('img/namaz/last.jpg') }}",
                ],
                steps: [{
                    title: 'അത്തഹിയ്യാത്തിനും സ്വലാത്തിനും സലാമിനും വേണ്ടിയുള്ള ഇരുത്തം - <span class="badge bg-success text-white rounded-pill px-3 py-2">നിർബന്ധം</span>',
                    dikr: [{
                        title: '',
                        desc: '<p class="m-0 fw-bold text-center">അല്ലാഹു അക്ബർ</p>',
                    }],
                    quran: [],
                    hadith: [
                        '🕌 നബി (ﷺ) സുജൂദ് ചെയ്യുമ്പോഴും തല ഉയർത്തുമ്പോഴും അദ്ദേഹം തക്ബീർ ചൊല്ലുമായിരുന്നു. <em class="small text-muted"> - ബുഖാരി:789, മുസ്ലിം:868</em>',
                        '🕌 അവസാന റക്അത്തിൽ അദ്ദേഹം ഇടതു കാൽ മുന്നോട്ട് തള്ളി മറ്റേ കാൽ ഉയർത്തി നിതംബത്തിന് മുകളിൽ ഇരുന്നു. <em class="small text-muted"> - ബുഖാരി:828</em>'
                    ]
                }],
                more: ''
            },
            {
                title: '13. സലാം ചൊല്ലല്‍',
                icon: [
                    "{{ asset('img/namaz/sl2.jpg') }}",
                    "{{ asset('img/namaz/sl1.jpg') }}",
                ],
                steps: [{
                    title: 'സലാം ചൊല്ലല്‍ - <span class="badge bg-success text-white rounded-pill px-3 py-2">നിർബന്ധം</span>',
                    dikr: [{
                        title: '',
                        desc: '<p class="m-0 text-ar fw-bold text-center mt-2 mb-2 lh-lg">السَّلَامُ عَلَيْكُمْ وَرَحْمَةُ اللَّهِ</p>',
                    }],
                    quran: [],
                    hadith: [
                        '🕌 പ്രവാചകൻ (ﷺ) തന്റെ ഇടതുവശത്തും വലതുവശത്തും കവിളിലെ വെളുത്ത നിറം കാണുന്നതുവരെ സലാം ചൊല്ലാറുണ്ടായിരുന്നു <em class="small text-muted"> - അബു ദാവൂദ്:996, മുസ്ലിം:1110</em>',
                    ]
                }],
                more: ''
            },
            {
                title: '14. തര്‍ത്തീബ് (ക്രമപാലനം)',
                icon: [],
                steps: [{
                    title: 'നമസ്കാരത്തിൽ ക്രമം പാലിക്കുക - <span class="badge bg-success text-white rounded-pill px-3 py-2">നിർബന്ധം</span>',
                    dikr: [],
                    quran: [
                        "📖 പ്രാര്‍ത്ഥന മുറപോലെ നിര്‍വഹിക്കുകയും, സകാത്ത് നല്‍കുകയും, (അല്ലാഹുവിന്റെമുമ്പില്‍) തലകുനിക്കുന്നവരോടൊപ്പം നിങ്ങള്‍ തലകുനിക്കുകയും ചെയ്യുവിന്‍. <em class='small text-muted'> - Quran 2:43 </em>",
                    ],
                    hadith: [
                        '🕌 നിസ്കാരത്തിന്റെ രൂപം <em class="small text-muted"> - അബു ദാവൂദ്:730</em>',
                    ]
                }],
                more: ''
            }
        ];

        const actionIcon = document.getElementById('actionIcon');
        const actionTitle = document.getElementById('actionTitle');
        const morePanel = document.getElementById('morePanel');
        const moreText = document.getElementById('moreText');
        const prevBtn = document.getElementById('prevBtn');
        const nextBtn = document.getElementById('nextBtn');
        const stepNum = document.getElementById('stepNum');
        const stepTotal = document.getElementById('stepTotal');
        const progressEl = document.getElementById('progress');
        const startBtn = document.getElementById('startBtn');
        const showMoreBtn = document.getElementById('showMoreBtn');
        const stepsPanel = document.getElementById('stepsPanel');

        let sequence = [];
        let currentIndex = 0;

        function renderStep() {
            const s = sequence[currentIndex];

            actionIcon.innerHTML = (Array.isArray(s.icon) ? s.icon : [s.icon])
                .map(i => `<img src="${i}" class="icon-img mb-3 ms-3" alt="step icon" />`)
                .join('');

            actionTitle.textContent = s.title;

            stepsPanel.innerHTML = (Array.isArray(s.steps) ? s.steps : [s.steps])
                .map((step, i) => `<div class="card border-warning shadow-sm p-2 mb-3">
                    <div class="text-center fw-bold m-0 text-emerald">${i + 1}. ${step.title}</div>
                    ${step.dikr.map(h => `<p class="m-0 fw-bold mt-2">${h.title}</p><div>${h.desc}</div>`).join('')}
                    ${step.quran.map(h => `<div class="ref-box ref-quran small mt-1">${h}</div>`).join('')}
                    ${step.hadith.map(h => `<div class="ref-box ref-hadith small mt-1">${h}</div>`).join('')}
                    </div>`)
                .join('');

            moreText.innerHTML = s.more || '';

            stepNum.textContent = currentIndex + 1;
            stepTotal.textContent = sequence.length;
            prevBtn.disabled = currentIndex === 0;
            nextBtn.textContent = currentIndex === sequence.length - 1 ? 'Finish' : 'Next →';
            progressEl.style.width = ((currentIndex + 1) / sequence.length * 100) + '%';
        }

        function nextStep() {
            if (currentIndex < sequence.length - 1) {
                currentIndex++;
                renderStep();
            } else {
                alert(`Alhamdulillah! You completed all.`);
            }

            window.scrollTo({
                top: 0,
                behavior: "smooth"
            });
        }

        function prevStep() {
            if (currentIndex > 0) {
                currentIndex--;
                renderStep();
            }

            window.scrollTo({
                top: 0,
                behavior: "smooth"
            });
        }

        function resetSequence() {
            sequence = baseSteps;
            currentIndex = 0;
            renderStep();
        }

        function init() {
            resetSequence();
        }

        if (startBtn) startBtn.addEventListener('click', () => {
            resetSequence();
        });
        nextBtn.addEventListener('click', nextStep);
        prevBtn.addEventListener('click', prevStep);
        showMoreBtn.addEventListener('click', () => {
            morePanel.classList.toggle('d-none');
            showMoreBtn.textContent = morePanel.classList.contains('d-none') ? 'ℹ️ More' : '🔽 Less';
        });

        init();
    </script>
@endpush
