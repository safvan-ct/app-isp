@extends('layouts.app')

@section('content')
    <x-app.topbar :title="$questions['title']" :url="route('questions.show', ['menu_slug' => 'topics', 'module_slug' => $questions['slug']])" />

    <div class="container my-3 pb-5">
        <x-app.banner :title="$questions['chapters'][$questionSlug]" :desc="$questions['desc']" :search="false" :author="'Author Name'" :review="date('M d, Y') . ' by Reviewer Name'" />

        <div class="row mt-3 notranslate">
            <div class="col-12 col-md-8">
                <ul class="nav nav-tabs mb-3" id="mainTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link text-emerald active" id="home-tab" data-bs-toggle="tab"
                            data-bs-target="#home" type="button">
                            <i class="fas fa-home"></i>
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link text-emerald" id="adhan-tab" data-bs-toggle="tab" data-bs-target="#adhan"
                            type="button">
                            അദാൻ
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link text-emerald" id="iqama-tab" data-bs-toggle="tab" data-bs-target="#iqama"
                            type="button">
                            ഇഖാമത്
                        </button>
                    </li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane fade show active" id="home">
                        <x-app.study-card title="എങ്ങനെ പഠിക്കാം — ഗൈഡ്">
                            <x-slot:desc>
                                <ul style="list-style: none" class="p-0 ps-3">
                                    <li>
                                        <strong>Step 1:</strong> മലയാളം വിശദീകരണം വായിക്കുക - എന്താണ് ചെയ്യേണ്ടത്
                                        അറിയാൻ.
                                    </li>
                                    <li><strong>Step 2:</strong> അറബിക് വാക്യം വായിക്കുക - ശരിയായ ഉച്ചാരണം വീക്ഷിക്കുക.
                                    </li>
                                    <li>
                                        <strong>Step 3:</strong> റഫറൻസ് ബട്ടൺ ക്ലിക്ക് ചെയ്യുക → {{ __('app.quran') }} /
                                        {{ __('app.hadith') }} റഫറൻസ് കാണുക.
                                    </li>
                                </ul>

                                <div class="mt-0">
                                    <button class="btn btn-success btn-sm" onclick="openTab('adhan')">അദാൻ</button>
                                    <button class="btn btn-outline-primary btn-sm" onclick="openTab('iqama')">
                                        ഇഖാമത്
                                    </button>
                                </div>
                            </x-slot>
                        </x-app.study-card>
                    </div>

                    <div class="tab-pane fade" id="adhan">
                        <x-app.study-card title="അദാനിന്റെ ആരംഭം">
                            <x-slot:desc>
                                <p class="m-0 mb-1">
                                    മദീനയിലെത്തിയപ്പോൾ മുസ്ലീങ്ങൾക്ക് നമസ്കാര സമയങ്ങൾ അറിയിക്കാനായി ഒരു മാർഗം വേണമെന്ന്
                                    തോന്നിയപ്പോൾ നബി ﷺ ബിലാൽ (റ) നെ നിയോഗിച്ചു; അതിലൂടെയാണ് അദാൻ തുടങ്ങിയത്.
                                </p>
                            </x-slot:desc>

                            <x-slot:reference>
                                <x-app.ref-button slug="sahih-bukhari" number="603" type="hadith" ref="ബുഖാരി:603" />
                                <x-app.ref-button slug="sahih-bukhari" number="604" type="hadith" ref="ബുഖാരി:604" />
                                <x-app.ref-button slug="sahih-muslim" number="837" type="hadith" ref="മുസ്ലിം:837" />
                            </x-slot:reference>
                        </x-app.study-card>

                        <x-app.study-card title="അദാനിന്റെ നിബന്ധനകൾ">
                            <x-slot:desc>
                                <p class="m-0 mb-1">
                                    അദാൻ വിളിക്കുമ്പോൾ സമയം പാലിക്കുക (നമസ്കാരം സമയബന്ധിതമാണ്), വാക്കുകൾ ശരിയായി
                                    അറബിയിൽ പറയുക, മുഅദ്ദീൻ വിശ്വസ്തനും ബുദ്ധിശാലിയുമാകണം.
                                </p>
                            </x-slot:desc>

                            <x-slot:reference>
                                <x-app.ref-button slug="4" number="103" type="quran" :ref="__('app.quran') . ' 4:103'" />
                                <x-app.ref-button slug="abu-dawood" number="517" type="hadith" ref="അബു ദാവൂദ്:517" />
                            </x-slot:reference>
                        </x-app.study-card>

                        <x-app.study-card title="അദാനിന്റെ ഘടന">
                            <x-slot:desc>
                                <p class="text-center text-ar lh-lg text-emerald-900 m-0 my-1">
                                    اللّٰهُ أَكْبَرُ اللّٰهُ أَكْبَرُ ×2<br> أَشْهَدُ أَنْ لَا إِلٰهَ إِلَّا اللّٰهُ ×2<br>
                                    أَشْهَدُ أَنَّ مُحَمَّدًا رَسُولُ اللّٰهِ ×2<br> حَيَّ عَلَى الصَّلَاةِ ×2<br>
                                    حَيَّ عَلَى الْفَلَاحِ ×2<br> الصَّلَاةُ خَيْرٌ مِنَ النَّوْمِ ×2 (ഫജ്റ് മാത്രം)<br>
                                    اللّٰهُ أَكْبَرُ ×2<br> لَا إِلٰهَ إِلَّا اللّٰهُ
                                </p>

                                <div class="ref-box ref-summary m-0 rounded-0 mb-2">
                                    അദാനിൽ <strong>“ഹയ്യാ അലസ്-സലാഃ”</strong> എന്ന് പറയുമ്പോൾ മുഖം
                                    <strong>വലത്തേക്ക്</strong> തിരിക്കുക. <strong>“ഹയ്യാ അലൽ-ഫലാഹ്”</strong> എന്ന്
                                    പറയുമ്പോൾ മുഖം <strong>ഇടത്തേക്ക്</strong> തിരിക്കുക. പ്രഭാത (ഫജ്റ്) അദാനിൽ
                                    പറയേണ്ട പ്രത്യേക വാചകം: <em class="text-ar fs-5">الصَّلَاةُ خَيْرٌ مِنَ النَّوْمِ</em> —
                                    "സലാത്ത് ഉറക്കത്തേക്കാൾ നല്ലതാണ്".
                                </div>

                                <div class="ref-box ref-summary m-0 rounded-0 mb-2">
                                    എന്തെങ്കിലും <strong>അടിയന്തിര സാഹചര്യം ഉണ്ടായാൽ</strong> <em
                                        class="text-ar fs-5">صَلُّوا فِي الرِّحَالِ </em> വീടുകളിൽ വെച്ച് നമസ്കരിക്കാൻ
                                    കൽപ്പിക്കുക
                                </div>
                            </x-slot:desc>

                            <x-slot:reference>
                                <x-app.ref-button slug="sahih-muslim" number="842" type="hadith" ref="മുസ്ലിം:842" />
                                <x-app.ref-button slug="sahih-muslim" number="1119" type="hadith" ref="മുസ്ലിം:1119" />
                                <x-app.ref-button slug="sahih-muslim" number="1600" type="hadith" ref="മുസ്ലിം:1600" />
                                <x-app.ref-button slug="sahih-muslim" number="1601" type="hadith" ref="മുസ്ലിം:1601" />
                                <x-app.ref-button slug="abu-dawood" number="500" type="hadith" ref="അബു ദാവൂദ്:500" />
                            </x-slot:reference>
                        </x-app.study-card>

                        <x-app.study-card title="അദാനിന് ശേഷമുള്ള ദുആ">
                            <x-slot:desc>
                                <p class="fs-4 text-ar lh-lg">
                                    اللَّهُمَّ رَبَّ هَذِهِ الدَّعْوَةِ التَّامَّةِ وَالصَّلاَةِ الْقَائِمَةِ آتِ مُحَمَّدًا
                                    الْوَسِيلَةَ وَالْفَضِيلَةَ وَابْعَثْهُ مَقَامًا مَحْمُودًا الَّذِي وَعَدْتَهُ
                                </p>
                            </x-slot:desc>

                            <x-slot:reference>
                                <x-app.ref-button slug="sahih-bukhari" number="614" type="hadith" ref="ബുഖാരി:614" />
                            </x-slot:reference>
                        </x-app.study-card>

                        <x-app.study-card title="മുഅദ്ദീന്റെ വാക്കുകൾ കേൾക്കുമ്പോൾ പ്രതികരണം">
                            <x-slot:desc>
                                <p class="m-0 mb-1">
                                    മുഅദ്ദീന്റെ വാക്കുകൾ കേൾക്കുമ്പോൾ, പറയുന്നത് ആവർത്തിക്കുകയും. അവൻ
                                    '<span class="fs-5 text-emerald">حَيَّ عَلَى الصَّلَاةِ</span>' OR
                                    '<span class="fs-5 text-emerald">حَيَّ عَلَى الْفَلَاحِ</span>'
                                    എന്നു പറയുമ്പോൾ - അതിനുത്തരം നിങ്ങൾ പറയേണ്ടത്:
                                    <span class="fs-5 text-emerald fw-bold">لَا حَوْلَ وَلَا قُوَّةَ إِلَّا بِاللهِ</span>.
                                </p>
                            </x-slot:desc>

                            <x-slot:reference>
                                <x-app.ref-button slug="sahih-bukhari" number="611" type="hadith" ref="ബുഖാരി:611" />
                                <x-app.ref-button slug="sahih-muslim" number="848" type="hadith" ref="മുസ്ലിം:848" />
                                <x-app.ref-button slug="sahih-muslim" number="849" type="hadith" ref="മുസ്ലിം:849" />
                                <x-app.ref-button slug="sahih-muslim" number="850" type="hadith" ref="മുസ്ലിം:850" />
                            </x-slot:reference>
                        </x-app.study-card>

                        <x-app.study-card title="ഓർമ്മപ്പെടുത്തലുകൾ">
                            <x-slot:desc>
                                <p class="mb-0">👉 <strong>വുദൂ ഇല്ലാതെ</strong> അദാൻ പറയുന്നതും
                                    <strong>സാധുവാണ്</strong>. അദാൻ ഒരു ആരാധനയായതിനാൽ <strong>വുദൂ ഉണ്ടെങ്കിൽ</strong> അത്
                                    കൂടുതൽ <strong>ഉത്തമം</strong>. എല്ലാ മധ്ഹബുകളും പറയുന്നു, <strong>ഖിബ്‌ലയുടെ
                                        ദിശയിൽ</strong> അദാൻ വിളിക്കുന്നത് സുന്നത്ത് (ശുപാർശ) ആണ് - പക്ഷേ അത് നിർബന്ധമല്ല;
                                    വശത്തേക്ക് നോക്കി വിളിച്ചാലും അദാൻ സാധുവാണ്.
                                </p>
                            </x-slot:desc>
                        </x-app.study-card>
                    </div>

                    <div class="tab-pane fade" id="iqama">
                        <x-app.study-card title="ഇഖാമത്തിന്റെ ലളിതമായ വിശദീകരണം">
                            <x-slot:desc>
                                <p>ഇഖാമത് പ്രാർത്ഥന ഉടനെ തുടങ്ങാനാണ് വിളിക്കുന്നത് .</p>

                                <p class="text-center text-ar lh-lg text-emerald-900">
                                    اللّٰهُ أَكْبَرُ ×2<br> أَشْهَدُ أَنْ لَا إِلٰهَ إِلَّا اللّٰهُ<br>
                                    أَشْهَدُ أَنَّ مُحَمَّدًا رَسُولُ اللّٰهِ<br> حَيَّ عَلَى الصَّلَاةِ<br>
                                    حَيَّ عَلَى الْفَلَاحِ<br> قَدْ قَامَتِ الصَّلَاةُ ×2<br> اللّٰهُ أَكْبَرُ ×2<br>
                                    لَا إِلٰهَ إِلَّا اللّٰهُ
                                </p>
                            </x-slot:desc>

                            <x-slot:reference>
                                <x-app.ref-button slug="sahih-bukhari" number="607" type="hadith" ref="ബുഖാരി:607" />
                                <x-app.ref-button slug="sahih-muslim" number="838" type="hadith" ref="മുസ്ലിം:838" />
                            </x-slot:reference>
                        </x-app.study-card>

                        <x-app.study-card title="മുഅദ്ദീന്റെ വാക്കുകൾ കേൾക്കുമ്പോൾ പ്രതികരണം">
                            <x-slot:desc>
                                <p class="m-0 mb-1">
                                    മുഅദ്ദീന്റെ വാക്കുകൾ കേൾക്കുമ്പോൾ, പറയുന്നത് ആവർത്തിക്കുകയും. അവൻ
                                    '<span class="fs-5 text-emerald">حَيَّ عَلَى الصَّلَاةِ</span>' OR
                                    '<span class="fs-5 text-emerald">حَيَّ عَلَى الْفَلَاحِ</span>'
                                    എന്നു പറയുമ്പോൾ - അതിനുത്തരം നിങ്ങൾ പറയേണ്ടത്:
                                    <span class="fs-5 text-emerald fw-bold">لَا حَوْلَ وَلَا قُوَّةَ إِلَّا بِاللهِ</span>.
                                </p>
                            </x-slot:desc>

                            <x-slot:reference>
                                <x-app.ref-button slug="sahih-bukhari" number="611" type="hadith" ref="ബുഖാരി:611" />
                                <x-app.ref-button slug="sahih-muslim" number="848" type="hadith" ref="മുസ്ലിം:848" />
                                <x-app.ref-button slug="sahih-muslim" number="849" type="hadith" ref="മുസ്ലിം:849" />
                                <x-app.ref-button slug="sahih-muslim" number="850" type="hadith" ref="മുസ്ലിം:850" />
                            </x-slot:reference>
                        </x-app.study-card>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-4">
                <x-app.related-topics :data="$questions['chapters']" :current="$questionSlug" :menu_slug="'topics'" :module_slug="$questions['slug']" />
            </div>
        </div>
    </div>
@endsection
