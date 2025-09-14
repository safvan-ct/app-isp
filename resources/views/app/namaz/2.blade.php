@extends('layouts.app')

@section('content')
    <x-app.topbar :title="$questions['title']" :url="route('questions.show', ['menu_slug' => 'topics', 'module_slug' => $questions['slug']])" />

    <div class="container my-3 pb-5">
        <x-app.banner :title="$questions['chapters'][$questionSlug]" :desc="$questions['desc']" :search="false" :author="'Author Name'" :review="date('M d, Y') . ' by Reviewer Name'" />

        <!-- Lesson Body -->
        <div class="p-1">
            <x-app.content :title="'അദാനിന്റെ ആരംഭം'">
                <x-app.hadith-box
                    text="മുസ്ലീങ്ങൾ മദീനയിൽ എത്തിയപ്പോൾ അവർ ഒത്തുകൂടി പ്രാർത്ഥന സമയം അറിയാൻ ശ്രമിച്ചു, പക്ഷേ ആരും അവരെ വിളിച്ചില്ല.
                ഒരു ദിവസം അവർ ഈ വിഷയം ചർച്ച ചെയ്തു, അവരിൽ ചിലർ പറഞ്ഞു: ക്രിസ്ത്യാനികളുടെ മണി പോലുള്ള ഒന്ന് ഉപയോഗിക്കുക, ചിലർ
                പറഞ്ഞു: ജൂതന്മാരുടേത് പോലുള്ള ഒരു കൊമ്പ് ഉപയോഗിക്കുക. ഉമർ (റ) ചോദിച്ചു: (ആളുകളെ) പ്രാർത്ഥനയ്ക്ക് വിളിക്കാൻ
                ഒരാളെ നിയമിച്ചുകൂടേ? അല്ലാഹുവിന്റെ ദൂതൻ (സ) പറഞ്ഞു: ഓ ബിലാൽ, എഴുന്നേറ്റ് (ജനങ്ങളെ) പ്രാർത്ഥനയ്ക്ക്
                വിളിക്കുക."
                    reference="മുസ്ലിം: 837, ബുഖാരി:603,604" />
            </x-app.content>

            <x-app.content :title="'അദാനിന്റെ നിബന്ധനകള്‍'">
                <x-slot:desc>
                    <div class="ref-box ref-summary m-0 rounded-0">
                        <ol class="m-0 ps-4">
                            <li>
                                സമയത്ത് വിളിക്കുക.
                                <br><em class="text-muted"> നമസ്കാരം സമയക്രമത്തോടെ നിർബന്ധിതമാക്കിയിരിക്കുന്നു. 4:103</em>
                            </li>
                            <li>അറബിയിൽ, ശരിയായ വാക്കുകൾ.</li>
                            <li>ക്രമം പാലിക്കുക.</li>
                            <li>തുടർച്ചയായി വിളിക്കുക.</li>
                            <li>
                                മുഅദ്ദിൻ മുസ്ലിം, ബുദ്ധിശക്തിയുള്ള പുരുഷൻ.
                                <br><em class="text-muted">ഇമാം ഉത്തരവാദിത്തമുള്ളവനും മുഅദ്ദീൻ വിശ്വസ്തനുമാണ് - അബു
                                    ദാവൂദ്:517</em>
                            </li>
                        </ol>
                    </div>
                </x-slot:desc>
            </x-app.content>

            <x-app.content :title="'അദാനിന്റെ ഘടന'">
                <x-slot:desc>
                    <div class="ref-box m-0 rounded-0 ref-quran mb-3 border align-items-center text-center">
                        <div class="text-ar fs-5 lh-lg mt-4">اللّٰهُ أَكْبَرُ اللّٰهُ أَكْبَرُ</div>
                        <div class="text-ar fs-5 lh-lg">اللّٰهُ أَكْبَرُ اللّٰهُ أَكْبَرُ</div>

                        <div class="text-ar fs-5 lh-lg mt-2">أَشْهَدُ أَنْ لَا إِلٰهَ إِلَّا اللّٰهُ</div>
                        <div class="text-ar fs-5 lh-lg">أَشْهَدُ أَنْ لَا إِلٰهَ إِلَّا اللّٰهُ</div>

                        <div class="text-ar fs-5 lh-lg mt-2">أَشْهَدُ أَنَّ مُحَمَّدًا رَسُولُ اللّٰهِ</div>
                        <div class="text-ar fs-5 lh-lg">أَشْهَدُ أَنَّ مُحَمَّدًا رَسُولُ اللّٰهِ</div>

                        <div class="text-ar fs-5 lh-lg mt-2">حَيَّ عَلَى الصَّلَاةِ</div>
                        <div class="text-ar fs-5 lh-lg">حَيَّ عَلَى الصَّلَاةِ</div>

                        <div class="text-ar fs-5 lh-lg mt-2">حَيَّ عَلَى الفَلَاحِ</div>
                        <div class="text-ar fs-5 lh-lg">حَيَّ عَلَى الفَلَاحِ</div>

                        <div class="bg-primary-subtle mt-2 py-1">
                            <div class="text-ar fs-5 lh-lg">الصَّلَاةُ خَيْرٌ مِنَ النَّوْمِ</div>
                            <div class="text-ar fs-5 lh-lg">الصَّلَاةُ خَيْرٌ مِنَ النَّوْمِ</div>
                        </div>

                        <div class="text-ar fs-5 lh-lg mt-2">اللّٰهُ أَكْبَرُ اللّٰهُ أَكْبَرُ</div>
                        <div class="text-ar fs-5 lh-lg">لَا إِلٰهَ إِلَّا اللّٰهُ</div>
                    </div>

                    <div class="ref-box ref-summary m-0 rounded-0">
                        <ol class="m-0 ps-4">
                            <li>(ഹയ്യാ അലസ്-സലാഃ) → മുഖം വലത്തേക്ക് തിരിക്കുക.</li>
                            <li>(ഹയ്യാ അലൽ-ഫലാഹ്) → മുഖം ഇടത്തേക്ക് തിരിക്കുക.</li>
                            <li>
                                പ്രഭാത പ്രാർത്ഥനയാണെങ്കിൽ, നിങ്ങൾ ഉച്ചരിക്കണം:
                                <span class="fs-3 text-ar">الصَّلَاةُ خَيْرٌ مِنَ النَّوْمِ</span>
                            </li>
                        </ol>
                    </div>
                </x-slot:desc>

                <x-app.hadith-box class="mb-2" text="നബി ﷺ അദാൻ പഠിപ്പിച്ചു." reference="മുസ്ലിം: 842, അബു ദാവൂദ്: 500" />

                <x-app.hadith-box class="mb-2"
                    text="ബിലാൽ (റ) നമസ്കാരത്തിന് അദാൻ ഉച്ചരിക്കുമ്പോൾ മുഖം അങ്ങോട്ടുമിങ്ങോട്ടും തിരിക്കുന്നത് ഞാൻ കണ്ടു."
                    reference="മുസ്ലിം: 634" />

                <x-app.hadith-box text="പ്രഭാത പ്രാർത്ഥനയാണെങ്കിൽ, നിങ്ങൾ ഉച്ചരിക്കണം: الصَّلَاةُ خَيْرٌ مِنَ النَّوْمِ"
                    reference="അബു ദാവൂദ്: 500" />
            </x-app.content>

            <x-app.content :title="'അദാൻ സമയത്തെ പ്രാർത്ഥന'">
                <x-app.hadith-box class="mb-2" reference="ബുഖാരി:614">
                    <x-slot:text>
                        <p class="fs-3 text-ar m-0 lh-lg">
                            اللَّهُمَّ رَبَّ هَذِهِ الدَّعْوَةِ التَّامَّةِ وَالصَّلاَةِ الْقَائِمَةِ آتِ مُحَمَّدًا
                            الْوَسِيلَةَ وَالْفَضِيلَةَ وَابْعَثْهُ مَقَامًا مَحْمُودًا الَّذِي وَعَدْتَهُ
                        </p>
                    </x-slot:text>
                </x-app.hadith-box>
            </x-app.content>

            <x-app.content :title="'ഇഖാമത്'">
                <div class="ref-box m-0 rounded-0 ref-quran mb-3 border align-items-center text-center">
                    <div class="text-ar fs-5 lh-lg mt-4">اللّٰهُ أَكْبَرُ اللّٰهُ أَكْبَرُ</div>

                    <div class="text-ar fs-5 lh-lg mt-2">أَشْهَدُ أَنْ لَا إِلٰهَ إِلَّا اللّٰهُ</div>

                    <div class="text-ar fs-5 lh-lg mt-2">أَشْهَدُ أَنَّ مُحَمَّدًا رَسُولُ اللّٰهِ</div>

                    <div class="text-ar fs-5 lh-lg mt-2">حَيَّ عَلَى الصَّلَاةِ</div>

                    <div class="text-ar fs-5 lh-lg mt-2">حَيَّ عَلَى الفَلَاحِ</div>

                    <div class="bg-primary-subtle mt-2 py-1">
                        <div class="text-ar fs-5 lh-lg">قَدْ قَامَتِ الصَّلَاةُ</div>
                        <div class="text-ar fs-5 lh-lg">قَدْ قَامَتِ الصَّلَاةُ</div>
                    </div>

                    <div class="text-ar fs-5 lh-lg mt-2">اللّٰهُ أَكْبَرُ اللّٰهُ أَكْبَرُ</div>
                    <div class="text-ar fs-5 lh-lg">لَا إِلٰهَ إِلَّا اللّٰهُ</div>
                </div>

                <x-app.hadith-box class="mb-2" reference="ബുഖാരി:607, മുസ്ലിം: 838">
                    <x-slot:text>
                        ഖാദ്-ഖമത്ത്-ഇസ്-സലാത്ത് ഒഴികെയുള്ള ഇഖാമയുടെ പദങ്ങൾ ഒരിക്കൽ ഉച്ചരിക്കാൻ<br>
                    </x-slot:text>
                </x-app.hadith-box>
            </x-app.content>

            <x-app.content :title="'അദാൻ & ഇഖാമത് കേൾക്കുമ്പോൾ'">
                <x-app.hadith-box class="mb-2" reference="ബുഖാരി:611, മുസ്ലിം:848,849">
                    <x-slot:text>
                        മുഅദ്ദീന്റെ വാക്കുകൾ കേൾക്കുമ്പോൾ, അവൻ പറയുന്നത് ആവർത്തിക്കുക.
                    </x-slot:text>
                </x-app.hadith-box>

                <x-app.hadith-box class="mb-2" reference="മുസ്ലിം:850, ബുഖാരി:613">
                    <x-slot:text>
                        മുഅദ്ദീൻ <span class="fs-4">حَيَّ عَلَى الصَّلَاةِ</span> എന്ന് പറയുമ്പോൾ, ഒരാൾ പ്രതികരിക്കണം:
                        <span class="fs-4">لَا حَوْلَ وَلَا قُوَّةَ إِلَّا بِاللهِ</span>
                        മുഅദ്ദീൻ <span class="fs-4">حَيَّ عَلَى الْفَلَاحِ</span> എന്ന് പറയുമ്പോൾ, <span
                            class="fs-4">لَا حَوْلَ وَلَا قُوَّةَ إِلَّا بِاللهِ</span>
                    </x-slot:text>
                </x-app.hadith-box>
            </x-app.content>

            <x-app.content :title="'Reminders'">
                <div class="ref-box ref-summary mt-0 rounded-0">
                    <ul class="m-0 ps-4">
                        <li>വുദൂ ഇല്ലാതെ അദാൻ വിളിച്ചാലും സാധുവാണ്.</li>
                        <li>പക്ഷേ വുദൂ ഉണ്ടായിരിക്കുമ്പോഴാണ് ഏറ്റവും ഉത്തമം, കാരണം അത് ആരാധനയാണ്.</li>
                        <li>
                            (ഹനഫി, ഷാഫിഈ, മാലികി, ഹൻബലി): ഖിബ്‌ലയ്ക്ക് നേരെ തിരിഞ്ഞ് അദാൻ വിളിക്കുന്നത് സുന്നത്ത് (ശുപാർശ
                            ചെയ്തത്) ആണ്.
                        </li>
                        <li>
                            നിർബന്ധമല്ല. വശത്തേക്ക് നോക്കി വിളിച്ചാലും അദാൻ സാധുവാണ്.
                        </li>
                    </ul>
                </div>
            </x-app.content>
        </div>

        <h5 class="text-emerald fw-bold">Related Topics</h5>
        @foreach ($questions['chapters'] as $item)
            @continue($questionSlug == $loop->index)

            <x-app.topic-chapter :title="$loop->index + 1 . ' : ' . $item" :url="route('answers.show', [
                'menu_slug' => 'topics',
                'module_slug' => $questions['slug'],
                'question_slug' => $loop->index,
            ])" :related="true" />
        @endforeach
    </div>
@endsection
