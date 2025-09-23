@extends('layouts.app')

@section('content')
    <x-app.topbar :title="$questions['title']" :url="route('questions.show', ['menu_slug' => 'topics', 'module_slug' => $questions['slug']])" />

    <div class="container my-3 pb-5">
        <x-app.banner :title="$questions['chapters'][$questionSlug]" :desc="'വലിയ അശുദ്ധിയുള്ള ഒരാള്‍ക്ക് കുളി നിര്‍ബന്ധമാണ്‌.'" :search="false" :author="'Author Name'" :review="date('M d, Y') . ' by Reviewer Name'" />

        <div class="row mt-4 notranslate">
            <div class="col-12 col-lg-8">
                <div class="accordion" id="accordions">
                    <x-app.accordion :id="'topic1'" :title="'കുളി നിർബന്ധമാക്കുന്ന കാര്യങ്ങൾ'">
                        <h6 class="text-emerald-900 fw-bold">1. ജനാബത്ത് (സ്വപ്നസ്ഖലനം, ശാരീരിക ബന്ധം മുതലായ കാരണങ്ങൾ).</h6>
                        <x-app.quran-box class="mb-1"
                            text="നിങ്ങള്‍ ജനാബത്ത് (വലിയ അശുദ്ധി) ബാധിച്ചവരായാല്‍ നിങ്ങള്‍ (കുളിച്ച്‌) ശുദ്ധിയാകുക.">
                            <x-app.ref-button slug="5" number="6" type="quran" :ref="__('app.quran') . ' 5:6'" />
                        </x-app.quran-box>

                        <x-app.hadith-box class="mb-1"
                            text="ലൈംഗിക ബന്ധത്തിൽ ഏർപ്പെടുമ്പോൾ കുളി നിർബന്ധമാകും (പുരുഷനും സ്ത്രീക്കും ഒരുപോലെ).">
                            <x-app.ref-button class="mb-1" slug="sahih-bukhari" number="291" type="hadith"
                                :ref="'ബുഖാരി:291'" />
                            <x-app.ref-button slug="sahih-muslim" number="783" type="hadith" :ref="'മുസ്ലിം:783'" />
                        </x-app.hadith-box>

                        <x-app.hadith-box class="mb-3" text="സ്വപ്നസ്ഖലനം">
                            <x-app.ref-button slug="al-tirmidhi" number="113" type="hadith" :ref="'തിർമിധി:113'" />
                        </x-app.hadith-box>
                        <x-app.hr />

                        <h6 class="text-emerald-900 fw-bold mt-3">2. ഇസ്ലാം സ്വീകരിക്കൽ</h6>
                        <x-app.hadith-box class="mb-3" text="ഹദീസ്">
                            <x-app.ref-button class="mb-1" slug="abu-dawood" number="355" type="hadith"
                                :ref="'അബു ദാവൂദ്:355'" />
                            <x-app.ref-button slug="sunan-nasai" number="188" type="hadith" :ref="'അന-നസാഈ:188'" />
                        </x-app.hadith-box>
                        <x-app.hr />

                        <h6 class="text-emerald-900 fw-bold mt-3">3. ആർത്തവം (ഹൈള്)</h6>
                        <x-app.quran-box class="mb-1" text="">
                            <x-app.ref-button slug="2" number="222" type="quran" :ref="__('app.quran') . ' 2:222'" />
                        </x-app.quran-box>

                        <x-app.hadith-box class="mb-3" text="ഹദീസ്">
                            <x-app.ref-button slug="sahih-bukhari" number="228" type="hadith" :ref="'ബുഖാരി:228'" />
                        </x-app.hadith-box>
                        <x-app.hr />

                        <h6 class="text-emerald-900 fw-bold mt-3">4. പ്രസവാനന്തര രക്തസ്രാവം(നിഫാസ്)</h6>
                        <x-app.hadith-box text="ഹദീസ്">
                            <x-app.ref-button slug="sahih-bukhari" number="228" type="hadith" :ref="'ബുഖാരി:228'" />
                        </x-app.hadith-box>
                    </x-app.accordion>

                    <x-app.accordion :id="'topic2'" :title="'കുളിയുടെ രൂപം'" class="mb-4">
                        <h6 class="text-emerald-900 fw-bold">1. നീയ്യത്ത് (ഉദ്ദേശ്യം) വേണം</h6>
                        <p class="m-0 mb-1 text-justify" style="text-indent: 2em">
                            നിയ്യത്തിന്റെ സ്ഥാനം ഹൃദയമാണ്. വലിയ അശുദ്ധിയിൽ നിന്ന് ശുദ്ധിയാകുന്നതിനായി കുളിക്കുന്നുവെന്ന്
                            കരുതുക.
                        </p>

                        <x-app.hadith-box class="mb-3"
                            text="തീര്‍ച്ചയായും പ്രവര്‍ത്തനങ്ങള്‍ സ്വീകരിക്കപെടുക ഉദ്ദേശത്തിന്റെ അടിസ്ഥാനത്തിലാകുന്നു.">
                            <x-app.ref-button class="mb-1" slug="sahih-bukhari" number="1" type="hadith"
                                :ref="'ബുഖാരി:1'" />
                            <x-app.ref-button slug="sahih-muslim" number="4927" type="hadith" :ref="'മുസ്ലിം:4927'" />
                        </x-app.hadith-box>
                        <x-app.hr />

                        <h6 class="text-emerald-900 fw-bold mt-3">2. ശരീരം മുഴുവൻ വെള്ളം കൊണ്ട് കഴുകൽ</h6>
                        <x-app.quran-box class="mb-3"
                            text="നിങ്ങള്‍ ജനാബത്ത് (വലിയ അശുദ്ധി) ബാധിച്ചവരായാല്‍ നിങ്ങള്‍ (കുളിച്ച്‌) ശുദ്ധിയാകുക.">
                            <x-app.ref-button slug="5" number="6" type="quran" :ref="__('app.quran') . ' 5:6'" />
                        </x-app.quran-box>
                        <x-app.hr />

                        <h6 class="text-emerald-900 fw-bold mt-3">3. നബി ﷺ യുടെ സുന്നത്തിന്റെ അടിസ്ഥാനത്തിൽ കുളിക്കുക</h6>
                        <p class="m-0 mb-2 text-justify" style="text-indent: 2em">
                            നബി ﷺ ജനാബത്ത് കുളിക്കാൻ ഉദ്ദേശിച്ചാൽ ആദ്യം മുൻകൈകൾ കഴുകും. പിന്നീട് ഗുഹ്യസ്ഥാനം കഴുകുകയും
                            ജനാബത് കൊണ്ടുണ്ടായിട്ടുള്ളതെല്ലാം അവിടെ നിന്ന് ശുദ്ധിയാക്കുകയും ചെയ്യും. പിന്നീട്‌ പൂർണമായ
                            വുളൂഅ് എടുക്കും. ശേഷം മൂന്ന് തവണ തല കഴുകും. പിന്നീട് ശരീരത്തിന്റെ ബാക്കി ഭാഗങ്ങളും കഴുകും. അതിൽ
                            വായിൽ വെള്ളം കൊപ്ലിക്കലും, മൂക്കിൽ വെള്ളം കയറ്റി ചീറ്റലും ഉൾപ്പെടും. ഇതാണ് പൂർണമായ കുളിയുടെ
                            രൂപം.
                        </p>

                        <x-app.hadith-box text="ഹദീസ് വിശകലനങ്ങൾ.">
                            <x-app.ref-button class="mb-1" slug="sahih-bukhari" number="274" type="hadith"
                                :ref="'ബുഖാരി:274'" />
                            <x-app.ref-button slug="sahih-muslim" number="722" type="hadith" :ref="'മുസ്ലിം:722'" />
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
