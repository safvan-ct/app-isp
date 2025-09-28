@extends('layouts.app')

@section('content')
    <x-app.topbar :title="$questions['title']" :url="route('questions.show', ['menu_slug' => 'topics', 'module_slug' => $questions['slug']])" />

    <div class="container my-3 pb-5">
        <x-app.banner :title="$questions['chapters'][$questionSlug]" :desc="$questions['desc']" :search="false" :author="'Author Name'" :review="date('M d, Y') . ' by Reviewer Name'" />

        <div class="row mt-4 notranslate">
            <div class="col-12 col-lg-8">
                <x-app.study-card :title="'ജുമുഅ ആർക്കാണ് നിർബന്ധമാവുക?'">
                    <p class="m-0 mb-1 text-justify" style="text-indent: 2em">
                        സ്വതന്ത്രനായ, പ്രായപൂർത്തിയെത്തിയ, ബുദ്ധിയുള്ള, ജുമുഅക്കെത്തുവാൻ കഴിവുള്ള, നാട്ടിൽ താമസി ക്കുന്ന ഓരോ
                        മുസ്‌ലിം പുരുഷനും ജുമുഅ നിർബന്ധമാകുന്നു. അടിമ, സ്ത്രീ, കുട്ടി, ഭ്രാന്തൻ, രോഗി, യാത്രക്കാരൻ
                        എന്നിവരുടെ മേൽ ജുമുഅ നിർബന്ധമില്ല.
                    </p>

                    <p class="m-0 mb-2 text-justify" style="text-indent: 2em">
                        എന്നാൽ ജുമുഅ നിർവഹിക്കപ്പെടുന്ന ഒരു നാട്ടിൽ ചെന്നിറങ്ങുന്ന ഒരു യാത്രക്കാരന് ഏറ്റവും ശ്രേഷ്ഠമായത്
                        മുസ്‌ലിംകളോടൊപ്പം ജുമുഅ നമസ്‌രിക്കലാണ്. അടിമ, സ്ത്രീ, കുട്ടി, രോഗി, യാത്രക്കാരൻ എന്നിവർ ജുമുഅയിൽ
                        സംബന്ധിച്ചാൽ അത് അവരിൽനിന്ന് സാധുവാകും. ദ്വുഹ്ർ നമസ്‌കാരത്തെ തൊട്ട് അവർക്കതു മതിയാകുന്നതുമാണ്.
                    </p>
                    <x-app.quran-box class="mb-1"
                        text="വെള്ളിയാഴ്ച നമസ്കാരത്തിന് വിളിക്കപ്പെട്ടാല്‍ അല്ലാഹുവെ പറ്റിയുള്ള സ്മരണയിലേക്ക് നിങ്ങള്‍ വേഗത്തില്‍ വരികയും, വ്യാപാരം ഒഴിവാക്കുകയും ചെയ്യുക.">
                        <x-app.ref-button slug="62" number="9" type="quran" :ref="__('app.quran') . ' 62:9'" />
                    </x-app.quran-box>

                    <x-app.hadith-box text="ഹദീസ്">
                        <x-app.ref-button class="mb-1" slug="sunan-nasai" number="1372" type="hadith"
                            :ref="'അന-നസാഈ:1372'" />
                        <x-app.ref-button slug="abu-dawood" number="1067" type="hadith" :ref="'അബു ദാവൂദ്:1067'" />
                    </x-app.hadith-box>
                </x-app.study-card>

                <x-app.study-card :title="'ജുമുഅയുടെ സമയം'">
                    <p class="m-0 mb-2 text-justify" style="text-indent: 2em">
                        വെള്ളിയാഴ്ച ദ്വുഹ്‌റിന്റെ സമയമാകുന്നു; സൂര്യൻ ആകാശമധ്യത്തിൽനിന്നു തെറ്റിയതു മുതൽ ഒരു വസ്തുവിന്റ നിഴൽ
                        അതിന്റെ നീളത്തോളമാകുന്നതുവരെ.
                    </p>

                    <x-app.quran-box class="mb-1" text="വെള്ളിയാഴ്ച">
                        <x-app.ref-button slug="62" number="9" type="quran" :ref="__('app.quran') . ' 62:9'" />
                    </x-app.quran-box>

                    <x-app.hadith-box text="ഹദീസ്" class="mb-1">
                        <x-app.ref-button class="mb-1" slug="sahih-bukhari" number="876" type="hadith"
                            :ref="'ബുഖാരി:876'" />
                        <x-app.ref-button class="mb-1" slug="sahih-bukhari" number="904" type="hadith"
                            :ref="'ബുഖാരി:904'" />
                        <x-app.ref-button class="mb-1" slug="sahih-bukhari" number="906" type="hadith"
                            :ref="'ബുഖാരി:906'" />

                        <x-app.ref-button class="mb-1" slug="sahih-muslim" number="1977" type="hadith"
                            :ref="'മുസ്ലിം:1977'" />
                        <x-app.ref-button slug="sahih-muslim" number="1992" type="hadith" :ref="'മുസ്ലിം:1992'" />

                        <x-app.ref-button slug="ibn-e-majah" number="1084" type="hadith" :ref="'ബുഖാരി:1084'" />
                    </x-app.hadith-box>

                    <x-app.hadith-box text="പാപങ്ങൾ പൊറുക്കപ്പെടും." class="mb-1">
                        <x-app.ref-button class="mb-1" slug="sahih-bukhari" number="910" type="hadith"
                            :ref="'ബുഖാരി:910'" />
                        <x-app.ref-button class="mb-1" slug="sahih-bukhari" number="883" type="hadith"
                            :ref="'ബുഖാരി:883'" />
                    </x-app.hadith-box>

                    <x-app.hadith-box text="വെള്ളിയാഴ്ചയിലെ മരണം ">
                        <x-app.ref-button slug="al-തിർമിധി" number="1074" type="hadith" :ref="'ബുഖാരി:1074'" />
                    </x-app.hadith-box>
                </x-app.study-card>

                <x-app.study-card :title="'ജുമുഅയുടെ സുന്നത്തുകൾ'">
                    <x-app.hadith-box class="mb-1" text="സിവാക് ഉപയോഗിച്ച് പല്ല് തേക്കുക">
                        <x-app.ref-button slug="sahih-bukhari" number="887" type="hadith" :ref="'ബുഖാരി:887'" />
                    </x-app.hadith-box>

                    <x-app.hadith-box class="mb-1" text="പ്രായപൂർത്തിയായ എല്ലാ മുസ്ലീമിനും വെള്ളിയാഴ്ച കുളി നിർബന്ധമാണ്.">
                        <x-app.ref-button class="mb-1" slug="sahih-bukhari" number="880" type="hadith"
                            :ref="'ബുഖാരി:880'" />
                        <x-app.ref-button slug="sahih-bukhari" number="895" type="hadith" :ref="'ബുഖാരി:895'" />
                    </x-app.hadith-box>

                    <x-app.hadith-box class="mb-1"
                        text="കഴിയുന്നത്ര ശുദ്ധി വരുത്തി, എണ്ണയോ സുഗന്ധമോ ഉപയോഗിച്ച് സ്വയം സുഗന്ധമാക്കുക.">
                        <x-app.ref-button slug="sahih-bukhari" number="883" type="hadith" :ref="'ബുഖാരി:883'" />
                    </x-app.hadith-box>

                    <x-app.hadith-box class="mb-1" text="വസ്ത്രങ്ങളിൽ ഏറ്റവും മുന്തിയതു ധരിക്കുക.">
                        <x-app.ref-button slug="ibn-e-majah" number="1095" type="hadith" :ref="'ഇബ്‍ൻ മാജഹ്:1095'" />
                    </x-app.hadith-box>

                    <x-app.hadith-box class="mb-1"
                        text="മഹത്തായ പ്രതിഫലം നേടുന്നതിനായി ജുമുഅക്കു നേരത്തെ പുറപ്പെടൽ സുന്നത്താകുന്നു.">
                        <x-app.ref-button class="mb-1" slug="sahih-bukhari" number="881" type="hadith"
                            :ref="'ബുഖാരി:881'" />
                        <x-app.ref-button class="mb-1" slug="sahih-bukhari" number="929" type="hadith"
                            :ref="'ബുഖാരി:929'" />
                        <x-app.ref-button class="mb-1" slug="sahih-bukhari" number="907" type="hadith"
                            :ref="'ബുഖാരി:907'" />
                        <x-app.ref-button slug="sahih-bukhari" number="908" type="hadith" :ref="'ബുഖാരി:908'" />
                    </x-app.hadith-box>

                    <x-app.hadith-box class="mb-1"
                        text="പള്ളിയിൽ പ്രവേശിക്കുന്നവൻ രണ്ടു റക്അത്തുകൾ നമസ്‌കരിക്കുന്നതുവരെ ഇരിക്കരുത്.">
                        <x-app.ref-button slug="sahih-bukhari" number="930" type="hadith" :ref="'ബുഖാരി:930'" />
                    </x-app.hadith-box>

                    <x-app.hadith-box class="mb-1" text="ഖുതുബ ചൊല്ലുമ്പോൾ മൗനം പാലിക്കുക">
                        <x-app.ref-button slug="sahih-bukhari" number="883" type="hadith" :ref="'ബുഖാരി:883'" />
                    </x-app.hadith-box>

                    <x-app.hadith-box class="mb-1 border-danger"
                        text="വെള്ളിയാഴ്ച രാവിലും പകലിലും തിരുനബിയുടെമേൽ സ്വലാത്തു">
                        <x-app.ref-button class="mb-1" slug="abu-dawood" number="1047" type="hadith"
                            :ref="'അബു ദാവൂദ്:1047'" />
                        <x-app.ref-button slug="abu-dawood" number="1531" type="hadith" :ref="'അബു ദാവൂദ്:1531'" />
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
