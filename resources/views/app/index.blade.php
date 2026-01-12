@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <style>
        .about-section {
            text-align: center;
            line-height: 1.8;
        }

        .about-section h2 {
            color: #2c3e50;
            font-size: 2rem;
            margin-bottom: 20px;
            border-bottom: 3px solid var(--clr-gold);
            display: inline-block;
            padding-bottom: 10px;
        }

        .about-section p {
            color: #555;
            font-size: 1.1rem;
            margin-bottom: 25px;
            text-align: justify;
        }

        .source-box {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            border-left: 5px solid var(--clr-gold);
        }

        .source-box h4 {
            margin-top: 0;
            color: var(--clr-gold);
        }
    </style>

    <style>
        /* Hero Slider Container */
        .hero-slider-section {
            width: 100%;
            padding: 40px 0;
            background: var(--clr-dark);
        }

        /* Ensuring Equal Height for all slides */
        .swiper-slide {
            height: auto;
            display: flex;
        }

        .dua-card {
            background: linear-gradient(145deg, #1a1a1a, #000000);
            border: 2px solid var(--clr-gold);
            border-radius: 15px;
            padding: 40px;
            text-align: center;
            color: var(--clr-white);
            width: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            transition: transform 0.3s ease;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
        }

        .dua-arabic {
            font-size: 1.8rem;
            color: var(--clr-gold);
            margin-bottom: 20px;
            font-family: 'Amiri', serif;
            line-height: 1.6;
        }

        .dua-malayalam {
            font-size: 1.2rem;
            font-weight: 500;
            margin-bottom: 15px;
            line-height: 1.8;
        }

        .dua-reference {
            font-size: 0.9rem;
            color: var(--clr-gold);
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* Swiper Custom Navigation */
        .swiper-button-next,
        .swiper-button-prev {
            color: var(--clr-gold) !important;
        }

        .swiper-pagination-bullet {
            background: var(--clr-gold) !important;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .dua-arabic {
                font-size: 1.5rem;
            }

            .dua-card {
                padding: 25px;
            }
        }
    </style>

    <div class="container my-4 pb-5 notranslate">
        <section class="hero-slider-section">
            <div class="container">
                <div class="swiper mySwiper">
                    <div class="swiper-wrapper">

                        <div class="swiper-slide">
                            <div class="dua-card">
                                <div class="dua-arabic">رَبَّنَا آتِنَا فِي الدُّنْيَا حَسَنَةً وَفِي الآخِرَةِ حَسَنَةً
                                </div>
                                <div class="dua-malayalam">"ഞങ്ങളുടെ നാഥാ, ഞങ്ങൾക്ക് ദുനിയാവിലും ആഖിറത്തിലും നന്മ നൽകേണമേ."
                                </div>
                                <div class="dua-reference">അൽ-ബഖറ: 201</div>
                            </div>
                        </div>

                        <div class="swiper-slide">
                            <div class="dua-card">
                                <div class="dua-arabic">رَبِّ زِدْنِي عِلْمًا</div>
                                <div class="dua-malayalam">"എന്റെ നാഥാ, എനിക്ക് നീ അറിവ് വർദ്ധിപ്പിച്ചു തരേണമേ."</div>
                                <div class="dua-reference">സൂറത്ത് ത്വാഹാ: 114</div>
                            </div>
                        </div>

                        <div class="swiper-slide">
                            <div class="dua-card">
                                <div class="dua-arabic">يَا مُقَلِّبَ الْقُلُوبِ ثَبِّتْ قَلْبِي عَلَى دِينِكَ</div>
                                <div class="dua-malayalam">"ഹൃദയങ്ങളെ മാറ്റിമറിക്കുന്നവനേ, എന്റെ ഹൃദയത്തെ നിന്റെ ദീനിൽ
                                    ഉറപ്പിച്ചു നിർത്തേണമേ."</div>
                                <div class="dua-reference">തിർമിദി</div>
                            </div>
                        </div>

                    </div>

                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </section>

        <section class="about-section mt-4">
            <div class="container">
                <h2>ഞങ്ങളെക്കുറിച്ച്</h2>

                <p class="text-desc">
                    മനുഷ്യജീവിതത്തിന്റെ യഥാർത്ഥ ലക്ഷ്യം അല്ലാഹുവിനെ ആരാധിക്കുക (ഇബാദത്ത്) എന്നതാണ്. ഈ മഹത്തായ
                    ലക്ഷ്യത്തെക്കുറിച്ചും, ആരാധനകളുടെ ശരിയായ രീതികളെക്കുറിച്ചും കൃത്യമായ അറിവ് നൽകാനാണ് ഞങ്ങൾ
                    പരിശ്രമിക്കുന്നത്. വിശ്വാസികൾക്ക് തങ്ങളുടെ ജീവിതം അല്ലാഹുവിന്റെ പ്രീതിക്കനുസരിച്ച് ക്രമീകരിക്കാൻ
                    ആവശ്യമായ മാർഗ്ഗനിർദ്ദേശങ്ങൾ ഇവിടെ ലഭ്യമാണ്.
                </p>

                <div class="source-box mb-4">
                    <h4 class="text-black fw-bold">അടിസ്ഥാന പ്രമാണങ്ങൾ</h4>
                    <p class="text-desc">
                        പരിശുദ്ധമായ <b>ഖുർആനിന്റെ</b> അധ്യാപനങ്ങളും, പ്രവാചകൻ മുഹമ്മദ് നബി (സ്വ)യുടെ ചര്യകൾ വ്യക്തമാക്കുന്ന
                        <b>കുത്തുബുസ്സിത്ത</b> (സ്വഹീഹുൽ ബുഖാരി, സ്വഹീഹ് മുസ്‌ലിം, സുനാൻ അബു ദാവൂദ്, ജാമി അൽ-തിർമിധി, സുനാൻ
                        അന-നസാഈ, സുനാൻ ഇബ്നു മാജ) എന്നീ ആധികാരിക ഹദീസ് ഗ്രന്ഥങ്ങളും അടിസ്ഥാനമാക്കിയാണ് ആരാധനകളെക്കുറിച്ചുള്ള
                        വിശദീകരണങ്ങൾ ഞങ്ങൾ നൽകുന്നത്.
                    </p>

                    <h5 class="text-gold">പ്രധാന ഹദീസ് ഗ്രന്ഥങ്ങൾ (കുതുബുസ്സിത്ത)</h5>
                    <ul class="m-0" style="text-align: left">
                        <li><b>സ്വഹീഹ് ബുഖാരി:</b> ഇമാം ബുഖാരി ക്രോഡീകരിച്ചത്. ഏറ്റവും ആധികാരികമായ ഗ്രന്ഥം.</li>
                        <li>
                            <b>സ്വഹീഹ് മുസ്ലിം:</b> ഇമാം മുസ്ലിം ക്രോഡീകരിച്ചത്. ബുഖാരിക്കൊപ്പം തന്നെ പ്രാധാന്യമുള്ള
                            ഗ്രന്ഥമാണിത്. ഇവ രണ്ടിനെയും കൂടി 'സ്വഹീഹൈനി' എന്ന് വിളിക്കുന്നു.
                        </li>
                        <li><b>സുനൻ അബൂദാവൂദ്:</b> പ്രധാനമായും കർമ്മശാസ്ത്രപരമായ (Fiqh) ഹദീസുകൾക്ക് മുൻഗണന നൽകുന്നു.</li>
                        <li>
                            <b>ജാമിഅ് അൽ-തിർമിദി:</b> ഹദീസുകൾക്കൊപ്പം തന്നെ ഓരോ വിഷയത്തിലും പണ്ഡിതന്മാർക്കിടയിലുള്ള അഭിപ്രായ
                            വ്യത്യാസങ്ങളും ഇതിൽ രേഖപ്പെടുത്തിയിട്ടുണ്ട്.
                        </li>
                        <li>
                            <b>സുനൻ അൽ-നസാഈ:</b> ഹദീസുകളുടെ നിവേദകന്മാരെ പരിശോധിക്കുന്നതിൽ അതീവ ജാഗ്രത പുലർത്തിയ ഗ്രന്ഥം.
                        </li>
                        <li><b>സുനൻ ഇബ്നു മാജ:</b> ആറ് ഗ്രന്ഥങ്ങളിൽ അവസാനത്തേതായി ഇതിനെ കണക്കാക്കുന്നു.</li>
                    </ul>
                </div>

                <div class="source-box mb-4">
                    <h4 class="text-black fw-bold">മദ്ഹബുകളുടെ അടിസ്ഥാനം</h4>
                    <p class="text-desc">
                        മദ്ഹബുകളുടെ അടിസ്ഥാനം: നാല് മദ്ഹബുകളിലെ ഇമാമുകളും (ഇമാം അബൂഹനീഫ, ഇമാം മാലിക്, ഇമാം ശാഫിഈ, ഇമാം
                        അഹ്മദ് ബിൻ ഹൻബൽ) ഖുർആനിനെയും ഹദീസിനെയും അടിസ്ഥാനമാക്കിയാണ് അവരുടെ ഗ്രന്ഥങ്ങൾ രചിച്ചത്. <b>"എന്റെ
                            അഭിപ്രായത്തിന് വിരുദ്ധമായി സ്വഹീഹായ ഹദീസ് വന്നാൽ അതാണ് എന്റെ മദ്ഹബ്" എന്ന് ഇമാം ശാഫിഈ (റ)
                            പറഞ്ഞിട്ടുണ്ട്.</b> ഇതിനർത്ഥം മദ്ഹബ് ഗ്രന്ഥങ്ങളേക്കാൾ മുകളിലാണ് ഹദീസ് ഗ്രന്ഥങ്ങളുടെ സ്ഥാനം
                        എന്നാണ്.
                    </p>

                    <h5 class="text-gold">പ്രധാന ഗ്രന്ഥങ്ങൾ</h5>
                    <ul class="m-0" style="text-align: left">
                        <li><b>ഹനഫി മദ്ഹബ് (150H):</b> ഇമാം അബൂഹനീഫ. കിതാബുൽ ആഥാർ</li>
                        <li><b>മാലികി മദ്ഹബ് (179H):</b> ഇമാം മാലിക്. ഗ്രന്ഥം: അൽ-മുവത്വ (ആദ്യത്തെ പ്രധാന കൃതി)</li>
                        <li><b>ശാഫിഈ മദ്ഹബ് (204H):</b> ഇമാം ശാഫിഈ. ഗ്രന്ഥം: അൽ-ഉമ്മ്, അർരിസാല.</li>
                        <li><b>ഹംബലി മദ്ഹബ് (241H):</b> ഇമാം അഹ്മദ് ബിൻ ഹൻബൽ. ഗ്രന്ഥം: മുസ്നദ് അഹ്മദ്</li>
                    </ul>
                </div>
            </div>
        </section>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <script>
        var swiper = new Swiper(".mySwiper", {
            slidesPerView: 1,
            spaceBetween: 30,
            loop: true,
            autoplay: {
                delay: 4000,
                disableOnInteraction: false,
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            // Responsiveness
            breakpoints: {
                768: {
                    slidesPerView: 1,
                },
                1024: {
                    slidesPerView: 1,
                }
            }
        });
    </script>
    <script>
        const duas = [{
                title: "യാത്രയ്ക്കുള്ള ദുആ",
                arabic: "سُبْحَانَ الَّذِي سَخَّرَ لَنَا هَذَا وَمَا كُنَّا لَهُ مُقْرِنِينَ",
                translit: "Subhana allathee sakhkhara lana hadha wama kunna lahu muqrineen",
                translation: "നമുക്ക് നിയന്ത്രിക്കാൻ കഴിഞ്ഞില്ലെങ്കിലും ഇതിനെ നമ്മുടെ നിയന്ത്രണത്തിലാക്കിയവന് സ്തുതി."
            },
            {
                title: "ഉണരുമ്പോഴുള്ള ദുആ",
                arabic: "الحمدُ للهِ الذي أحيانا بعدما أمատنا وإليه النشور",
                translit: "Alhamdu lillahil-lathee ahyana ba’da ma amatana wa ilayhin-nushoor",
                translation: "നമ്മെ ജീവനിൽ നിന്ന് എടുത്തതിനു ശേഷം നമ്മെ ജീവിപ്പിച്ച അല്ലാഹുവിനാണ് സർവ്വ സ്തുതിയും. അവനിലേക്കാണ് ഉയിർത്തെഴുന്നേൽപ്പ്."
            },
            {
                title: "ഭക്ഷണം കഴിക്കുന്നതിന് മുമ്പുള്ള ദുആ",
                arabic: "بِسْمِ اللهِ وَعَلَى بَرَكَةِ اللهِ",
                translit: "Bismillahi wa ‘ala barakatillah",
                translation: "അല്ലാഹുവിന്റെ നാമത്തിൽ, അല്ലാഹുവിന്റെ അനുഗ്രഹത്താൽ ഞാൻ ആരംഭിക്കുന്നു."
            }
        ];
    </script>
@endsection
