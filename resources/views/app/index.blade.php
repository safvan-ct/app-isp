@extends('layouts.app')

@section('content')
    <style>
        .carousel-control-next,
        .carousel-control-prev {
            width: 5% !important;
        }
    </style>

    @php
        $topics = [
            'namaz' => 'നിസ്കാരം',
            'meelad' => 'നബിദിനം',
        ];
    @endphp

    <x-app.topbar>
        <x-slot:title>
            <img src="{{ asset('img/apple-touch-icon.png') }}"class="me-2 rounded-circle shadow-sm"
                style="height:30px; width:30px;">
            <span class="text-ar fw-bold">{{ __('app.islamic_study_portal') }}</span>
        </x-slot:title>
    </x-app.topbar>

    <div class="app-header">
        <h5 class="mb-1 text-dark fw-bold">സ്വാഗതം 👋</h5>
        <h4 class="fw-bold">
            <span class="text-emerald">ഇസ്ലാമിക്</span>
            <span class="text-accent">സ്റ്റഡി പോർട്ടൽ</span>
        </h4>
    </div>

    <div class="container my-4 pb-5">
        <div class="base-card mb-4 bg-geometry">
            <div class="text-center mx-auto">
                <h4 class="mb-3 text-emerald-900" style="text-shadow: 0 2px 6px rgba(0, 0, 0, 0.35);">
                    {{ __('app.seek_knowledge') }}</h4>

                <div class="ayah-box mb-2 text-emerald">
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

        <h2 class="text-center text-emerald">🌿 ദൈനംദിന ദുആ</h2>
        <hr class="my-2" style="border: none; border-top: 2px solid #166534; opacity: 1;">
        <div id="duaCarousel" class="carousel slide d-flex justify-content-center align-items-center" data-bs-ride="false"
            data-bs-interval="false">
            <div class="carousel-inner" id="duaSlides"></div>

            <!-- Controls -->
            <button class="carousel-control-prev" type="button" data-bs-target="#duaCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#duaCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
            </button>
        </div>

        <!-- Featured Courses -->
        <h2 class="m-0 text-emerald text-center mt-4">{{ __('app.foundational_subjects') }}</h2>
        <p class="text-center m-0">📖 അറിവ് തേടൂ, വിശ്വാസം വളർത്തൂ ✨</p>
        <hr class="my-2" style="border: none; border-top: 2px solid #166534; opacity: 1;">

        <div class="row g-2">
            <div class="row g-2">
                @foreach ($topics as $key => $item)
                    <div class="col-6 col-md-3">
                        <x-app.topic-card :title="$item" :url="route('questions.show', ['menu_slug' => 'topic', 'module_slug' => $key])" />
                    </div>
                @endforeach
            </div>
        </div>

        <hr class="my-2 mt-4" style="border: none; border-top: 2px solid #166534; opacity: 1;">
        <div class="base-card accent p-3">
            <h3 class="text-center fw-bold mb-2 text-emerald">✨ ദുആയുടെ ശക്തി</h3>
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
                arabic: "الحمدُ للهِ الذي أحيانا بعدما أماتنا وإليه النشور",
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

        const duaSlides = document.getElementById("duaSlides");

        function renderSlides() {
            duaSlides.innerHTML = "";
            duas.forEach((dua, idx) => {
                const activeClass = idx === 0 ? "active" : "";
                const cardClass = idx % 2 === 0 ? "emerald" : "accent";

                duaSlides.innerHTML += `
                    <div class="carousel-item ${activeClass}">
                        <div class="base-card emerald p-3">
                            <h3 class="text-center fw-bold mb-3">${dua.title}</h3>
                            <h2 class="text-ar text-accent text-center text-shadow lh-base">${dua.arabic}</h2>
                            <div class="translit d-none">${dua.translit}</div>
                            <p class="text-center m-0">${dua.translation}</p>
                        </div>
                    </div>
                `;
            });
        }

        renderSlides();
    </script>
@endsection
