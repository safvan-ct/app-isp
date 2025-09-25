@extends('layouts.app')

@section('content')
    <x-app.topbar :title="$questions['title']" :url="route('questions.show', ['menu_slug' => 'topics', 'module_slug' => $questions['slug']])" />

    <div class="container my-3 pb-5">
        <x-app.banner :title="$questions['chapters'][$questionSlug]" :desc="$questions['desc']" :search="false" :author="'Author Name'" :review="date('M d, Y') . ' by Reviewer Name'" />

        <div class="row mt-4 notranslate">
            <div class="col-12 col-lg-8">
                <x-app.study-card :title="'നമസ്കാരത്തിന് ശേഷം'">
                    <x-app.quran-box class="mb-1"
                        text="നിങ്ങൾ നമസ്കാരം തീർത്താൽ, നിന്നുകൊണ്ടും ഇരുന്നുകൊണ്ടും കിടന്നുകൊണ്ടും അല്ലാഹുവിനെ സ്മരിക്കുവിൻ.">
                        <x-app.ref-button slug="4" number="103" type="quran" :ref="__('app.quran') . ' 4:103'" />
                    </x-app.quran-box>

                    <x-app.hadith-box text="3 തവണ പറയുക." class="mb-1">
                        <h5 class="m-0 text-ar lh-lg">
                            أَسْتَغْفِرُ اللهَ
                        </h5>
                        <x-app.ref-button slug="sahih-muslim" :number="'1334'" type="hadith" :ref="'മുസ്ലിം:1334'" />
                    </x-app.hadith-box>

                    <x-app.hadith-box text="" class="mb-1">
                        <h5 class="m-0 text-ar lh-lg">
                            اللهُمَّ أَنْتَ السَّلَامُ وَمِنْكَ السَّلَامُ، تَبَارَكْتَ ذَا الْجَلَالِ وَالْإِكْرَامِ
                        </h5>
                        <x-app.ref-button slug="sahih-muslim" :number="'1334'" type="hadith" :ref="'മുസ്ലിം:1334'" />
                    </x-app.hadith-box>

                    <x-app.hadith-box text="തസ്ബീഹ് 33 തവണ പറയുക." class="mb-1">
                        <h5 class="m-0 text-ar lh-lg">
                            سُبْحَانَ اللَّهِ، وَالْحَمْدُ لِلَّهِ، وَاللَّهُ أَكْبَرُ
                        </h5>
                        <x-app.ref-button class="mb-1" slug="sahih-bukhari" :number="'843'" type="hadith"
                            :ref="'ബുഖാരി:843'" />
                        <x-app.ref-button class="mb-1" slug="sahih-muslim" :number="'1348'" type="hadith"
                            :ref="'മുസ്ലിം:1348'" />
                        <x-app.ref-button class="mb-1" slug="sahih-muslim" :number="'1349'" type="hadith"
                            :ref="'മുസ്ലിം:1349'" />
                        <x-app.ref-button slug="sahih-muslim" :number="'1350'" type="hadith" :ref="'മുസ്ലിം:1350'" />
                    </x-app.hadith-box>

                    {{-- <x-app.hadith-box text="ലാ ഇലാഹ ഇല്ലല്ലാഹ്" class="mb-1">
                        <h5 class="m-0 text-ar lh-lg">
                            سُبْحَانَ اللَّهِ، وَالْحَمْدُ لِلَّهِ، وَاللَّهُ أَكْبَرُ
                        </h5>
                        <x-app.ref-button slug="sahih-muslim" :number="'1344'" type="hadith" :ref="'മുസ്ലിം:1344'" />
                    </x-app.hadith-box> --}}

                    <x-app.hadith-box text="" class="mb-1">
                        <h5 class="m-0 text-ar lh-lg">
                            لاَ إِلَهَ إِلاَّ اللَّهُ وَحْدَهُ لاَ شَرِيكَ لَهُ، لَهُ الْمُلْكُ، وَلَهُ الْحَمْدُ، وَهْوَ
                            عَلَى كُلِّ شَىْءٍ قَدِيرٌ، اللَّهُمَّ لاَ مَانِعَ لِمَا أَعْطَيْتَ، وَلاَ مُعْطِيَ لِمَا
                            مَنَعْتَ، وَلاَ يَنْفَعُ ذَا الْجَدِّ مِنْكَ الْجَدُّ ‏
                        </h5>
                        <x-app.ref-button class="mb-1" slug="sahih-bukhari" :number="'844'" type="hadith"
                            :ref="'ബുഖാരി:844'" />
                        <x-app.ref-button slug="sahih-muslim" :number="'1338'" type="hadith" :ref="'മുസ്ലിം:1338'" />
                    </x-app.hadith-box>

                    {{-- <x-app.hadith-box text="ആയതുൽ കുർസീ" class="mb-1">
                        <x-app.ref-button class="mb-1" slug="2" number="255" type="quran" :ref="__('app.quran') . ' 2:255'" />
                        <x-app.ref-button class="mb-1" slug="sahih-bukhari" :number="'2311'" type="hadith" :ref="'ബുഖാരി:2311'" />
                        <x-app.ref-button slug="sahih-bukhari" :number="'3275'" type="hadith" :ref="'ബുഖാരി:3275'" />
                    </x-app.hadith-box> --}}

                    <x-app.hadith-box text="ദുആ">
                        <h5 class="m-0 text-ar lh-lg">
                            اللَّهُمَّ أَعِنِّي عَلَى ذِكْرِكَ وَشُكْرِكَ وَحُسْنِ عِبَادَتِكَ
                        </h5>
                        <x-app.ref-button slug="abu-dawood" :number="'1522'" type="hadith" :ref="'അൻ-നസാഈ:1522'" />
                        {{-- <x-app.ref-button slug="sunan-nasai" :number="'1303'" type="hadith" :ref="'അൻ-നസാഈ:1303'" /> --}}
                    </x-app.hadith-box>
                </x-app.study-card>
            </div>

            <div class="col-12 col-lg-4 mb-4">
                <x-app.related-topics :data="$questions['chapters']" :current="$questionSlug" :menu_slug="'topics'" :module_slug="$questions['slug']" />
            </div>
        </div>
    </div>

    <!-- References Offcanvas -->
    <div class="offcanvas offcanvas-end notranslate" tabindex="-1" id="referencesPanel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title">References</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"></button>
        </div>
        <div class="offcanvas-body py-0">
            <div class="ref-box ref-hadith m-0 mb-1" id="ref1">
                <span class="fw-bold">[1]. ഇമാം അബൂ ഹനീഫ (80 - 150 ഹി)</span><br>

                <p class="m-0 small mb-2">
                    ഇമാം അബൂ ഹനീഫയുടെ സ്വന്തം കാലത്തോ, പണ്ഡിതന്മാരായ ഇമാം അബൂ യൂസുഫ് (d. 182H), ഇമാം മുഹമ്മദ് (d. 189H)
                    എന്നിവരുടെ പുസ്തകങ്ങളിലോ (അഥവാ ആസാർ, ഫിഖ്ഹ് രചനകൾ) റ. അ. മാസത്തെ കുറിച് ഒന്നും
                    രേഖപ്പെടുത്തിയിട്ടില്ല.
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
                    ഖുർആൻ, സുന്നത്ത്, ഇജ്മാഅ് വിരുദ്ധമല്ലാതെ കാര്യങ്ങൾ - <span class="fw-bold">ബിദ്അത്
                        ഹസന</span><br>
                    ഖുർആൻ, സുന്നത്ത്, ഇജ്മാഅ് വിരുദ്ധമാകുന്ന കാര്യങ്ങൾ - <span class="fw-bold">ബിദ്അത്
                        ദലാല</span>
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
                    എനിക്ക് അത് ബിദ്അത് ആയി തോന്നുന്നു
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

            <div class="ref-box ref-hadith m-0 mb-1" id="ref5">
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
