@extends('layouts.app')

@section('content')
    <x-app.topbar :title="$questions['title']" :url="route('questions.show', ['menu_slug' => 'topics', 'module_slug' => $questions['slug']])" />

    <div class="container my-3 pb-5">
        <x-app.banner :title="$questions['chapters'][$questionSlug]" :desc="'വെള്ളം ലഭിച്ചില്ലെങ്കിലോ വെള്ളം ഉപയോഗിക്കാന്‍ കഴിയാത്ത സാഹചര്യമാണെങ്കിലോ തയമ്മും ചെയ്ത് ശുദ്ധിവരുതാം.'" :search="false" :author="'Author Name'" :review="date('M d, Y') . ' by Reviewer Name'" />

        <div class="row mt-4 notranslate">
            <div class="col-12 col-lg-8">
                <div class="accordion" id="accordions">
                    <x-app.accordion :id="'topic1'" :title="'എന്താണ് തയമ്മും'">
                        <p class="m-0 mb-1 text-justify" style="text-indent: 2em">
                            അശുദ്ധി അകറ്റാനുള്ള നിയ്യത്തോടെ മുഖവും കൈയ്യും തടവുന്നതിനായി ശുദ്ധമായ മണ്ണിനെ
                            ലക്ഷ്യംവെച്ചുകൊണ്ട് ചെയ്യുന്ന ആരാധനക്കാണ് മതത്തില്‍ തയമ്മും എന്ന് പറയുന്നത്. അതായത്, വെള്ളം
                            ലഭിക്കാതിരിക്കുകയോ ഉപയോഗിക്കുന്നതിന് തടസ്സമുണ്ടാകുകയോ ചെയ്യുന്ന അവസരത്തില്‍ കുളിക്കും
                            വുളൂഇനും പകരമായി നി൪വ്വഹിക്കപ്പെടുന്ന ശുദ്ധീകരണ രൂപമാണ് തയമ്മും.
                        </p>
                        <x-app.quran-box class="mb-1"
                            text="നിങ്ങള്‍ക്ക് വെള്ളം കിട്ടിയില്ലെങ്കില്‍ ശുദ്ധമായ ഭൂമുഖം തേടിക്കൊള്ളുക. എന്നിട്ട് അതുകൊണ്ട് നിങ്ങളുടെ മുഖവും കൈകളും തടവുക.">
                            <x-app.ref-button class="mb-1" slug="5" number="6" type="quran"
                                :ref="__('app.quran') . ' 5:6'" />
                            <x-app.ref-button slug="4" number="43" type="quran" :ref="__('app.quran') . ' 4:43'" />
                        </x-app.quran-box>

                        <x-app.hadith-box text="ശുദ്ധമായ മണ്ണുകൊണ്ട് തയമ്മും ചെയ്യുക, അത് നിങ്ങൾക്ക് മതിയാകും.">
                            {{-- <x-app.ref-button class="mb-1" slug="sahih-bukhari" number="334" type="hadith"
                                :ref="'ബുഖാരി:334'" />
                            <x-app.ref-button slug="sahih-bukhari" number="335" type="hadith" :ref="'ബുഖാരി:335'" /> --}}
                            <x-app.ref-button slug="sahih-bukhari" number="348" type="hadith" :ref="'ബുഖാരി:348'" />
                        </x-app.hadith-box>
                    </x-app.accordion>

                    <x-app.accordion :id="'topic2'" :title="'തയമ്മും അനുവദനീയമാകുന്നത്'">
                        <h6 class="text-emerald-900 fw-bold">1. വെള്ളം കിട്ടിയില്ലെങ്കില്‍</h6>
                        <x-app.quran-box class="mb-3"
                            text="നിങ്ങള്‍ക്ക് വെള്ളം കിട്ടിയില്ലെങ്കില്‍ ശുദ്ധമായ ഭൂമുഖം തേടിക്കൊള്ളുക. എന്നിട്ട് അതുകൊണ്ട് നിങ്ങളുടെ മുഖവും കൈകളും തടവുക.">
                            <x-app.ref-button class="mb-1" slug="5" number="6" type="quran"
                                :ref="__('app.quran') . ' 5:6'" />
                            <x-app.ref-button slug="4" number="43" type="quran" :ref="__('app.quran') . ' 4:43'" />
                        </x-app.quran-box>
                        <x-app.hr />

                        <h6 class="text-emerald-900 fw-bold mt-3">2. ശരീരത്തില്‍ മുറിവോ രോഗമോ ഉണ്ട്.</h6>
                        <p class="m-0 mb-1 text-justify" style="text-indent: 2em">
                            വെള്ളം ഉപയോഗിച്ചാല്‍ രോഗം മൂ൪ച്ഛിക്കാനും ശമനം വൈകാനും സാധ്യതയുണ്ട്.
                        </p>
                        <x-app.quran-box class="mb-1" text="നിങ്ങള്‍ രോഗികളാകുകയോ ചെയ്താല്‍,">
                            <x-app.ref-button slug="5" number="6" type="quran" :ref="__('app.quran') . ' 5:6'" />
                        </x-app.quran-box>

                        <x-app.hadith-box text="ഹദീസ്." class="mb-3 border-danger">
                            <x-app.ref-button slug="abu-dawood" number="336" type="hadith" :ref="'അബു ദാവൂദ്:336'" />
                        </x-app.hadith-box>
                        <x-app.hr />

                        <h6 class="text-emerald-900 fw-bold mt-3">3. വെള്ളം ശക്തമായ തണുപ്പുള്ളതാണ്.</h6>
                        <p class="m-0 mb-2 text-justify" style="text-indent: 2em">
                            ഉപയോഗിച്ചാല്‍ അപകട സാധ്യതയുണ്ട്. ചൂടാക്കിയോ മറ്റോ വെള്ളത്തിന്റെ തണുപ്പ് കുറക്കാന്‍
                            കഴിയുന്നില്ല.
                        </p>

                        <x-app.hadith-box text="ഹദീസ്." class="mb-3">
                            <x-app.ref-button slug="abu-dawood" number="334" type="hadith" :ref="'അബു ദാവൂദ്:334'" />
                        </x-app.hadith-box>
                        <x-app.hr />

                        <h6 class="text-emerald-900 fw-bold mt-3">4. ദാഹം ഭയന്നാല്‍ വെള്ളം സൂക്ഷിച്ച് വെക്കുകയും തയമ്മും
                            ചെയ്യുകയും ചെയ്യാം.</h6>
                        <p class="m-0 mb-1 text-justify" style="text-indent: 2em">
                            യാത്രക്കാരന്റെ കൈയ്യില്‍ വെള്ളമുണ്ട്. പക്ഷേ, അത് ഉപയോഗിച്ചാല്‍ പിന്നീട് കുടിക്കാന്‍
                            വെള്ളമില്ലാതായി തീരുമെന്ന് ഭയമുണ്ടെങ്കില്‍ വെള്ളം സൂക്ഷിച്ചുവെച്ച് തയമ്മും ചെയ്യാം.
                        </p>
                        <x-app.quran-box class="mb-3" text="നിങ്ങള്‍ യാത്രയിലാകുകയോ ചെയ്താല്‍,">
                            <x-app.ref-button slug="5" number="6" type="quran" :ref="__('app.quran') . ' 5:6'" />
                        </x-app.quran-box>
                        <x-app.hr />

                        <h6 class="text-emerald-900 fw-bold mt-3">5. വെള്ളം ഉണ്ട്. എന്നാല്‍ വുളൂഇനോ കുളിക്കോ അത് തികയില്ല.
                        </h6>
                        <p class="m-0 mb-2 text-justify" style="text-indent: 2em">
                            ഉള്ള വെള്ളം കൊണ്ട് വുളൂഅ് എടുക്കുക. വുളൂഅ് പൂ൪ത്തിയാകാത്ത ഭാഗത്തിന് വേണ്ടി തയമ്മും ചെയ്യുക.
                        </p>

                        <x-app.quran-box class="mb-1"
                            text="നിങ്ങള്‍ക്ക് സാധ്യമായ പ്രകാരം നിങ്ങള്‍ അല്ലാഹുവിനെ സൂക്ഷിക്കുവിന്‍">
                            <x-app.ref-button slug="64" number="16" type="quran" :ref="__('app.quran') . ' 64:16'" />
                        </x-app.quran-box>

                        <x-app.hadith-box
                            text="ഞാന്‍ നിങ്ങളോട് ഒരു കാര്യം കല്‍പ്പിച്ചാല്‍ അതില്‍ നിന്ന് നിങ്ങളാല്‍ കഴിയുന്നത് നിങ്ങള്‍ ചെയ്യുക.">
                            <x-app.ref-button slug="sahih-bukhari" number="7288" type="hadith" :ref="'ബുഖാരി:7288'" />
                        </x-app.hadith-box>
                    </x-app.accordion>

                    <x-app.accordion :id="'topic3'" :title="'തയമ്മുമിന്റെ രൂപം'">
                        <h6 class="text-emerald-900 fw-bold">1. നീയ്യത്ത് (ഉദ്ദേശ്യം) വേണം</h6>
                        <p class="m-0 mb-1 text-justify" style="text-indent: 2em">
                            നിയ്യത്തിന്റെ സ്ഥാനം ഹൃദയമാണ്. ഏത് അശുദ്ധിയെ നീക്കാനാണോ തയമ്മും ചെയ്യുന്നത് അത് മനസ്സില്‍
                            കരുതുക.
                        </p>

                        <x-app.hadith-box class="mb-3"
                            text="തീര്‍ച്ചയായും പ്രവര്‍ത്തനങ്ങള്‍ സ്വീകരിക്കപെടുക ഉദ്ദേശത്തിന്റെ അടിസ്ഥാനത്തിലാകുന്നു.">
                            <x-app.ref-button class="mb-1" slug="sahih-bukhari" number="1" type="hadith"
                                :ref="'ബുഖാരി:1'" />
                            <x-app.ref-button slug="sahih-muslim" number="4927" type="hadith" :ref="'മുസ്ലിം:4927'" />
                        </x-app.hadith-box>
                        <x-app.hr />

                        <h6 class="text-emerald-900 fw-bold mt-3">2. ബിസ്മില്ലാഹ് ചൊല്ലൽ</h6>
                        <x-app.hadith-box text="അല്ലാഹുവിന്റെ നാമം ഉച്ചരിക്കാത്തവന്റെ വുദു സാധുവല്ല." class="mb-3">
                            <x-app.ref-button slug="abu-dawood" number="101" type="hadith" :ref="'അബു ദാവൂദ്:101'" />
                        </x-app.hadith-box>
                        <x-app.hr />

                        <h6 class="text-emerald-900 fw-bold mt-3">3. പൂർണ്ണ രൂപം </h6>
                        <p class="m-0 mb-2 text-justify" style="text-indent: 2em">
                            വിരലുകള്‍ നിവ൪ത്തി പിടിച്ച് ഉള്ളം കൈകള്‍ കൊണ്ട് ശുദ്ധിയുള്ള മണ്ണില്‍ ഒരു തവണ അടിക്കുകയും ഉള്ളം
                            കൈകള്‍ കൊണ്ട് മുഖം തടവുകയും പിന്നീട് മുന്‍കൈകളുടെ പുറം ഭാഗം തടവുകയും ചെയ്യുക. അതായത് ആദ്യം
                            ഇടത്തേ ഉള്ളംകൈ കൊണ്ട് വലത്തേ മുന്‍കൈയ്യിന്റെ പുറം ഭാഗവും പിന്നെ വലത്തേ ഉള്ളംകൈ കൊണ്ട് ഇടത്തേ
                            മുന്‍കൈയ്യിന്റെ പുറം ഭാഗവും തടവുക. വിരലറ്റം മുതല്‍ മണികണ്ഠം ഉള്‍പ്പടെ തടവുക.
                        </p>

                        <x-app.hadith-box text="ഹദീസ്.">
                            <x-app.ref-button class="mb-1" slug="sahih-bukhari" number="338" type="hadith"
                                :ref="'ബുഖാരി:338'" />
                            <x-app.ref-button class="mb-1" slug="sahih-bukhari" number="338" type="hadith"
                                :ref="'ബുഖാരി:339'" />
                            <x-app.ref-button slug="sahih-muslim" number="818" type="hadith" :ref="'മുസ്ലിം:818'" />
                        </x-app.hadith-box>
                    </x-app.accordion>

                    <x-app.accordion :id="'topic4'" :title="'തയമ്മും മുറിയുന്ന കാര്യങ്ങള്‍'" class="mb-4">
                        <h6 class="text-emerald-900 fw-bold">
                            1. വുളൂഅ് മുറിയുന്ന കാര്യങ്ങളില്‍ എന്തെങ്കിലും ഉണ്ടാകല്‍
                        </h6>
                        <p class="m-0 mb-3 text-justify" style="text-indent: 2em">
                            മുന്‍പിന്‍ ദ്വാരങ്ങളിലൂടെ കാഷ്ഠം, മൂത്രം പോലെയുള്ള വല്ലതും പുറപ്പെടല്‍. കീഴ്വായു പുറപ്പെടൽ.
                            ഗാഡമായ ഉറങ്ങിപ്പോകുക. ബോധം നശിക്കല്‍. ലൈംഗീകാവയവങ്ങള്‍ സ്പര്‍ശിക്കല്‍. ഒട്ടകത്തിന്റെ മാംസം
                            ഭക്ഷിക്കല്‍. ഇസ്‌ലാം മതം ഉപേക്ഷിക്കല്‍.
                        </p>
                        <x-app.hr />

                        <h6 class="text-emerald-900 fw-bold mt-3">2. വെള്ളം ലഭിക്കാത്തയാള്‍ക്ക് അത് ലഭിക്കല്‍</h6>
                        <p class="m-0 mb-1 text-justify" style="text-indent: 2em">
                            വെള്ളം ഉപയോഗിക്കാന്‍ ഉണ്ടായിരുന്ന തടസ്സം നീങ്ങല്‍, വെള്ളം ലഭിക്കാത്തയാള്‍ക്ക് അത് ലഭിക്കല്‍.
                        </p>
                        <x-app.hadith-box text="ഹദീസ്">
                            <x-app.ref-button class="mb-1" slug="abu-dawood" number="332" type="hadith" :ref="'അബു ദാവൂദ്:332'" />
                            <x-app.ref-button slug="abu-dawood" number="338" type="hadith" :ref="'അബു ദാവൂദ്:338'" />
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
