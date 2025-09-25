@extends('layouts.app')

@section('content')
    <x-app.topbar :title="$questions['title']" :url="route('questions.show', ['menu_slug' => 'topics', 'module_slug' => $questions['slug']])" />

    <div class="container my-3 pb-5">
        <x-app.banner :title="$questions['chapters'][$questionSlug]" :desc="'ആദമിന്റെ പെണ്‍മക്കള്‍ക്ക് അല്ലാഹു നിശ്ചയിച്ച കാര്യമാണ് ആര്‍ത്തവം. <em>- ബുഖാരി:294</em>'" :search="false" :author="'Author Name'"
            :review="date('M d, Y').
            ' by Reviewer Name'" />

        <div class="row mt-4 notranslate">
            <div class="col-12 col-lg-8">
                <div class="accordion" id="accordions">
                    <x-app.accordion :id="'topic1'" :title="'ഹയ്ദ് & നിഫാസ്'">
                        <p class="m-0 mb-1 text-justify" style="text-indent: 2em">
                            ഹയ്ദ് (ആർത്തവരക്തം), നിഫാസ് (പ്രസവരക്തം) എന്നിവ സ്ത്രീകളിലുണ്ടാകുന്ന ജൈവിക പ്രതിഭാസമാണ്.
                            പ്രസവകാരണത്താലല്ലാതെ അരോഗാവസ്ഥയിൽ നിർണിത സമയങ്ങളിലായി സ്ത്രീയുടെ ഗർഭപാത്രത്തിനുള്ളിൽനിന്നു
                            പുറപ്പെടുന്ന നൈസർഗികരക്തമാണ് മതത്തിന്റെ സാങ്കേതിക ഭാഷ്യത്തിൽ ഹയ്ദ്. പ്രസവവേളയിൽ സ്ത്രീയിൽനിന്നു
                            പുറപ്പെടുന്ന രക്തമാണ് നിഫാസ്.
                        </p>
                        <p class="m-0 mb-1 text-justify" style="text-indent: 2em">
                            സ്ത്രീകളില്‍, അവരുടെ പ്രത്യുല്പാദനത്തിന്‍റെ ഭാഗമായി നടക്കുന്ന ഒരു സ്വാഭാവിക പ്രക്രിയയാണ്‌
                            ആര്‍ത്തവം. പ്രായപൂര്‍ത്തിയാകുന്ന കാലം തൊട്ട്, ആര്‍ത്തവ വിരാമം വരെ ഏകദേശം എല്ലാ മാസവും ഇത്
                            സംഭവിക്കുന്നു.
                        </p>
                        <p class="m-0 text-justify" style="text-indent: 2em">
                            പൊതുവിൽ ഒമ്പത് വയസ്സാകുന്നതിനു മുമ്പ് ആർത്തവമില്ല. അതിനു മുമ്പ് ഉണ്ടാകുന്നത് വളരെ അത്യപൂർവമാണ്.
                            ശരിയായ അഭിപ്രായപ്രകാരം അമ്പതു വയസ്സിനുശേഷം മിക്കവാറും ആർത്തവമുണ്ടാവുകയില്ല.
                        </p>
                    </x-app.accordion>

                    <x-app.accordion :id="'topic2'" :title="'ആർത്തവ സംബന്ധമായ വിധി വിലക്കുകൾ'" class="mb-4">
                        <h6 class="text-emerald-900 fw-bold">1. നമസ്കാരം</h6>
                        <p class="m-0 mb-1 text-justify" style="text-indent: 2em">
                            ആർത്തവകാരി നമസ്കരിക്കാൻ പാടില്ല, നിർബന്ധമായതും ഐച്ഛികമായതും. നമസ്കരിച്ചാൽ അത് സ്വീകാര്യവും അല്ല.
                            അവള്‍ ഈ അവസ്ഥയില്‍ നിന്നും ശുദ്ധി കൈവരിച്ചാല്‍ ഒഴിവാക്കിയ നമസ്‌കാരം നമസ്‌കരിച്ചു വീട്ടേണ്ടതില്ല.
                        </p>
                        <x-app.hadith-box text="ഹദീസ്." class="mb-3">
                            <x-app.ref-button slug="sahih-bukhari" number="1951" type="hadith" :ref="'ബുഖാരി:1951'" />
                        </x-app.hadith-box>
                        <x-app.hr />

                        <h6 class="text-emerald-900 fw-bold mt-3">2. നോമ്പ്</h6>
                        <p class="m-0 mb-1 text-justify" style="text-indent: 2em">
                            ആർത്തവകാരി നോമ്പ് അനുഷ്ഠിക്കാൻ പാടില്ല, നിർബന്ധമായതും ഐച്ഛികമായതും. നോമ്പ് അനുഷ്ഠിച്ചാൽ അത്
                            സ്വീകാര്യവും അല്ല. എന്നാൽ നിര്‍ബന്ധ നോമ്പ് മറ്റൊരവസരത്തിൽ നോറ്റ് വീട്ടണം.
                        </p>
                        <x-app.hadith-box text="ഹദീസ്." class="mb-3">
                            <x-app.ref-button slug="ibn-e-majah" number="1670" type="hadith" :ref="'ഇബ്‍ൻ മാജഹ്:1670'" />
                        </x-app.hadith-box>
                        <x-app.hr />

                        <h6 class="text-emerald-900 fw-bold mt-3">3. ത്വവാഫ്</h6>
                        <p class="m-0 mb-1 text-justify" style="text-indent: 2em">
                            ആർത്തവകാരി ത്വവാഫ് ചെയ്യാൻ പാടില്ല, നിർബന്ധമായതും ഐച്ഛികമായതും. ത്വവാഫ് ചെയ്താൽ അത് സ്വീകാര്യവും
                            അല്ല.
                        </p>
                        <x-app.hadith-box text="ഹദീസ്." class="mb-3">
                            <x-app.ref-button slug="sahih-bukhari" number="294" type="hadith" :ref="'ബുഖാരി:294'" />
                        </x-app.hadith-box>
                        <x-app.hr />

                        <h6 class="text-emerald-900 fw-bold mt-3">4. പള്ളിയിൽ പ്രവേശിക്കലും താമസിക്കലും</h6>
                        <p class="m-0 mb-1 text-justify" style="text-indent: 2em">
                            ആർത്തവകാരി ത്വവാഫ് ചെയ്യാൻ പാടില്ല, നിർബന്ധമായതും ഐച്ഛികമായതും. ത്വവാഫ് ചെയ്താൽ അത് സ്വീകാര്യവും
                            അല്ല.
                        </p>
                        <x-app.hadith-box text="ഹദീസ്." class="mb-3">
                            <x-app.ref-button class="mb-1" slug="abu-dawood" number="232" type="hadith"
                                :ref="'അബൂ ദാവൂദ്:232'" />
                            <x-app.ref-button slug="ibn-e-majah" number="645" type="hadith" :ref="'ഇബ്‍ൻ മാജഹ്:645'" />
                        </x-app.hadith-box>
                        <x-app.hr />

                        <h6 class="text-emerald-900 fw-bold mt-3">5. ലൈംഗിക വേഴ്ച</h6>
                        <p class="m-0 mb-1 text-justify" style="text-indent: 2em">
                            ആർത്തവകാരിയുമായി ഭർത്താവ് ലൈംഗിക ബന്ധത്തിൽ ഏര്‍പ്പെടുന്നത് നിഷിദ്ധമാണ്. ഭർത്താവിൻറെ ആവശ്യത്തിന്
                            അവൾ വഴങ്ങാനും പാടില്ല.
                        </p>
                        <x-app.quran-box class="mb-1"
                            text="അതൊരു മാലിന്യമാകുന്നു. അതിനാല്‍ ആര്‍ത്തവഘട്ടത്തില്‍ നിങ്ങള്‍ സ്ത്രീകളില്‍ നിന്ന് അകന്നു നില്‍ക്കേണ്ടതാണ്‌. അവര്‍ ശുദ്ധിയാകുന്നത് വരെ അവരെ സമീപിക്കുവാന്‍ പാടില്ല.">
                            <x-app.ref-button slug="2" number="222" type="quran" :ref="__('app.quran') . ' 2:222'" />
                        </x-app.quran-box>
                        <x-app.hadith-box text="ഹദീസ്." class="mb-3">
                            <x-app.ref-button class="mb-1" slug="sahih-bukhari" number="295" type="hadith"
                                :ref="'ബുഖാരി:295'" />
                            <x-app.ref-button class="mb-1" slug="sahih-bukhari" number="297" type="hadith"
                                :ref="'ബുഖാരി:297'" />
                            <x-app.ref-button slug="sahih-bukhari" number="302" type="hadith" :ref="'ബുഖാരി:302'" />
                        </x-app.hadith-box>
                        <x-app.hr />

                        <h6 class="text-emerald-900 fw-bold mt-3">6. ത്വലാഖ്</h6>
                        <p class="m-0 mb-1 text-justify" style="text-indent: 2em">
                            ആർത്തവകാരിയുമായി ഭർത്താവ് ലൈംഗിക ബന്ധത്തിൽ ഏര്‍പ്പെടുന്നത് നിഷിദ്ധമാണ്. ഭർത്താവിൻറെ ആവശ്യത്തിന്
                            അവൾ വഴങ്ങാനും പാടില്ല.
                        </p>
                        <x-app.quran-box class="mb-1" text="">
                            <x-app.ref-button slug="65" number="1" type="quran" :ref="__('app.quran') . ' 65:1'" />
                        </x-app.quran-box>
                        <x-app.hadith-box text="ഹദീസ്." class="mb-3">
                            <x-app.ref-button slug="sahih-bukhari" number="5251" type="hadith" :ref="'ബുഖാരി:5251'" />
                        </x-app.hadith-box>
                        <x-app.hr />

                        <h6 class="text-emerald-900 fw-bold mt-3">
                            7. ആര്‍ത്തവ സമയത്ത് നഖവും മുടിയും നീക്കം ചെയ്യുന്നത് തെറ്റാണോ?
                        </h6>
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
