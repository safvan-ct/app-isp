@extends('layouts.app')

@section('content')
    <style>
        .carousel-control-next,
        .carousel-control-prev {
            width: 5% !important;
        }
    </style>

    {{-- <div class="app-header text-center notranslate">
        <h5 class="mb-1 text-dark fw-bold">സ്വാഗതം 👋</h5>
        <h4 class="fw-bold">
            <span class="text-dark">ഇസ്ലാമിക്</span>
            <span class="text-yl-900">സ്റ്റഡി പോർട്ടൽ</span>
        </h4>
    </div> --}}

    <div class="container my-4 pb-5 notranslate">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

        <style>
            :root {
                --clr-dark: #1e2222;
                --clr-gold: #c5a059;
            }

            .dua-swiper {
                padding: 20px 0 50px;
            }

            .dua-card {
                background: var(--clr-dark);
                border: 1px solid var(--clr-gold);
                border-radius: 15px;
                min-height: 300px;
                display: flex;
                flex-direction: column;
                justify-content: center;
                transition: transform 0.3s ease;
            }

            .text-ar {
                font-family: 'Amiri', serif;
                /* Recommended for Arabic */
                color: var(--clr-gold);
                font-size: 1.8rem;
            }

            .title-box {
                border-bottom: 1px dashed rgba(197, 160, 89, 0.3);
                color: var(--clr-gold);
            }

            .swiper-pagination-bullet-active {
                background: var(--clr-gold) !important;
            }

            .swiper-button-next,
            .swiper-button-prev {
                color: var(--clr-gold);
            }
        </style>

        <div class="container mt-4">
            <div class="swiper dua-swiper">
                <div class="swiper-wrapper" id="duaSlides">
                </div>

                <div class="swiper-pagination"></div>
                <div class="swiper-button-next d-none d-md-flex"></div>
                <div class="swiper-button-prev d-none d-md-flex"></div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>


        {{-- <div class="row g-2">
            <div class="col-lg-7">
                <div class="base-card mb-4 bg-geometry p-4">
                    <div class="text-center mx-auto">
                        <h4 class="mb-3 text-black" style="text-shadow: 0 2px 6px rgba(0, 0, 0, 0.35);">
                            {{ __('app.seek_knowledge') }}</h4>

                        <div class="ayah-box mb-2 text-dark">
                            <h5 class="text-ar">
                                <span class="mt-2">﴿ وَقُل رَّبِّ زِدْنِي عِلْمًا ﴾</span>
                                <em class="text-muted small"> - 20:114</em>
                            </h5>
                        </div>

                        <p class="text-muted mb-0 small">
                            Quran, Hadith and subjects — organized for focused, distraction-free learning.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-lg-5">
                <div id="duaCarousel" class="carousel slide d-flex justify-content-center align-items-center"
                    data-bs-ride="false" data-bs-interval="false">
                    <div class="carousel-inner" id="duaSlides"></div>

                    <!-- Controls -->
                    <button class="carousel-control-prev" type="button" data-bs-target="#duaCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon"></span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#duaCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon"></span>
                    </button>
                </div>
            </div>
        </div> --}}

        <!-- Featured Courses -->
        <h3 class="m-0 text-dark text-center mt-4 mb-2">🌿 അറിവ് തേടൂ, വിശ്വാസം വളർത്തൂ</h3>
        <x-app.hr />

        <div class="row g-2 mb-4">
            @foreach (exploreTopics() as $key => $item)
                <div class="col-6 col-md-3">
                    <x-app.topic-card :title="$item" :url="route('questions.show', ['menu_slug' => 'topic', 'module_slug' => $key])" />
                </div>
            @endforeach
        </div>

        {{-- <x-app.hr /> --}}
        <div class="base-card accent p-3 d-none">
            <h3 class="text-center fw-bold mb-2 text-dark">✨ ദുആയുടെ ശക്തി</h3>
            <p class="text-center mb-0">
                “തീർച്ചയായും അല്ലാഹുവിനെക്കുറിച്ചുള്ള സ്മരണ കൊണ്ടാകുന്നു ഹൃദയങ്ങൾ ശാന്തമാകുന്നത്.” (Qur'an 13:28)
            </p>
        </div>

        <h5 class="mb-3 mt-4 d-none">{{ __('app.explore_by_topics') }}</h5>
        <div class="d-flex gap-2 flex-wrap d-none">
            <span class="badge bg-primary-subtle text-primary rounded-pill px-3 py-2">Development</span>
            <span class="badge bg-success-subtle text-success rounded-pill px-3 py-2">Design</span>
            <span class="badge bg-warning-subtle text-warning rounded-pill px-3 py-2">Business</span>
            <span class="badge bg-danger-subtle text-danger rounded-pill px-3 py-2">Languages</span>
        </div>
    </div>

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

        function renderSlides() {
            const duaSlides = document.getElementById("duaSlides");
            duaSlides.innerHTML = duas.map(dua => `
        <div class="swiper-slide">
            <div class="dua-card p-4 shadow-lg text-center">
                <div class="title-box mb-3 pb-2">
                    <h5 class="fw-bold m-0 text-white">${dua.title}</h5>
                </div>
                <h2 class="text-ar mb-3 lh-lg" dir="rtl">${dua.arabic}</h2>
                <p class="text-muted small fst-italic mb-2">${dua.translit}</p>
                <p class="text-white-50 m-0">${dua.translation}</p>
            </div>
        </div>
    `).join('');

            // Initialize Swiper after rendering
            const swiper = new Swiper('.dua-swiper', {
                loop: true,
                spaceBetween: 30,
                grabCursor: true,
                autoplay: {
                    delay: 5000,
                    disableOnInteraction: false,
                },
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                breakpoints: {
                    // Show 1 slide on mobile, 2 on tablets, 3 on desktop
                    320: {
                        slidesPerView: 1
                    },
                    768: {
                        slidesPerView: 1
                    },
                    1024: {
                        slidesPerView: 1
                    }
                }
            });
        }

        document.addEventListener("DOMContentLoaded", renderSlides);
    </script>
@endsection
