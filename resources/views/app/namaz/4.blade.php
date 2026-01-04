@extends('layouts.app')

@section('content')
    <x-app.topbar :title="$questions['title']" :url="route('questions.show', ['menu_slug' => 'topics', 'module_slug' => $questions['slug']])" />

    <div class="container my-2 pb-5">
        <x-app.banner :title="$questions['chapters'][$questionSlug]" :desc="'നിസ്കാരത്തിന്റെ ഫർളുകൾ (നിർബന്ധിത കാര്യങ്ങൾ)'" :search="false" :author="'Author Name'" :review="date('M d, Y') . ' by Reviewer Name'" />

        <div class="row mt-4 notranslate" id="startPanel">
            <div class="col-12 col-lg-8">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <select class="form-select mb-3" id="stepSelect"></select>
                </div>

                <div class="row g-4 align-items-center mb-4">
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
            </div>

            <div class="col-12 col-lg-4 mb-4">
                <x-app.related-topics :data="$questions['chapters']" :current="$questionSlug" :menu_slug="'topics'" :module_slug="$questions['slug']" />
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        const baseSteps = [{
                title: '1. നിയ്യത്ത് ഉണ്ടായിരിക്കണം.',
                icon: "{{ asset('img/namaz/st.jpg') }}",
                steps: [{
                        title: 'നിയ്യത്ത് (ഹൃദയത്തിലെ ഉറച്ച ഉദ്ദേശം) ഉണ്ടായിരിക്കണം - <span class="badge bg-success text-white rounded-pill ms-2">നിർബന്ധം</span>',
                        dikr: [{
                                title: "നിയ്യത്ത് ചുരുങ്ങിയ രൂപം: <i>(നിസ്കാരത്തിന്റെ പേര്)</i> എന്ന ഫർള് ഞാൻ നിസ്കരിക്കുന്നു",
                                desc: "<span class='text-yl-900'>ഉദാ: <span class='fw-bold'>ളുഹർ</span> എന്ന ഫർള് ഞാൻ നിസ്കരിക്കുന്നു.</span>"
                            },
                            {
                                title: "നിയ്യത്ത് പൂർണ്ണ രൂപം: <i>(നിസ്കാരത്തിന്റെ പേര്)</i> എന്ന <i>(ഫർള്/സുന്നത്ത്)</i> നിസ്കാരം <i>(റകഅതുകളുടെ എണ്ണം)</i> റക്അത്ത് ഖിബ്ലക്ക് മുന്നിട്ട് <i>(അദാആയി/ഖളാആയി)</i> അല്ലാഹുവിന് വേണ്ടി ഞാൻ <i>(ജമാഅത്തായി(ഒറ്റക്ക് അല്ലെങ്കിൽ))</i> നിസ്കരിക്കുന്നു.",
                                desc: "<span class='text-yl-900'>ഉദാ: <span class='fw-bold'>ളുഹർ</span> എന്ന <span class='fw-bold'>ഫർള്</span> നിസ്കാരം <span class='fw-bold'>നാല്</span> റക്അത്ത് ഖിബ്ലക്ക് മുന്നിട്ട് <span class='fw-bold'>അദാആയി</span> അല്ലാഹുവിന് വേണ്ടി ഞാൻ നിസ്കരിക്കുന്നു.</span>"
                            }
                        ],
                        quran: [{
                                slug: 23,
                                number: 2
                            },
                            {
                                slug: 2,
                                number: 238
                            }
                        ],
                        hadith: [{
                                slug: 'sahih-bukhari',
                                number: 1,
                                name: 'ബുഖാരി'
                            },
                            {
                                slug: 'sahih-muslim',
                                number: 4927,
                                name: 'മുസ്ലിം'
                            }
                        ],
                        hadith_title: "ഒരു പ്രവൃത്തിയുടെ മൂല്യം അതിന്റെ പിന്നിലെ ഉദ്ദേശ്യത്തെ ആശ്രയിച്ചിരിക്കുന്നു."
                    },
                    {
                        title: 'നമസ്കരിക്കുന്നതിന് മുമ്പില്‍ ഒരു മറ സ്വീകരിക്കല്‍',
                        dikr: [],
                        quran: [],
                        hadith: [{
                                slug: 'sahih-bukhari',
                                number: 494,
                                name: 'ബുഖാരി'
                            },
                            {
                                slug: 'abu-dawood',
                                number: 695,
                                name: 'അബൂദാവൂദ്'
                            }
                        ]
                    },
                    {
                        title: 'സുജൂദിന്റെ സ്ഥാനത്തേക്ക് നോക്കല്‍.',
                        dikr: [],
                        quran: [],
                        hadith: [{
                                slug: 'sahih-bukhari',
                                number: 750,
                                name: 'ബുഖാരി'
                            },
                            {
                                slug: 'sahih-bukhari',
                                number: 751,
                                name: 'ബുഖാരി'
                            }
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
                    title: 'നമസ്‌കാരത്തിന്റെ ആരംഭത്തിലുള്ള തക്ബീറതുൽ ഇഹ്‌റാം - <span class="badge bg-success text-white rounded-pill">നിർബന്ധം</span>',
                    dikr: [{
                        title: "‘അല്ലാഹു അക്ബർ’ എന്ന വചനമാണത്. കൈകൾ തോളുകൾക്ക് നേരെ ഉയർത്തുകയും തക്ബീർ ചൊല്ലുകയും ചെയ്യുക.",
                        desc: ''
                    }],
                    quran: [],
                    hadith: [{
                            slug: 'sahih-bukhari',
                            number: 735,
                            name: 'ബുഖാരി'
                        },
                        {
                            slug: 'sahih-bukhari',
                            number: 738,
                            name: 'ബുഖാരി'
                        },
                        {
                            slug: 'sahih-bukhari',
                            number: 739,
                            name: 'ബുഖാരി'
                        },
                        {
                            slug: 'sahih-bukhari',
                            number: 788,
                            name: 'ബുഖാരി'
                        },
                        {
                            slug: 'sahih-bukhari',
                            number: 789,
                            name: 'ബുഖാരി'
                        },
                        {
                            slug: 'sahih-bukhari',
                            number: 828,
                            name: 'ബുഖാരി'
                        },
                        {
                            slug: 'sahih-muslim',
                            number: 861,
                            name: 'മുസ്ലിം'
                        },
                        {
                            slug: 'sahih-muslim',
                            number: 862,
                            name: 'മുസ്ലിം'
                        },
                        {
                            slug: 'sahih-muslim',
                            number: 868,
                            name: 'മുസ്ലിം'
                        },
                        {
                            slug: 'sahih-muslim',
                            number: 886,
                            name: 'മുസ്ലിം'
                        },
                        {
                            slug: 'abu-dawood',
                            number: 61,
                            name: 'അബു ദാവൂദ്'
                        }
                    ],
                }],
                more: '',
            },
            {
                title: '3. നിൽക്കാൻ കഴിവുള്ളവൻ നിൽക്കൽ',
                icon: [
                    "{{ asset('img/namaz/qiyam.png') }}",
                ],
                steps: [{
                        title: 'നിൽക്കാൻ കഴിവുള്ളവൻ നിൽക്കൽ - <span class="badge bg-success text-white rounded-pill">നിർബന്ധം</span>',
                        dikr: [{
                            title: "രോഗം, പേടി പോലുള്ള ഒഴിവുകഴിവുകളുണ്ടായാൽ നിർബന്ധനമസ്‌കാരങ്ങളിൽ നിൽക്കുന്നത് ഒഴിവാക്കുവാൻ ഒരാൾക്ക് ഇളവുണ്ട്.",
                            desc: ''
                        }],
                        quran: [{
                            slug: 2,
                            number: 238
                        }],
                        hadith: [{
                            slug: 'sahih-bukhari',
                            number: 1117,
                            name: 'ബുഖാരി'
                        }],
                        quran_title: 'അല്ലാഹുവിന്റെ മുമ്പില്‍ ഭയഭക്തിയോടു കൂടി നിന്നുകൊണ്ടാകണം നിങ്ങള്‍ പ്രാര്‍ത്ഥിക്കുന്നത്‌',
                        hadith_title: 'നിന്നുകൊണ്ട് നമസ്കരിക്കുക, നിങ്ങൾക്ക് കഴിയില്ലെങ്കിൽ ഇരുന്നുകൊണ്ട് നമസ്കരിക്കുക, നിങ്ങൾക്ക് അതിനും കഴിയില്ലെങ്കിൽ, നിങ്ങളുടെ വശം ചെരിഞ്ഞ് കിടന്ന് നമസ്കരിക്കുക.',
                    },
                    {
                        title: 'വലതു കൈ ഇടതു കൈയ്ക്കു മുകളിൽ വയ്ക്കുക - <span class="badge bg-primary text-white rounded-pill">സുന്നത്ത്</span>',
                        dikr: [],
                        quran: [],
                        hadith: [{
                            slug: 'sahih-muslim',
                            number: 896,
                            name: 'മുസ്ലിം'
                        }],
                        hadith_title: 'നബി (ﷺ) വലതു കൈ ഇടതു കൈക്ക് മുകളിൽ വച്ചു.',
                    },
                    {
                        title: 'തക്ബീറിനും ഖുർആൻ പാരായണത്തിനും ഇടയിൽ - <span class="badge bg-primary text-white rounded-pill">സുന്നത്ത്</span>',
                        dikr: [{
                                title: "തക്ബീറത്തുല്‍ ഇഹ്റാമില്‍ പ്രവേശിച്ചു കഴിഞ്ഞാല്‍ വിവിധങ്ങളായ ധാരാളം പ്രാ൪ത്ഥനകള്‍ കൊണ്ട് നബി(സ്വ) പാരായണം ആരംഭിക്കുമായിരുന്നു.",
                                desc: '<p class="m-0 text-ar lh-lg mb-2 mt-2" dir="rtl">اللَّهُمَّ بَاعِدْ بَيْنِي وَبَيْنَ خَطَايَاىَ كَمَا بَاعَدْتَ بَيْنَ الْمَشْرِقِ وَالْمَغْرِبِ، اللَّهُمَّ نَقِّنِي مِنَ الْخَطَايَا كَمَا يُنَقَّى الثَّوْبُ الأَبْيَضُ مِنَ الدَّنَسِ، اللَّهُمَّ اغْسِلْ خَطَايَاىَ بِالْمَاءِ وَالثَّلْجِ وَالْبَرَدِ</p>',
                            },
                            {
                                title: "<p class='m-0 text-center'>OR</p>",
                                desc: '<p class="m-0 text-ar lh-lg" dir="rtl">وَجَّهْتُ وَجْهِيَ لِلَّذِي فَطَرَ السَّمَاوَاتِ وَالْأَرْضَ حَنِيفًا وَمَا أَنَا مِنْ الْمُشْرِكِينَ إِنَّ صَلَاتِي وَنُسُكِي وَمَحْيَايَ وَمَمَاتِي لِلَّهِ رَبِّ الْعَالَمِينَ لَا شَرِيكَ لَهُ وَبِذَلِكَ أُمِرْتُ وَأَنَا مِنْ الْمُسْلِمِينَ<p>',
                            }
                        ],
                        quran: [],
                        hadith: [{
                            slug: 'sahih-bukhari',
                            number: 744,
                            name: 'ബുഖാരി'
                        }, {
                            slug: 'sahih-muslim',
                            number: 1354,
                            name: 'മുസ്ലിം'
                        }, {
                            slug: 'sahih-muslim',
                            number: 1812,
                            name: 'മുസ്ലിം'
                        }, {
                            slug: 'sahih-muslim',
                            number: 1813,
                            name: 'മുസ്ലിം'
                        }]
                    }
                ],
                more: '',
            },
            {
                title: '4. എല്ലാ റക്അത്തിലും ഫാത്തിഹ ഓതല്‍(ഇമാമും മഅ്മൂമും)',
                icon: "{{ asset('img/namaz/qiyam.png') }}",
                steps: [{
                        title: 'ഓരോ റകഅത്തിലും ഫാത്തിഹ ഓതണം - <span class="badge bg-success text-white rounded-pill">നിർബന്ധം</span>',
                        dikr: [],
                        quran: [{
                            slug: 15,
                            number: 87
                        }],
                        hadith: [{
                                slug: 'sahih-bukhari',
                                number: 756,
                                name: 'ബുഖാരി'
                            },
                            {
                                slug: 'sahih-muslim',
                                number: 875,
                                name: 'മുസ്ലിം'
                            },
                            {
                                slug: 'sahih-muslim',
                                number: 878,
                                name: 'മുസ്ലിം'
                            },
                            {
                                slug: 'sahih-muslim',
                                number: 883,
                                name: 'മുസ്ലിം'
                            },
                            {
                                slug: 'sahih-muslim',
                                number: 884,
                                name: 'മുസ്ലിം'
                            }
                        ],
                        hadith_title: "ആരെങ്കിലും തന്റെ നമസ്കാരത്തിൽ ഫാത്തിഹ ഓതുന്നില്ലെങ്കിൽ അവന്റെ നമസ്കാരം നിഷ്ഫലമാണ്.",
                    },
                    {
                        title: 'പ്രാരംഭ പ്രാ൪ത്ഥനകള്‍ക്ക് ശേഷം നബി(സ്വ) അല്ലാഹുവിനോട് രക്ഷ തേടിക്കൊണ്ട് ഇപ്രകാരവും പറയുമായിരുന്നു.',
                        dikr: [{
                            title: "",
                            desc: '<p class="m-0 fw-bold text-ar">أَعـوذُ بِاللهِ مِنَ الشَّيْـطانِ الرَّجيـم</p>',
                        }],
                        quran: [],
                        hadith: []
                    },
                    {
                        title: 'ഫാതിഹയിൽ ബിസ്മി ഉച്ചത്തിൽ ചൊല്ലൽ & ഫാതിഹക്ക് ശേഷം ആമീൻ പറയൽ',
                        dikr: [],
                        quran: [],
                        hadith: [{
                            slug: 'sahih-muslim',
                            number: 890,
                            name: 'മുസ്ലിം'
                        }, {
                            slug: 'sahih-muslim',
                            number: 892,
                            name: 'മുസ്ലിം'
                        }, {
                            slug: 'sunan-nasai',
                            number: 907,
                            name: 'അന-നസാഈ'
                        }],
                        hadith_title: "ഞാൻ നബി (ﷺ), അബൂബക്കർ, ഉമർ, ഉസ്മാൻ (റ) എന്നിവർക്കൊപ്പവും പ്രാർത്ഥന നിരീക്ഷിച്ചു, എന്നാൽ അവരാരും ബിസ്മി... ചൊല്ലുന്നത് ഞാൻ കേട്ടിട്ടില്ല.",
                    },
                    {
                        title: 'ഫാത്തിഹയുടെ അവസാനത്തില്‍ ആമീന്‍ ചൊല്ലല്‍',
                        dikr: [{
                            title: "ആമീൻ എന്നാൽ അല്ലാഹുവേ നീ ഉത്തരം നൽകണേ എന്ന പ്രാർത്ഥനയാണ്.",
                            desc: "ജമാഅത്ത് നമസ്കാരത്തിൽ ഇമാം ഫാതിഹ ഓതിക്കഴിഞ്ഞാൽ ഇമാമും മഅ്മൂമും പതുക്കെ ആമീൻ പറയുന്നത് നബിചര്യക്ക് എതിരാണ്."
                        }],
                        quran: [],
                        hadith: [{
                            slug: 'sahih-bukhari',
                            number: 780,
                            name: 'ബുഖാരി'
                        }, {
                            slug: 'sahih-muslim',
                            number: 904,
                            name: 'മുസ്ലിം'
                        }, {
                            slug: 'sahih-muslim',
                            number: 915,
                            name: 'മുസ്ലിം'
                        }, {
                            slug: 'sahih-muslim',
                            number: 917,
                            name: 'മുസ്ലിം'
                        }, {
                            slug: 'sahih-muslim',
                            number: 920,
                            name: 'മുസ്ലിം'
                        }],
                        hadith_title: "നിങ്ങളിൽ ആരെങ്കിലും നിങ്ങളുടെ ഇമാമായി പ്രവർത്തിക്കട്ടെ. അവൻ ഓതുമ്പോൾ: {غَيْرِ الْمَغْضُوبِ عَلَيْهِمْ وَلَا الضَّالِّينَ}, ആമീൻ എന്ന് പറയുക."
                    },
                    {
                        title: 'ആദ്യത്തെ രണ്ട് റകഅത്തുകളിൽ ഫാതിഹക്ക് ശേഷം സൂറത് ഓതൽ - <span class="badge bg-primary text-white rounded-pill">സുന്നത്ത്</span>',
                        dikr: [{
                            title: "ജമാഅത്തിൽ ചെറിയ സൂറത് ഓതൽ - <span class='badge bg-primary text-white rounded-pill'>സുന്നത്ത്</span>",
                            desc: 'ഇമാമിന്റെ പിന്നിൽ നമസ്കരിക്കുന്നവർ ഫാതിഹ മാത്രം ഓതിയാൽ മതി. (ഇമാം ഓതുന്ന സൂറത്ത് ശ്രദ്ധിച്ചു കേൾക്കുകയാണവർ ചെയ്യേണ്ടത്.) [അബൂദാവൂദ്]<p class="m-0 mt-2">സുബ്ഹി, മഗ്രിബ്, ഇശാഅ് നമസ്കാരങ്ങളില്‍ ഉറക്കെ ഓതല്‍, ളുഹ്൪, അസ്൪ നമസ്കാരങ്ങളില്‍ പതുക്കെ ഓതല്‍</p>'
                        }],
                        quran: [{
                            slug: 73,
                            number: 20,
                        }],
                        quran_title: 'ആകയാല്‍ നിങ്ങള്‍ ഖുര്‍ആനില്‍ നിന്ന് സൌകര്യപ്പെട്ടത് ഓതിക്കൊണ്ട് നമസ്കരിക്കുക.',
                        hadith: [{
                                slug: 'sahih-bukhari',
                                number: 759,
                                name: 'ബുഖാരി'
                            },
                            {
                                slug: 'sahih-bukhari',
                                number: 761,
                                name: 'ബുഖാരി'
                            },
                            {
                                slug: 'sahih-bukhari',
                                number: 763,
                                name: 'ബുഖാരി'
                            },
                            {
                                slug: 'sahih-muslim',
                                number: 1012,
                                name: 'മുസ്ലിം'
                            },
                            {
                                slug: 'sahih-muslim',
                                number: 1013,
                                name: 'മുസ്ലിം'
                            },
                            {
                                slug: 'sahih-muslim',
                                number: 1014,
                                name: 'മുസ്ലിം'
                            },
                            {
                                slug: 'sahih-muslim',
                                number: 1015,
                                name: 'മുസ്ലിം'
                            },
                            {
                                slug: 'sahih-muslim',
                                number: 1044,
                                name: 'മുസ്ലിം'
                            },
                            {
                                slug: 'sahih-muslim',
                                number: 1046,
                                name: 'മുസ്ലിം'
                            }
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
                        title: 'റുകൂഅ് - <span class="badge bg-success text-white rounded-pill">നിർബന്ധം</span>',
                        dikr: [{
                            title: '',
                            desc: "കൈകൾ തോളുകൾക്ക് നേരെ ഉയർത്തുകയും തക്ബീർ ചൊല്ലുകയും ചെയ്യുക. രണ്ട് ഉള്ളന്‍ കൈകള്‍ വിരലുകള്‍ വിട൪ത്തി മുട്ടുകാലില്‍ പിടിക്കുക. റുകൂഇല്‍ മുതുക് വളവില്ലാതെ നേരെ വെക്കല്‍, മുതുകിന് നേരെ തല വരേണ്ടതുണ്ട്. റുകൂഇല്‍ കൈകള്‍ വശങ്ങളിൽ നിന്ന് അകറ്റി പിടിക്കല്‍."
                        }],
                        quran: [{
                            slug: 22,
                            number: 77,
                        }],
                        hadith: [{
                                slug: 'sahih-bukhari',
                                number: 735,
                                name: 'ബുഖാരി'
                            },
                            {
                                slug: 'sahih-bukhari',
                                number: 789,
                                name: 'ബുഖാരി'
                            },
                            {
                                slug: 'sahih-bukhari',
                                number: 757,
                                name: 'ബുഖാരി'
                            },
                            {
                                slug: 'sahih-bukhari',
                                number: 828,
                                name: 'ബുഖാരി'
                            },
                            {
                                slug: 'sahih-muslim',
                                number: 868,
                                name: 'മുസ്ലിം'
                            },
                            {
                                slug: 'sahih-muslim',
                                number: 861,
                                name: 'മുസ്ലിം'
                            },
                            {
                                slug: 'sahih-muslim',
                                number: 862,
                                name: 'മുസ്ലിം'
                            },
                            {
                                slug: 'al-tirmidhi',
                                number: 260,
                                name: 'തി൪മിദി'
                            },
                            {
                                slug: 'abu-dawood',
                                number: 859,
                                name: 'അബൂദാവൂദ് '
                            },
                            {
                                slug: 'ibn-e-majah',
                                number: 872,
                                name: 'ഇബ്നുമാജ '
                            }
                        ]
                    },
                    {
                        title: 'റുകൂഇലെ ദിക്ർ',
                        dikr: [{
                            title: 'നബി (ﷺ) കുമ്പിട്ടപ്പോൾ പറഞ്ഞു: {سُبْحَانَ رَبِّيَ الْعَظِيمِ وَبِحَمْدِهِ} മൂന്ന് തവണ.',
                            desc: '<p class="m-0 text-ar fw-bold text-center mt-2 mb-2"> سُبْحَانَ رَبِّيَ الْعَظِيمِ وَبِحَمْدِهِ / سُبْحَانَ رَبِّيَ الْعَظِيمِ</p>',
                        }],
                        quran: [],
                        hadith: [{
                                slug: 'sahih-muslim',
                                number: 1074,
                                name: 'മുസ്ലിം'
                            },
                            // {
                            //     slug: 'sahih-muslim',
                            //     number: 1086,
                            //     name: 'മുസ്ലിം'
                            // },
                            {
                                slug: 'al-tirmidhi',
                                number: 262,
                                name: 'തിർമിധി'
                            },
                            {
                                slug: 'abu-dawood',
                                number: 869,
                                name: 'അബു ദാവൂദ്'
                            },
                            {
                                slug: 'abu-dawood',
                                number: 870,
                                name: 'അബു ദാവൂദ്'
                            },
                            {
                                slug: 'abu-dawood',
                                number: 871,
                                name: 'അബു ദാവൂദ്'
                            },
                            {
                                slug: 'abu-dawood',
                                number: 874,
                                name: 'അബു ദാവൂദ്'
                            },
                            {
                                slug: 'ibn-e-majah',
                                number: 888,
                                name: 'ഇബ്നുമാജ'
                            }
                        ]
                    },
                    {
                        title: "<span class='text-danger'>റുകൂഇൽ ഖുർആൻ പാരായണം ചെയ്യാൻ പാടില്ല.</span>",
                        dikr: [],
                        quran: [],
                        hadith: [{
                                slug: 'sahih-muslim',
                                number: 1076,
                                name: 'മുസ്ലിം'
                            },
                            {
                                slug: 'sahih-muslim',
                                number: 1077,
                                name: 'മുസ്ലിം'
                            },
                            {
                                slug: 'sahih-muslim',
                                number: 1080,
                                name: 'മുസ്ലിം'
                            },
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
                        title: 'ഇഅ്തിദാല്‍ - <span class="badge bg-success text-white rounded-pill">നിർബന്ധം</span>',
                        dikr: [{
                            title: 'കൈകൾ തോളുകൾക്ക് നേരെ ഉയർത്തുകയും {سَمِعَ اللَّهُ لَمِنْ حَمِدَهُ} ചൊല്ലുകയും ചെയ്യുക.',
                            desc: '<p class="m-0 text-ar fw-bold text-center mt-2 mb-2">سَمِعَ اللَّهُ لَمِنْ حَمِدَهُ‏.</p>',
                        }],
                        quran: [],
                        hadith: [{
                                slug: 'sahih-bukhari',
                                number: 735,
                                name: 'ബുഖാരി'
                            },
                            {
                                slug: 'sahih-bukhari',
                                number: 757,
                                name: 'ബുഖാരി'
                            },
                            {
                                slug: 'sahih-bukhari',
                                number: 789,
                                name: 'ബുഖാരി'
                            },
                            {
                                slug: 'sahih-muslim',
                                number: 868,
                                name: 'മുസ്ലിം'
                            },
                            {
                                slug: 'sahih-muslim',
                                number: 861,
                                name: 'മുസ്ലിം'
                            },
                            {
                                slug: 'sahih-muslim',
                                number: 862,
                                name: 'മുസ്ലിം'
                            }
                        ]
                    },
                    {
                        title: 'ഇഅ്തിദാല്‍ലെ ദിക്ർ',
                        dikr: [{
                            title: '',
                            desc: '<p class="m-0 text-ar fw-bold text-center mt-2 mb-2 lh-lg"> رَبَّنَا وَلَكَ الْحَمْدُ / رَبَّنَا لَكَ الْحَمْدُ مِلْءَ السَّمَوَاتِ وَالأَرْضِ وَمِلْءَ مَا شِئْتَ مِنْ شَىْءٍ بَعْدُ.</p>',
                        }],
                        quran: [],
                        hadith: [{
                                slug: 'sahih-bukhari',
                                number: 789,
                                name: 'ബുഖാരി'
                            },
                            {
                                slug: 'sahih-muslim',
                                number: 868,
                                name: 'മുസ്ലിം'
                            },
                            {
                                slug: 'sahih-muslim',
                                number: 913,
                                name: 'മുസ്ലിം'
                            },
                            {
                                slug: 'sahih-muslim',
                                number: 1068,
                                name: 'മുസ്ലിം'
                            },
                            // {
                            //     slug: 'sahih-muslim',
                            //     number: 1069,
                            //     name: 'മുസ്ലിം'
                            // },
                            {
                                slug: 'sahih-muslim',
                                number: 1071,
                                name: 'മുസ്ലിം'
                            },
                            {
                                slug: 'sahih-muslim',
                                number: 1072,
                                name: 'മുസ്ലിം'
                            }
                        ],
                    },
                    {
                        title: "ഖുനൂത്ത്",
                        dikr: [{
                            title: 'ദുരന്തസമയത്ത് നബി (ﷺ) ഒരു മാസം ഫജ്ർ നമസ്കാരത്തിൽ ഖുനൂത്ത് പാരായണം ചെയ്തു. ശാഫിഈ, മാലികി പണ്ഡിതന്മാർ അതിനെ സ്ഥിരം ആക്കി, ഹനഫി, ഹൻബലി പണ്ഡിതന്മാർ അത് ദുരന്തസമയങ്ങളിൽ മാത്രം എന്ന് പറഞ്ഞു.',
                            desc: '<p class="m-0 text-ar fw-bold mt-2 mb-2 lh-lg">اللَّهُمَّ اهْدِنِي فِيمَنْ هَدَيْتَ، ‏‏‏‏‏‏وَعَافِنِي فِيمَنْ عَافَيْتَ، ‏‏‏‏‏‏وَتَوَلَّنِي فِيمَنْ تَوَلَّيْتَ، ‏‏‏‏‏‏وَبَارِكْ لِي فِيمَا أَعْطَيْتَ، ‏‏‏‏‏‏وَقِنِي شَرَّ مَا قَضَيْتَ إِنَّكَ تَقْضِي وَلَا يُقْضَى عَلَيْكَ، ‏‏‏‏‏‏وَإِنَّهُ لَا يَذِلُّ مَنْ وَالَيْتَ، ‏‏‏‏‏‏وَلَا يَعِزُّ مَنْ عَادَيْتَ، ‏‏‏‏‏‏تَبَارَكْتَ رَبَّنَا وَتَعَالَيْتَ</p>',
                        }],
                        quran: [],
                        hadith: [{
                                slug: 'sahih-bukhari',
                                number: 1001,
                                name: 'ബുഖാരി'
                            }, {
                                slug: 'sahih-bukhari',
                                number: 1002,
                                name: 'ബുഖാരി'
                            },
                            {
                                slug: 'sahih-bukhari',
                                number: 1003,
                                name: 'ബുഖാരി'
                            },
                            {
                                slug: 'abu-dawood',
                                number: 1425,
                                name: 'അബു ദാവൂദ്'
                            },
                            {
                                slug: 'al-tirmidhi',
                                number: 464,
                                name: 'തിർമിധി'
                            }
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
                        title: 'സുജൂദ് - <span class="badge bg-success text-white rounded-pill">നിർബന്ധം</span>',
                        dikr: [{
                            title: '<p class="m-0 fw-bold text-center">സുജൂദിലോട്ട് പോവുമ്പോൾ കൈകൾ തോളുകൾക്ക് നേരെ ഉയർത്തേണ്ടതില്ല, തക്ബീർ ചൊല്ലുക. </p>',
                            desc: 'കാല്‍മുട്ടുകള്‍ക്ക് മുമ്പായി കൈകള്‍ നിലത്തു വെക്കേണ്ടതാണ്. സുജൂദില്‍ ഏഴ് അവയവങ്ങള്‍ (കൈകൾ, കാൽമുട്ടുകൾ, പാദങ്ങളുടെയും നെറ്റിയുടെയും (അറ്റങ്ങൾ) ഇവയാണ്) നിലത്ത് പതിച്ച് വെക്കണം, സുജൂദില്‍ കൈകള്‍ ഇരുപാ൪ശ്വങ്ങളില്‍ നിന്ന് അകറ്റി വെക്കല്ണം. സുജൂദില്‍ കൈ വിരലുകളും കാല്‍ വിരലുകളും ഖിബ്ലക്ക് നേരെ വെക്കണം.',
                        }],
                        quran: [{
                            slug: 22,
                            number: 77,
                        }],
                        hadith: [{
                                slug: 'sahih-bukhari',
                                number: 735,
                                name: 'ബുഖാരി'
                            },
                            {
                                slug: 'sahih-bukhari',
                                number: 739,
                                name: 'ബുഖാരി'
                            },
                            {
                                slug: 'sahih-bukhari',
                                number: 789,
                                name: 'ബുഖാരി'
                            },
                            {
                                slug: 'sahih-bukhari',
                                number: 757,
                                name: 'ബുഖാരി'
                            },
                            {
                                slug: 'sahih-bukhari',
                                number: 807,
                                name: 'ബുഖാരി'
                            },
                            {
                                slug: 'sahih-bukhari',
                                number: 822,
                                name: 'ബുഖാരി'
                            },
                            {
                                slug: 'sahih-bukhari',
                                number: 828,
                                name: 'ബുഖാരി'
                            },
                            {
                                slug: 'sahih-muslim',
                                number: 861,
                                name: 'മുസ്ലിം'
                            },
                            {
                                slug: 'sahih-muslim',
                                number: 862,
                                name: 'മുസ്ലിം'
                            },
                            {
                                slug: 'sahih-muslim',
                                number: 868,
                                name: 'മുസ്ലിം'
                            },
                            {
                                slug: 'sahih-muslim',
                                number: 1090,
                                name: 'മുസ്ലിം'
                            },
                            {
                                slug: 'sahih-muslim',
                                number: 1095,
                                name: 'മുസ്ലിം'
                            },
                            {
                                slug: 'sahih-muslim',
                                number: 1102,
                                name: 'മുസ്ലിം'
                            },
                            {
                                slug: 'sahih-muslim',
                                number: 1103,
                                name: 'മുസ്ലിം'
                            },
                            {
                                slug: 'sahih-muslim',
                                number: 1105,
                                name: 'മുസ്ലിം'
                            },
                            {
                                slug: 'sahih-muslim',
                                number: 1106,
                                name: 'മുസ്ലിം'
                            },
                            {
                                slug: 'sahih-muslim',
                                number: 1107,
                                name: 'മുസ്ലിം'
                            },
                            {
                                slug: 'al-tirmidhi',
                                number: 271,
                                name: 'തി൪മിദി'
                            },
                            // {
                            //     slug: 'abu-dawood',
                            //     number: 838,
                            //     name: 'അബു ദാവൂദ്'
                            // },
                            {
                                slug: 'abu-dawood',
                                number: 732,
                                name: 'അബു ദാവൂദ്'
                            },
                            {
                                slug: 'abu-dawood',
                                number: 734,
                                name: 'അബു ദാവൂദ്'
                            },
                            {
                                slug: 'abu-dawood',
                                number: 735,
                                name: 'അബു ദാവൂദ്'
                            },
                            {
                                slug: 'abu-dawood',
                                number: 840,
                                name: 'അബു ദാവൂദ്'
                            }
                        ]
                    },
                    {
                        title: 'സുജൂദിലെ ദിക്ർ',
                        dikr: [{
                            title: '',
                            desc: '<p class="m-0 text-ar fw-bold text-center mt-2 mb-2 lh-lg">سُبْحَانَ رَبِّيَ الْأَعْلَى / سُبْحَانَ رَبِّيَ الْأَعْلَى وَبِحَمْدِهِ</p>',
                        }],
                        quran: [],
                        hadith: [{
                                slug: 'sahih-muslim',
                                number: 1085,
                                name: 'മുസ്ലിം'
                            },
                            {
                                slug: 'al-tirmidhi',
                                number: 262,
                                name: 'തിർമിധി'
                            },
                            {
                                slug: 'abu-dawood',
                                number: 869,
                                name: 'അബു ദാവൂദ്'
                            },
                            {
                                slug: 'abu-dawood',
                                number: 870,
                                name: 'അബു ദാവൂദ്'
                            },
                            {
                                slug: 'abu-dawood',
                                number: 871,
                                name: 'അബു ദാവൂദ്'
                            },
                            {
                                slug: 'ibn-e-majah',
                                number: 888,
                                name: 'ഇബ്നുമാജ'
                            }
                        ]
                    },
                    {
                        title: "<span class='text-danger'>ഖുർആൻ പാരായണം ചെയ്യാൻ പാടില്ല.</span>",
                        dikr: [],
                        quran: [],
                        hadith: [{
                                slug: 'sahih-muslim',
                                number: 1074,
                                name: 'മുസ്ലിം'
                            },
                            {
                                slug: 'sahih-muslim',
                                number: 1076,
                                name: 'മുസ്ലിം'
                            },
                            {
                                slug: 'sahih-muslim',
                                number: 1077,
                                name: 'മുസ്ലിം'
                            },
                            {
                                slug: 'sahih-muslim',
                                number: 1080,
                                name: 'മുസ്ലിം'
                            },
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
                        title: 'രണ്ട് സുജൂദുകള്‍ക്കിടയില്‍ അല്‍പനേരം ഇരിക്കുക - <span class="badge bg-success text-white rounded-pill">നിർബന്ധം</span>',
                        dikr: [{
                            desc: 'ഇടതു കാൽക്കൽ ഇരുന്നു വലതു കാൽ ഉയർത്തി. ഇരുത്തത്തില്‍ വലത് കൈപ്പത്തി വലത് കാലിന്റെ മുട്ടിലോ തുടയിലോ വെക്കലും ഇടത് കൈപ്പത്തി ഇടത് കാലിന്റെ മുട്ടിലോ തുടയിലോ വെക്കലും. രണ്ടാമത്തെ സുജൂദിന് ശേ‍ഷം അടുത്ത റക്അത്തിലേക്ക് പോകുന്നതിന് മുമ്പ് ഇസ്തിറാഹത്തിന്റെ (വിശ്രമത്തിന്റെ) ഇരുത്തം ഇരിക്കുക. ഭൂമിയില്‍ കൈകള്‍ അവലംബിച്ച് അടുത്ത റക്അത്തിലേക്ക് എഴുന്നേല്‍ക്കല്‍.',
                            title: '<p class="m-0 fw-bold text-center">സുജൂദിന്റെ ഇടയിലെ ഇരുത്തത്തില്‍ കൈകൾ തോളുകൾക്ക് നേരെ ഉയർത്തേണ്ടതില്ല, തക്ബീർ ചൊല്ലുക.</p>',
                        }],
                        quran: [],
                        hadith: [{
                                slug: 'sahih-bukhari',
                                number: 735,
                                name: 'ബുഖാരി'
                            },
                            {
                                slug: 'sahih-bukhari',
                                number: 757,
                                name: 'ബുഖാരി'
                            },
                            {
                                slug: 'sahih-bukhari',
                                number: 789,
                                name: 'ബുഖാരി'
                            },
                            {
                                slug: 'sahih-bukhari',
                                number: 757,
                                name: 'ബുഖാരി'
                            },
                            {
                                slug: 'sahih-bukhari',
                                number: 823,
                                name: 'ബുഖാരി'
                            },
                            {
                                slug: 'sahih-bukhari',
                                number: 824,
                                name: 'ബുഖാരി'
                            },
                            {
                                slug: 'sahih-bukhari',
                                number: 828,
                                name: 'ബുഖാരി'
                            },
                            {
                                slug: 'sahih-muslim',
                                number: 861,
                                name: 'മുസ്ലിം'
                            },
                            {
                                slug: 'sahih-muslim',
                                number: 862,
                                name: 'മുസ്ലിം'
                            },
                            {
                                slug: 'sahih-muslim',
                                number: 868,
                                name: 'മുസ്ലിം'
                            },
                            {
                                slug: 'sahih-muslim',
                                number: 1110,
                                name: 'മുസ്ലിം'
                            },
                            {
                                slug: 'sahih-muslim',
                                number: 1308,
                                name: 'മുസ്ലിം'
                            },
                            {
                                slug: 'sahih-muslim',
                                number: 1309,
                                name: 'മുസ്ലിം'
                            },
                            {
                                slug: 'abu-dawood',
                                number: 874,
                                name: 'അബൂദാവൂദ്'
                            },
                            {
                                slug: 'sunan-nasai',
                                number: 1269,
                                name: 'നസാഇ'
                            }
                        ]
                    },
                    {
                        title: 'രണ്ട് സുജൂദുകള്‍ക്കിടയിലെ ദിക്ർ',
                        dikr: [{
                            title: '',
                            desc: '<p class="m-0 text-ar fw-bold text-center mt-2 mb-2 lh-lg">رَبِّ اغْفِرْ لِي / رَبِّ اغْفِرْ لِي وَارْحَمْنِي وَاجْبُرْنِي وَاهْدِنِي وَارْزُقْنِي</p>',
                        }],
                        quran: [],
                        hadith: [{
                                slug: 'abu-dawood',
                                number: 874,
                                name: 'അബു ദാവൂദ്'
                            },
                            {
                                slug: 'abu-dawood',
                                number: 850,
                                name: 'അബു ദാവൂദ്'
                            },
                            {
                                slug: 'al-tirmidhi',
                                number: 284,
                                name: 'തിർമിധി'
                            },
                            {
                                slug: 'ibn-e-majah',
                                number: 898,
                                name: 'ഇബ്നുമാജ'
                            }
                        ]
                    }
                ],
                more: ''
            },
            {
                title: '9. ഥുമഅ്‌നീനത്ത് (അടങ്ങിപ്പാര്‍ക്കല്‍)',
                icon: [],
                steps: [{
                    title: 'അടങ്ങിപ്പാർക്കലാണ് ഥുമഅ്‌നീനത്ത്. ഓരോ റുക്‌നിലും നിർബന്ധമായും ചൊല്ലേണ്ട ദിക്‌റിന്റെ തോതനുസരിച്ചാണ് അടക്കവും ഒതുക്കവും വേണ്ടത്.  - <span class="badge bg-success text-white rounded-pill">നിർബന്ധം</span>',
                    dikr: [],
                    quran: [],
                    hadith: [{
                            slug: 'sahih-bukhari',
                            number: 757,
                            name: 'ബുഖാരി'
                        },
                        {
                            slug: 'sahih-bukhari',
                            number: 792,
                            name: 'ബുഖാരി'
                        },
                        {
                            slug: 'sahih-muslim',
                            number: 1057,
                            name: 'മുസ്ലിം'
                        },
                        {
                            slug: 'abu-dawood',
                            number: 855,
                            name: 'അബൂദാവൂദ്'
                        }
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
                        title: 'ഓരോ രണ്ട് റക്അത്തിന്റെയും അവസാനം അത്തഹിയ്യാത്ത് ഓതുക - <span class="badge bg-success text-white rounded-pill">നിർബന്ധം</span>',
                        dikr: [{
                            title: '',
                            desc: 'ഇടതു കാൽക്കൽ ഇരുന്നു വലതു കാൽ ഉയർത്തി. ഇരുത്തത്തില്‍ വലത് കൈയിലെ ചെറുവിരലും മോതിര വിരലും ചുരുട്ടി പിടിക്കുക. നടുവിരലും തള്ളവിരവും വൃത്താകൃതി വരുംവിധം മുട്ടിച്ച് പിടിക്കുക. ചൂണ്ടുവിരല്‍ കൊണ്ട് ഖിബ്ലയുടെ ഭാഗത്തേക്ക് ചൂണ്ടുകയും ദുആഇന്റേയും ദിക്റിന്റേയും സന്ദ൪ഭത്തില്‍ അത് ഇളക്കികൊണ്ടിരിക്കുകയും ചെയ്യുക. ഭൂമിയില്‍ കൈകള്‍ അവലംബിച്ച് അടുത്ത റക്അത്തിലേക്ക് എഴുന്നേല്‍ക്കല്‍.',
                        }],
                        quran: [],
                        hadith: [{
                                slug: 'sahih-bukhari',
                                number: 787,
                                name: 'ബുഖാരി'
                            },
                            {
                                slug: 'sahih-bukhari',
                                number: 828,
                                name: 'ബുഖാരി'
                            },
                            {
                                slug: 'sahih-bukhari',
                                number: 789,
                                name: 'ബുഖാരി'
                            },
                            {
                                slug: 'sahih-muslim',
                                number: 1110,
                                name: 'മുസ്ലിം'
                            },
                            {
                                slug: 'sahih-muslim',
                                number: 1308,
                                name: 'മുസ്ലിം'
                            },
                            {
                                slug: 'sahih-muslim',
                                number: 1309,
                                name: 'മുസ്ലിം'
                            },
                            {
                                slug: 'sunan-nasai',
                                number: 889,
                                name: 'നസാഇ'
                            },
                            {
                                slug: 'sunan-nasai',
                                number: 1269,
                                name: 'നസാഇ'
                            },
                            {
                                slug: 'sunan-nasai',
                                number: 1275,
                                name: 'നസാഇ'
                            },
                            {
                                slug: 'ibn-e-majah',
                                number: 912,
                                name: 'ഇബ്നുമാജ'
                            },
                        ]
                    },
                    {
                        title: 'അത്തഹിയ്യാത്ത്',
                        dikr: [{
                            title: '',
                            desc: '<p class="m-0 text-ar fw-bold text-center mt-2 mb-2 lh-lg">التَّحِيَّاتُ الْمُبَارَكَاتُ، الصَّلَوَاتُ الطَّيِّبَاتُ لِلَّهِ، السَّلَامُ عَلَيْكَ أَيُّهَا النَّبِيُّ وَرَحْمَةُ اللهِ وَبَرَكَاتُهُ، السَّلَامُ عَلَيْنَا وَعَلَى عِبَادِ اللهِ الصَّالِحِينَ، أَشْهَدُ أَنْ لَا إِلَهَ إِلَّا اللهُ، وَأَشْهَدُ أَنَّ مُحَمَّدًا رَسُولُ اللهِ.</p>',
                        }],
                        quran: [],
                        hadith: [{
                                slug: 'sahih-muslim',
                                number: 897,
                                name: 'മുസ്ലിം'
                            },
                            {
                                slug: 'sahih-muslim',
                                number: 902,
                                name: 'മുസ്ലിം'
                            },
                            {
                                slug: 'sunan-nasai',
                                number: 1163,
                                name: 'നസാഇ'
                            }
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
                        title: 'അത്തഹിയ്യാത്തിനു ശേഷം നബി (സ) യുടെ മേല്‍ സ്വലാത്ത് ചൊല്ലല്‍ - <span class="badge bg-success text-white rounded-pill">നിർബന്ധം</span>',
                        dikr: [{
                            title: '',
                            desc: '<p class="m-0 text-ar fw-bold text-center mt-2 mb-2 lh-lg">اللهُمَّ صَلِّ عَلَى مُحَمَّدٍ وَعَلَى آلِ مُحَمَّدٍ، كَمَا صَلَّيْتَ عَلَى آلِ إِبْرَاهِيمَ وَبَارِكْ عَلَى مُحَمَّدٍ وَعَلَى آلِ مُحَمَّدٍ كَمَا بَارَكْتَ عَلَى آلِ إِبْرَاهِيمَ فِي الْعَالَمِينَ، إِنَّكَ حَمِيدٌ مَجِيدٌ</p>',
                        }],
                        quran: [],
                        hadith: [{
                                slug: 'sahih-bukhari',
                                number: 3370,
                                name: 'ബുഖാരി'
                            },
                            {
                                slug: 'sahih-muslim',
                                number: 907,
                                name: 'മുസ്ലിം'
                            },
                            {
                                slug: 'sahih-muslim',
                                number: 908,
                                name: 'മുസ്ലിം'
                            },
                            {
                                slug: 'sahih-muslim',
                                number: 911,
                                name: 'മുസ്ലിം'
                            }
                        ]
                    },
                    {
                        title: 'ദുആ - <span class="badge bg-primary text-white rounded-pill">സുന്നത്ത്</span>',
                        dikr: [{
                            title: '<p class="m-0 text-ar fw-bold text-center mt-2 lh-lg">اللهُمَّ إِنِّي أَعُوذُ بِكَ مِنْ عَذَابِ الْقَبْرِ، وَمِنْ عَذَابِ النّار، وَمِنْ فِتْنَةِ الْمَحْيَا وَالْمَمَاتِ، وَمِنْ فِتْنَةِ الْمَسِيحِ الدَّجَّالِ.</p>',
                            desc: '<p class="fw-bold text-center m-0">OR</p><br><p class="m-0 text-ar fw-bold text-center lh-lg">اللَّهُمَّ اغْفِرْ لِي ذُنُوبِى مَا قَدَّمْتُ وَمَا أَخَّرْتُ، وَمَا أَسْرَرْتُ، وَمَا أَعْلَنْتُ، وَمَا أَسْرَفْتُ، وَمَا أَنْتَ أَعْلَمُ بِهِ مِنِّي.إنَّكَ أَنْتَ الْمُقَدِّمُ، وَأَنْتَ الْمُؤَخِّرُ لَا إِلهَ إِلَاَّ أَنْتَ. اللهُمَّ إِنِّي أَعُوذُ بِكَ مِنْ عَذَابِ الْقَبْرِ، وَمِنْ عَذَابِ النّار، وَمِنْ فِتْنَةِ الْمَحْيَا وَالْمَمَاتِ، وَمِنْ فِتْنَةِ الْمَسِيحِ الدَّجَّالِ.</p>',
                        }],
                        quran: [],
                        hadith: [{
                                slug: 'sahih-bukhari',
                                number: 1377,
                                name: 'ബുഖാരി'
                            },
                            {
                                slug: 'sahih-muslim',
                                number: 898,
                                name: 'മുസ്ലിം'
                            },
                            // {
                            //     slug: 'sahih-muslim',
                            //     number: 899,
                            //     name: 'മുസ്ലിം'
                            // },
                            // {
                            //     slug: 'sahih-muslim',
                            //     number: 900,
                            //     name: 'മുസ്ലിം'
                            // },
                            {
                                slug: 'sahih-muslim',
                                number: 1324,
                                name: 'മുസ്ലിം'
                            },
                            {
                                slug: 'sahih-muslim',
                                number: 1325,
                                name: 'മുസ്ലിം'
                            },
                            {
                                slug: 'sahih-muslim',
                                number: 1326,
                                name: 'മുസ്ലിം'
                            },
                            {
                                slug: 'sahih-muslim',
                                number: 1328,
                                name: 'മുസ്ലിം'
                            }
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
                    title: 'അത്തഹിയ്യാത്തിനും സ്വലാത്തിനും സലാമിനും വേണ്ടിയുള്ള ഇരുത്തം - <span class="badge bg-success text-white rounded-pill">നിർബന്ധം</span>',
                    dikr: [{
                        desc: 'അവസാന റക്അത്തിൽ അദ്ദേഹം ഇടതു കാൽ മുന്നോട്ട് തള്ളി മറ്റേ കാൽ ഉയർത്തി നിതംബത്തിന് മുകളിൽ ഇരുന്നു.',
                        title: '<p class="m-0 fw-bold text-center">ഇരുത്തത്തില്‍ കൈകൾ തോളുകൾക്ക് നേരെ ഉയർത്തേണ്ടതില്ല, തക്ബീർ ചൊല്ലുക.</p>',
                    }],
                    quran: [],
                    hadith: [{
                            slug: 'sahih-bukhari',
                            number: 789,
                            name: 'ബുഖാരി'
                        },
                        {
                            slug: 'sahih-bukhari',
                            number: 828,
                            name: 'ബുഖാരി'
                        },
                        {
                            slug: 'sahih-muslim',
                            number: 868,
                            name: 'മുസ്ലിം'
                        },
                        {
                            slug: 'abu-dawood',
                            number: 730,
                            name: 'അബൂദാവൂദ്'
                        },
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
                    title: 'സലാം ചൊല്ലല്‍ - <span class="badge bg-success text-white rounded-pill">നിർബന്ധം</span>',
                    dikr: [{
                        desc: 'ഇടതുവശത്തും വലതുവശത്തും കവിളിലെ വെളുത്ത നിറം കാണുന്നതുവരെ സലാം ചൊല്ലാറുണ്ടായിരുന്നു.',
                        title: '<p class="m-0 text-ar fw-bold text-center mt-2 lh-lg">السَّلَامُ عَلَيْكُمْ وَرَحْمَةُ اللَّهِ</p>',
                    }],
                    quran: [],
                    hadith: [{
                            slug: 'sahih-muslim',
                            number: 1110,
                            name: 'മുസ്ലിം',
                        },
                        {
                            slug: 'sahih-muslim',
                            number: 1315,
                            name: 'മുസ്ലിം',
                        },
                        {
                            slug: 'abu-dawood',
                            number: 61,
                            name: 'അബൂദാവൂദ്',
                        },
                        {
                            slug: 'abu-dawood',
                            number: 996,
                            name: 'അബൂദാവൂദ്',
                        }
                    ]
                }],
                more: ''
            },
            {
                title: '14. തര്‍ത്തീബ് (ക്രമപാലനം)',
                icon: [],
                steps: [{
                        title: 'നമസ്കാരത്തിൽ ക്രമം പാലിക്കുക - <span class="badge bg-success text-white rounded-pill">നിർബന്ധം</span>',
                        dikr: [{
                            title: '',
                            desc: 'പ്രാര്‍ത്ഥന മുറപോലെ നിര്‍വഹിക്കുക',
                        }],
                        quran: [{
                            slug: 2,
                            number: 43,
                        }],
                        hadith: [{
                            slug: 'abu-dawood',
                            number: 730,
                            name: 'അബൂദാവൂദ്'
                        }],
                        hadith_title: 'നിസ്കാരത്തിന്റെ രൂപം'
                    },
                    {
                        title: 'നമസ്കാരത്തിന് 8 വാജിവുകളാണുള്ളത്.',
                        dikr: [{
                            title: 'നമസ്കാരത്തിന്റെ വാജിവുകളില്‍ ഏതെങ്കിലും മനപ്പൂ൪വം ഉപേക്ഷിച്ചാല്‍ നമസ്കാരം ബാത്വിലാകും. മറവിമൂലം വിട്ടുപോയതാണെങ്കില്‍ ആ വാജിബ് നി൪വ്വഹിക്കേണ്ട സ്ഥലം വിട്ടുപോകുന്നതിനുമുമ്പ് അതിലേക്ക് മടങ്ങിച്ചെന്ന് അത് നി൪വ്വഹിക്കുക. സ്ഥലം വിട്ടുപോയാല്‍ അതിലേക്ക് മടങ്ങേണ്ടതില്ല. മറിച്ച് സലാം വീട്ടുന്നതിനുമുമ്പായി സഹ്’വിന്റെ (മറവിയുടെ) സുജൂദ് ചെയ്യുക.',
                            desc: '1.തക്ബീറുകള്‍ (തക്ബീറത്തുല്‍ ഇഹ്റാം ഒഴികെ), 2.റുകൂഇല്‍ سُبْحَانَ رَبِّيَ الْعَظِيمِ എന്ന് പറയല്‍, 3.سَمِعَ اللَّهُ لِمَنْ حَمِدَهُ എന്ന് പറയല്‍, 4. رَبَّنَا وَلَكَ الْحَمْدُ എന്ന് പറയല്‍, 5. സജൂദില്‍ سُبْحَانَ رَبِّيَ الأَعْلَى എന്ന് പറയല്‍, 6. രണ്ട് സുജൂദുകള്‍ക്കിടയിലെ ഇരുത്തത്തിലെ പ്രാ൪ത്ഥന, 7.ഒന്നാമത്തെ തശഹ്ഹുദ്, 8.ഒന്നാമത്തെ തശഹ്ഹുദിന് വേണ്ടി ഇരിക്കല്‍',
                        }],
                        quran: [],
                        hadith: [{
                                slug: 'sahih-bukhari',
                                number: 1224,
                                name: 'ബുഖാരി'
                            },
                            {
                                slug: 'sahih-bukhari',
                                number: 1231,
                                name: 'ബുഖാരി'
                            },
                            {
                                slug: 'sahih-muslim',
                                number: 1265,
                                name: 'മുസ്ലിം'
                            },
                            {
                                slug: 'sahih-muslim',
                                number: 1267,
                                name: 'മുസ്ലിം'
                            },
                            {
                                slug: 'sahih-muslim',
                                number: 1269,
                                name: 'മുസ്ലിം'
                            }
                        ]
                    },
                    {
                        title: 'ആർക്കെങ്കിലും ഒരു നമസ്കാരത്തിൽ നിന്ന് (യഥാസമയം) ഒരു റക്അത്ത് നമസ്കരിക്കാൻ കഴിഞ്ഞാൽ, അവൻ നമസ്കാരം നേടി.',
                        dikr: [],
                        quran: [],
                        hadith: [{
                            slug: 'sahih-bukhari',
                            number: 580,
                            name: 'ബുഖാരി'
                        }]
                    }
                ],
                more: ''
            }
        ];

        const stepSelect = document.getElementById('stepSelect');
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
                        <div class="text-center fw-bold m-0 text-dark mb-2">${i + 1}. ${step.title}</div>

                        ${step.dikr.map(h => `<p class="m-0 fw-bold">${h.title}</p><div class="mb-2">${h.desc}</div>`).join('')}

                        ${step.quran.length ? `<x-app.quran-box text="${step.quran_title ? step.quran_title : 'ഖുർആൻ വിശകലനങ്ങൾ'}" class="mb-1"> ${step.quran.map(h => ` <x-app.ref-button class="mb-1" slug="${h.slug}" number="${h.number}" type="quran" :ref="__('app.quran') . ' ${h.slug}:${h.number}'" />`).join('')} </x-app.quran-box>` : ''}

                        ${step.hadith.length ? `<x-app.hadith-box text="${step.hadith_title ? step.hadith_title : 'ഹദീസ് വിശകലനങ്ങൾ'}" class="mb-1"> ${step.hadith.map(h => ` <x-app.ref-button class="mb-1" slug="${h.slug}" number="${h.number}" type="hadith" :ref="'${h.name}:${h.number}'" />`).join('')} </x-app.hadith-box>` : ''}
                    </div>`)
                .join('');

            moreText.innerHTML = s.more || '';

            stepNum.textContent = currentIndex + 1;
            stepTotal.textContent = sequence.length;
            prevBtn.disabled = currentIndex === 0;
            nextBtn.textContent = currentIndex === sequence.length - 1 ? 'Finish' : 'Next →';
            progressEl.style.width = ((currentIndex + 1) / sequence.length * 100) + '%';

            stepSelect.value = currentIndex;
        }

        function toDiv() {
            const element = document.getElementById("startPanel");
            const yOffset = -70;
            const y = element.getBoundingClientRect().top + window.pageYOffset + yOffset;

            window.scrollTo({
                top: y,
                behavior: "smooth"
            });
        }

        function nextStep() {
            if (currentIndex < sequence.length - 1) {
                currentIndex++;
                renderStep();
            } else {
                alert(`Alhamdulillah! You completed all.`);
            }

            toDiv();
        }

        function prevStep() {
            if (currentIndex > 0) {
                currentIndex--;
                renderStep();
            }

            toDiv();
        }

        function resetSequence() {
            sequence = baseSteps;
            currentIndex = 0;
            renderStep();
        }

        function init() {
            resetSequence();
            populateStepSelect();
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

        function populateStepSelect() {
            stepSelect.innerHTML = baseSteps.map((s, i) =>
                `<option value="${i}">${s.title}</option>`
            ).join('');
        }

        // Jump to step when selecting from dropdown
        stepSelect.addEventListener('change', () => {
            currentIndex = parseInt(stepSelect.value, 10);
            renderStep();
            toDiv();
        });
    </script>
@endpush
