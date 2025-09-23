@extends('layouts.app')

@section('content')
    <x-app.topbar :title="$questions['title']" :url="route('questions.show', ['menu_slug' => 'topics', 'module_slug' => $questions['slug']])" />

    <div class="container my-3 pb-5">
        <x-app.banner :title="$questions['chapters'][$questionSlug]" :desc="'വെള്ളം ലഭിച്ചില്ലെങ്കിലോ വെള്ളം ഉപയോഗിക്കാന്‍ കഴിയാത്ത സാഹചര്യമാണെങ്കിലോ തയമ്മും ചെയ്ത് ശുദ്ധിവരുതാം.'" :search="false" :author="'Author Name'" :review="date('M d, Y') . ' by Reviewer Name'" />

        <div class="row mt-4 notranslate">
            <div class="col-12 col-lg-8">
                <div class="accordion" id="accordions">
                    <x-app.accordion :id="'topic1'" :title="'നജസ്'">
                        <p class="m-0 mb-2 text-justify" style="text-indent: 2em">
                            നജസ് മൂന്നുവിധമാണ്. <strong>1) നജാസ മുഗല്ലദ്വ (കടുത്ത നജസ്):</strong> നായയും നായയിൽനിന്ന് ജന്മം
                            കൊള്ളുന്നവയുമാകുന്നു അവ. <strong>2) നജാസ മുഖഫ്ഫഫ (ലഘുവായ നജസ്):</strong> രക്തം, മദ്‌യ്, ചലം,
                            ചോരയും ചലവും കലർന്ന നീര്, ഭക്ഷണം കഴിച്ചിട്ടില്ലാത്ത ആൺകുട്ടിയുടെ മൂത്രം പോലുള്ളവ. <strong>3)
                                നജാസഃ മുതവസ്സിത്വ (ഇടത്തരം നജസ്): മൂത്രം, മലം, ശവം പോലുള്ളവ.</strong>
                        </p>
                        <x-app.hr />

                        <h6 class="text-emerald-900 fw-bold mt-3">1. തെളിവുകൾ വ്യക്തമാക്കിയ നജസുകൾ</h6>
                        <p class="m-0 mb-1 text-justify" style="text-indent: 2em">
                            മനുഷ്യന്റെ മൂത്രം, മലം, ഛർദിൽ: ഭക്ഷണം കഴിച്ചിട്ടില്ലാത്ത ആൺകുട്ടിയുടെ മൂത്രം ഇതിൽനിന്ന് ഒഴിവാണ്;
                            അതിൽ വെള്ളം തെളിച്ചാൽ മതിയാകും.
                        </p>

                        <x-app.hadith-box text="ഹദീസ്." class="mb-3">
                            <x-app.ref-button class="mb-1" slug="sahih-bukhari" number="223" type="hadith"
                                :ref="'ബുഖാരി:223'" />
                            <x-app.ref-button class="mb-1" slug="sahih-bukhari" number="220" type="hadith"
                                :ref="'ബുഖാരി:220'" />
                            <x-app.ref-button class="mb-1" slug="al-tirmidhi" number="610" type="hadith"
                                :ref="'അൽ-തിർമിധി:610'" />
                            <x-app.ref-button slug="ibn-e-majah" number="522" type="hadith" :ref="'ഇബ്നുമാജ :522'" />
                        </x-app.hadith-box>
                        <x-app.hr />

                        <h6 class="text-emerald-900 fw-bold mt-3">
                            2. മാംസം ഭക്ഷ്യയോഗ്യമായ മൃഗത്തിൽനിന്ന് ഒഴുക്കപ്പെട്ട രക്തം.
                        </h6>
                        <p class="m-0 mb-1 text-justify" style="text-indent: 2em">
                            മാംസത്തിലും നാഡിഞരമ്പുകളിലും ശേഷിക്കുന്ന രക്തം ശുദ്ധമാകുന്നു.
                        </p>

                        <x-app.quran-box class="mb-3" text="അത് ഒഴുക്കപ്പെട്ട രക്തം ആണെങ്കിലൊഴികെ.">
                            <x-app.ref-button slug="6" number="145" type="quran" :ref="__('app.quran') . ' 6:145'" />
                        </x-app.quran-box>
                        <x-app.hr />

                        <h6 class="text-emerald-900 fw-bold mt-3">3. ശവം</h6>
                        <p class="m-0 mb-1 text-justify" style="text-indent: 2em">
                            മതപരമായ നിലക്കുള്ള അറവു നടത്താതെ സ്വാഭാവിക മരണത്തിലൂടെ ജീവൻ പോയതാണത്.
                        </p>

                        <x-app.quran-box class="mb-1" text="അത് ശവമാണെങ്കിലൊഴികെ">
                            <x-app.ref-button slug="6" number="145" type="quran" :ref="__('app.quran') . ' 6:145'" />
                        </x-app.quran-box>
                        <x-app.ref-box class="mb-3">
                            മത്സ്യവും വെട്ടുകിളിയും ഒലിക്കുന്ന രക്തമില്ലാത്ത പ്രാണിയും ഇതിൽനിന്ന് ഒഴിവാണ്. കാരണം അത്
                            ശുദ്ധമാണ്.
                        </x-app.ref-box>
                        <x-app.hr />

                        <h6 class="text-emerald-900 fw-bold mt-3">4. ആർത്തവ രക്തം</h6>
                        <x-app.hadith-box text="ഹദീസ്." class="mb-3">
                            <x-app.ref-button slug="sahih-bukhari" number="227" type="hadith" :ref="'ബുഖാരി:227'" />
                        </x-app.hadith-box>
                        <x-app.hr />

                        <h6 class="text-emerald-900 fw-bold mt-3">5. മദ്‌യ്</h6>
                        <p class="m-0 mb-1 text-justify" style="text-indent: 2em">
                            വെളുത്തതും നേർത്തതും കൊഴുത്തതുമായ ദ്രാവകമാണത്. രതിചേഷ്ടകളുടെ അവസരത്തിലോ സംഭോഗത്തെക്കുറിച്ച്
                            സ്മരിക്കുമ്പോഴോ സ്രവിക്കുന്നതാണത്. വികാരം ശക്തിപ്രാപിച്ചോ തെറിച്ചുകൊണ്ടോ ആയിരിക്കില്ല അത്
                            സ്രവിക്കുന്നത്. അതിനെ തുടർന്ന് തളർച്ചയുണ്ടാവുകയുമില്ല. ചിലപ്പോൾ അത് പുറപ്പെടുന്നത്
                            അനുഭവപ്പെട്ടുകൊള്ളണമെന്നില്ല.
                        </p>

                        <x-app.hadith-box text="ഹദീസ്." class="mb-3">
                            <x-app.ref-button slug="sahih-bukhari" number="269" type="hadith" :ref="'ബുഖാരി:269'" />
                        </x-app.hadith-box>
                        <x-app.hr />

                        <h6 class="text-emerald-900 fw-bold mt-3">6. വദ്‌യ്</h6>
                        <p class="m-0 mb-2 text-justify" style="text-indent: 2em">
                            ചിലരിൽ മൂത്ര വിസർജനത്തിനു ശേഷം പുറപ്പെടുന്ന കടുത്ത ഒരുതരം വെളുത്ത ദ്രാവകമാണത്. അതുണ്ടായവൻ തന്റെ
                            ജനനേന്ദ്രിയം കഴുകുകയും വുദൂഅ് ചെയ്യുകയും വേണം. കുളിക്കേണ്ടതില്ല.
                        </p>
                        <x-app.hr />

                        <h6 class="text-emerald-900 fw-bold mt-3">7. പൂച്ച, എലി, പോലുള്ള</h6>
                        <p class="m-0 mb-2 text-justify" style="text-indent: 2em">
                            മാംസം ഭക്ഷ്യയോഗ്യമല്ലാത്ത എല്ലാ മൃഗങ്ങളുടെയും കാഷ്ടവും മൂത്രവും.
                        </p>
                        <x-app.hr />

                        <h6 class="text-emerald-900 fw-bold mt-3">
                            8. മൂക്കിലൂടെയും മറ്റും മനുഷ്യനിൽനിന്നു പുറപ്പെടുന്ന മോശമായ രക്തം.
                        </h6>
                    </x-app.accordion>

                    <x-app.accordion :id="'topic2'" :title="'നജസ് ശുദ്ധീകരിക്കുന്ന രീതി'" class="mb-4">
                        <h6 class="text-emerald-900 fw-bold">1. നജസ് മണ്ണിലോ ഒരു സ്ഥലത്തോ ആയാൽ:</h6>
                        <p class="m-0 mb-1 text-justify" style="text-indent: 2em">
                            അത് ശുദ്ധീകരിക്കുവാൻ നജസിനെ നീക്കുന്ന രീതിയിൽ ഒരു തവണ കഴുകിയാൽ മതിയാകും. വെള്ളം ഒരു തവണ അതിൽ
                            ഒഴിക്കുക.
                        </p>
                        <x-app.hadith-box text="ഹദീസ്." class="mb-3">
                            <x-app.ref-button slug="sahih-bukhari" number="220" type="hadith" :ref="'ബുഖാരി:220'" />
                        </x-app.hadith-box>
                        <x-app.hr />

                        <h6 class="text-emerald-900 fw-bold mt-3">
                            2. നജസ് മണ്ണിലല്ലെങ്കിൽ, അഥവാ വസ്ത്രത്തിലോ പാത്രത്തിലോ ആയാൽ:
                        </h6>
                        <p class="m-0 mb-1 text-justify" style="text-indent: 2em">
                            മൂത്രം, കാഷ്ടം, രക്തം പോലുള്ളതാണ് നജസെങ്കിൽ അത് പോകുവോളവും അടയാളം ശേഷിക്കാത്ത വിധേനയും
                            വെള്ളമുപയോഗിച്ച് ഉരച്ചു പിഴിഞ്ഞ് കഴുകണം. അത് ഒരു തവണ കഴുകിയാൽ മതിയാകും. നായ നാവിട്ടാണ്
                            നജസായതെങ്കിൽ പാത്രം ഏഴുതവണ കഴുകണം; അതിൽ ഒരു തവണ മണ്ണു ചേർത്താണ് കഴുകേണ്ടത്. ശരീരത്തിലും
                            നമസ്‌കരിക്കുന്ന സ്ഥലത്തും വസ്ത്രത്തിലുമുള്ള നജസുകളിൽനിന്ന് ശുദ്ധി വരുത്തുവാൻ ശ്രദ്ധിക്കൽ
                            മുസ്‌ലിമിനു നിർബന്ധമാണ്. കാരണം അത് നമസ്‌കാരം സാധുവാകുവാനുള്ള ശർത്വാണ്.
                        </p>
                        <x-app.hadith-box text="ഹദീസ്.">
                            <x-app.ref-button class="mb-1" slug="sahih-muslim" number="651" type="hadith"
                                :ref="'മുസ്ലിം:651'" />
                            <x-app.ref-button slug="al-tirmidhi" number="610" type="hadith" :ref="'അൽ-തിർമിധി:610'" />
                        </x-app.hadith-box>
                    </x-app.accordion>
                </div>
            </div>

            <div class="col-12 col-lg-4 mb-4 notranslate">
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

                <p class="m-0 small mb-1">
                    നിശ്ചിത സമയങ്ങളെ, ശരീഅത്ത് നിർദ്ദേശിക്കാതെ, ആരാധനയ്‌ക്കായി വേർതിരിക്കുന്നത് ബിദ്അത് ആണ്. - <em>അൽ-ഹിദായ,
                        അൽ-മബ്സൂത്</em>
                </p>

                <p class="m-0 small mb-2">
                    ഇമാം അബൂ യൂസുഫ് (d. 182H), ഇമാം മുഹമ്മദ് (d. 189H) എന്നിവരുടെ പുസ്തകങ്ങളിലോ (അഥവാ ആസാർ, ഫിഖ്ഹ് രചനകൾ) റ.
                    അ. മാസത്തെ ശ്രേഷ്ടതയെ കുറിച് രേഖപ്പെടുത്തിയിട്ടില്ല.
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
                    ഒരു കാര്യത്തെ നല്ല ബിദ്അത് എന്നും, മോശം ബിദ്അത് എന്നും പറയാം. - <em>മനാഖിബ് അൽ-ശാഫിഈ</em>
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
                    എനിക്ക് അത് ബിദ്അത് ആയി തോന്നുന്നു - <em>ഇഖ്തിദാഉൽ സിറാത്ത്</em>
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

            <div class="ref-box ref-hadith m-0 mb-3" id="ref5">
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
        document.querySelectorAll('.accordion-collapse').forEach(collapseEl => {
            collapseEl.addEventListener('shown.bs.collapse', function() {
                const header = this.previousElementSibling; // accordion-header
                header.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            });
        });

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
