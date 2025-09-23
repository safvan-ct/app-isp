@extends('layouts.app')

@section('content')
    <x-app.topbar :title="$questions['title']" :url="route('questions.show', ['menu_slug' => 'topics', 'module_slug' => $questions['slug']])" />

    <div class="container my-3 pb-5">
        <x-app.banner :title="$questions['chapters'][$questionSlug]" :desc="'വുദൂ നമസ്‌കാരത്തിന് തയ്യാറെടുക്കുന്നതിനും ചെറിയ അശുദ്ധിയിൽ നിന്ന് ശുദ്ധിയാകുന്നതിനും വേണ്ടിയുള്ളതാണ്.'" :search="false" :author="'Author Name'" :review="date('M d, Y') . ' by Reviewer Name'" />

        <div class="row mt-4 notranslate">
            <div class="col-12 col-lg-8">
                <div class="accordion" id="accordions">
                    <x-app.accordion :id="'topic1'" :title="'വുദു നിർബന്ധമാക്കുന്ന കാര്യങ്ങൾ'">
                        <h6 class="text-emerald-900 fw-bold">1. നമസ്കാരം</h6>
                        <x-app.quran-box class="mb-1"
                            text="നിങ്ങള്‍ നമസ്കാരത്തിന് ഒരുങ്ങിയാല്‍, നിങ്ങളുടെ മുഖങ്ങളും, മുട്ടുവരെ രണ്ടുകൈകളും കഴുകുകയും, നിങ്ങളുടെ തല തടവുകയും നെരിയാണിവരെ രണ്ട് കാലുകള്‍ കഴുകുകയും ചെയ്യുക">
                            <x-app.ref-button slug="5" number="6" type="quran" :ref="__('app.quran') . ' 5:6'" />
                        </x-app.quran-box>

                        <x-app.hadith-box class="mb-3"
                            text="ചെറിയ അശുദ്ധിയായവരില്‍ നിന്നും വുളു ചെയ്യുന്നതുവരെ നമസ്കാരം സ്വീകരിക്കപ്പെടുകയില്ല.">
                            <x-app.ref-button class="mb-1" slug="sahih-bukhari" number="135" type="hadith"
                                :ref="'ബുഖാരി:135'" />
                            <x-app.ref-button class="mb-1" slug="sahih-bukhari" number="6954" type="hadith"
                                :ref="'ബുഖാരി:6954'" />
                            <x-app.ref-button class="mb-1" slug="sahih-muslim" number="535" type="hadith"
                                :ref="'മുസ്ലിം:535'" />
                            <x-app.ref-button slug="sahih-muslim" number="537" type="hadith" :ref="'മുസ്ലിം:537'" />
                        </x-app.hadith-box>
                        <x-app.hr />

                        <h6 class="text-emerald-900 fw-bold mt-3">2. കഅ്ബക്ക് ചുറ്റും ത്വവാഫ്</h6>
                        <x-app.hadith-box class="mb-3" text="ശുദ്ധിയാകുന്നതുവരെ കഅ്ബയിലെ ത്വവാഫ് ചെയ്യരുത്.">
                            <x-app.ref-button slug="sahih-bukhari" number="1650" type="hadith" :ref="'ബുഖാരി:1650'" />
                        </x-app.hadith-box>
                        <x-app.hr />

                        <h6 class="text-emerald-900 fw-bold mt-3">3. ഖുർആൻ സ്പർശിക്കൽ</h6>
                        <x-app.quran-box class="mb-1" text="പരിശുദ്ധി നല്‍കപ്പെട്ടവരല്ലാതെ അത് സ്പര്‍ശിക്കുകയില്ല.">
                            <x-app.ref-button class="mb-1" slug="56" number="77" type="quran"
                                :ref="__('app.quran') . ' 56:77'" />
                            <x-app.ref-button class="mb-1" slug="56" number="78" type="quran"
                                :ref="__('app.quran') . ' 56:78'" />
                            <x-app.ref-button slug="56" number="79" type="quran" :ref="__('app.quran') . ' 56:79'" />
                        </x-app.quran-box>
                    </x-app.accordion>

                    <x-app.accordion :id="'topic2'" :title="'വുദുവിന്റെ നിബന്ധനകൾ (ശർത്ത്)'">
                        <h6 class="text-emerald-900 fw-bold">1. മുസ്ലിം ആയിരിക്കണം</h6>
                        <x-app.quran-box class="mb-3" text="ഖുർആൻ വിശകലനങ്ങൾ">
                            <x-app.ref-button slug="18" number="30" type="quran" :ref="__('app.quran') . ' 18:30'" />
                        </x-app.quran-box>
                        <x-app.hr />

                        <h6 class="text-emerald-900 fw-bold mt-3">2. ബുദ്ധിയുള്ളവൻ ആയിരിക്കണം</h6>
                        <p class="m-0 mb-2 text-justify" style="text-indent: 2em">
                            മൂന്ന് ആളുകളില്‍ നിന്ന് അവരുടെ പ്രവൃത്തികൾ രേഖപ്പെടുത്തിയിട്ടില്ല: 1) ബുദ്ധിഭ്രമം ബാധിച്ചവന്‍,
                            അവന് സ്വബോധം ഉണ്ടാകുന്നതുവരെ 2) ഉറങ്ങുന്നവ൪, ഉണരുന്നതുവരെ 3) ചെറിയ കുട്ടി
                            പ്രായപൂ൪ത്തിയാകുന്നതുവരെ.
                        </p>

                        <x-app.hadith-box text="ഹദീസ് വിശകലനങ്ങൾ." class="mb-3">
                            <x-app.ref-button class="mb-1" slug="al-tirmidhi" number="1423" type="hadith"
                                :ref="'തിർമിധി:1423'" />
                            <x-app.ref-button class="mb-1" slug="abu-dawood" number="4401" type="hadith"
                                :ref="'അബു ദാവൂദ്:4401'" />
                            <x-app.ref-button slug="abu-dawood" number="4403" type="hadith" :ref="'അബു ദാവൂദ്:4403'" />
                        </x-app.hadith-box>
                        <x-app.hr />

                        <h6 class="text-emerald-900 fw-bold mt-3">3. നീയ്യത്ത് (ഉദ്ദേശ്യം) വേണം</h6>
                        <p class="m-0 mb-1 text-justify" style="text-indent: 2em">
                            വുളൂഇന് മുന്‍പ് നിയ്യത് ഉണ്ടായിരിക്കണം. നിയ്യത്തിന്റെ സ്ഥാനം ഹൃദയമാണ്. ഉദ്ദേശക്കുക എന്നതാണ്
                            നിയ്യത്തിന്റെ ഭാഷാ൪ത്ഥം. മനസ്സില്‍ ഒരു കാര്യം തീരുമാനിക്കലാണ് നിയ്യത്ത്. അശ്രദ്ധമായോ
                            മറ്റെന്തെങ്കിലും ചിന്തയോടെയോ മറ്റാരാടെങ്കിലും സംസാരിച്ചുകൊണ്ടോ വുളൂഅ് ചെയ്യുന്നത് ശരിയല്ല.
                            വുളൂഇന്റെ ആദ്യാവസാനം വുളൂഅ് ചെയ്യുകയാണെന്ന ബോധ്യം ഉണ്ടാകണം.
                        </p>

                        <x-app.hadith-box class="mb-3"
                            text="തീര്‍ച്ചയായും പ്രവര്‍ത്തനങ്ങള്‍ സ്വീകരിക്കപെടുക ഉദ്ദേശത്തിന്റെ അടിസ്ഥാനത്തിലാകുന്നു.">
                            <x-app.ref-button class="mb-1" slug="sahih-bukhari" number="1" type="hadith"
                                :ref="'ബുഖാരി:1'" />
                            <x-app.ref-button slug="sahih-muslim" number="4927" type="hadith" :ref="'മുസ്ലിം:4927'" />
                        </x-app.hadith-box>
                        <x-app.hr />

                        <h6 class="text-emerald-900 fw-bold mt-3">4. ശുദ്ധജലം ഉപയോഗിക്കണം</h6>
                        <x-app.hadith-box
                            text="കിണറ്റിലെ വെള്ളം, മഴവെള്ളം, സംസം വെള്ളം, നദികളില വെള്ളം, കടല്‍ വെള്ളം എന്നിവയൊക്കെ വുളൂഇന്  ഉപയോഗിക്കാം.">
                            <x-app.ref-button class="mb-1" slug="sunan-nasai" number="326" type="hadith"
                                :ref="'അന-നസാഈ:326'" />
                            <x-app.ref-button slug="sunan-nasai" number="327" type="hadith" :ref="'അന-നസാഈ:327'" />
                        </x-app.hadith-box>
                    </x-app.accordion>

                    <x-app.accordion :id="'topic3'" :title="'വുദുവിന്റെ ഫർദ് (അത്യാവശ്യ ഘടകങ്ങൾ)'">
                        <h6 class="text-emerald-900 fw-bold">1. മുഖം കഴുകല്‍</h6>
                        <p class="m-0 mb-2 text-justify" style="text-indent: 2em">
                            സാധാരണ തലയിൽ മുടി മുളക്കുന്ന ഭാഗം മുതൽ താടിയെല്ലിന്റെ താഴ്ഭാഗം വരെ നീളത്തിലും രണ്ട്
                            ചെവിക്കുറ്റികള്‍ക്കിടയിൽ വീതിയിലും ഒരു പ്രാവശ്യം കഴുകൽ.
                        </p>
                        <x-app.quran-box class="mb-1"
                            text="നിങ്ങള്‍ നമസ്കാരത്തിന് ഒരുങ്ങിയാല്‍, നിങ്ങളുടെ മുഖങ്ങൾ കഴുകുക.">
                            <x-app.ref-button slug="5" number="6" type="quran" :ref="__('app.quran') . ' 5:6'" />
                        </x-app.quran-box>

                        <x-app.hadith-box text="വായിൽ വെള്ളം കൊള്ളലും മൂക്കിൽ വെള്ളം കയറ്റി ചീറ്റലും." class="mb-3">
                            <x-app.ref-button class="mb-1" slug="sahih-muslim" number="560" type="hadith"
                                :ref="'മുസ്ലിം:560'" />
                            <x-app.ref-button slug="abu-dawood" number="144" type="hadith" :ref="'അബു ദാവൂദ്:144'" />
                        </x-app.hadith-box>
                        <x-app.hr />

                        <h6 class="text-emerald-900 fw-bold mt-3">2. ഇരു കൈയ്യുകളും മുട്ടുകൾ ഉൾപ്പെടുത്തി കഴുകുക</h6>
                        <p class="m-0 mb-2 text-justify" style="text-indent: 2em">
                            വിരലുകളുടെ അറ്റം മുതല്‍ രണ്ട്‌ കൈകളും മുട്ടുകള്‍ ഉള്‍പ്പെടുത്തി കഴുകുക.
                        </p>
                        <x-app.quran-box class="mb-1" text="മുട്ടുവരെ രണ്ടുകൈകളും കഴുകുക.">
                            <x-app.ref-button slug="5" number="6" type="quran" :ref="__('app.quran') . ' 5:6'" />
                        </x-app.quran-box>

                        <x-app.hadith-box text="പിന്നീട് വലതു കൈ മുകൾഭാഗം വരെ കഴുകി, പിന്നീട് ഇടതു കൈ മുകൾഭാഗം വരെ കഴുകി."
                            class="mb-3">
                            <x-app.ref-button slug="sahih-muslim" number="579" type="hadith" :ref="'മുസ്ലിം:579'" />
                        </x-app.hadith-box>
                        <x-app.hr />

                        <h6 class="text-emerald-900 fw-bold mt-3">3. തല തടവൽ</h6>
                        <p class="m-0 mb-2 text-justify" style="text-indent: 2em">
                            കൈകള്‍ വെള്ളത്തില്‍ മുക്കി തലതടവുക. തല കഴുകരുത്‌.
                        </p>
                        <x-app.quran-box class="mb-1" text="നിങ്ങളുടെ തല തടവുകയും ചെയ്യുക.">
                            <x-app.ref-button slug="5" number="6" type="quran" :ref="__('app.quran') . ' 5:6'" />
                        </x-app.quran-box>

                        <x-app.hadith-box class="mb-3"
                            text="പിന്നെ കൈകൾ കൊണ്ട് തല തുടച്ചു, മുന്നോട്ടും പിന്നോട്ടും ചലിപ്പിച്ചു. തലയുടെ മുൻഭാഗത്തു നിന്ന് തുടങ്ങി തലയുടെ പിൻഭാഗം വരെ ചലിപ്പിച്ചു.">
                            <x-app.ref-button slug="sahih-bukhari" number="185" type="hadith" :ref="'ബുഖാരി:185'" />
                        </x-app.hadith-box>
                        <x-app.hr />

                        <h6 class="text-emerald-900 fw-bold mt-3">4. രണ്ടുകാലുകളും നെരിയാണികള്‍ ഉള്‍പ്പെടുത്തി കഴുകല്‍</h6>
                        <p class="m-0 mb-2 text-justify" style="text-indent: 2em">
                            വിരലിന്റെ അറ്റം മുതൽ നെരിയാണി വരെയാണ് കഴുകേണ്ടത്. കഴുകുമ്പോള്‍ മേല്‍ ഭാഗവും അടിഭാഗവും കഴുകണം.
                            നെരിയാണിയും കഴുകേണ്ടതുണ്ട്.
                        </p>
                        <x-app.quran-box class="mb-1" text="നെരിയാണിവരെ രണ്ട് കാലുകള്‍ കഴുകുകയും ചെയ്യുക.">
                            <x-app.ref-button slug="5" number="6" type="quran" :ref="__('app.quran') . ' 5:6'" />
                        </x-app.quran-box>

                        <x-app.hadith-box text="വലതു കാൽ കണങ്കാൽ വരെ മൂന്ന് തവണ കഴുകി, തുടർന്ന് ഇടതു കാൽ അങ്ങനെ കഴുകി."
                            class="mb-1">
                            <x-app.ref-button slug="sahih-muslim" number="538" type="hadith" :ref="'മുസ്ലിം:538'" />
                        </x-app.hadith-box>

                        <x-app.hadith-box class="mb-3"
                            text="വുളൂഅ്‌ ചെയ്യുമ്പോള്‍ നനയാത്ത മടമ്പുകാലുകള്‍ക്ക്‌ നരക ശിക്ഷയുണ്ട്‌">
                            <x-app.ref-button class="mb-1" slug="sahih-bukhari" number="60" type="hadith"
                                :ref="'ബുഖാരി:60'" />
                            <x-app.ref-button class="mb-1" slug="sahih-bukhari" number="96" type="hadith"
                                :ref="'ബുഖാരി:96'" />
                            <x-app.ref-button class="mb-1" slug="sahih-bukhari" number="163" type="hadith"
                                :ref="'ബുഖാരി:163'" />
                            <x-app.ref-button slug="sahih-bukhari" number="165" type="hadith" :ref="'ബുഖാരി:165'" />
                        </x-app.hadith-box>
                        <x-app.hr />

                        <h6 class="text-emerald-900 fw-bold mt-3">5. ക്രമപ്രകാരം ചെയ്യുക</h6>
                        <p class="m-0 mb-1 text-justify" style="text-indent: 2em">
                            ഓരോന്നും അല്ലാഹു വിവരിച്ച അതേ വഴിക്കു വഴി ക്രമത്തില്‍തന്നെ നിര്‍വ്വഹിക്കേണ്ടത്.
                        </p>
                        <x-app.quran-box
                            text="നിങ്ങള്‍ നമസ്കാരത്തിന് ഒരുങ്ങിയാല്‍, നിങ്ങളുടെ മുഖങ്ങളും, മുട്ടുവരെ രണ്ടുകൈകളും കഴുകുകയും, നിങ്ങളുടെ തല തടവുകയും നെരിയാണിവരെ രണ്ട് കാലുകള്‍ കഴുകുകയും ചെയ്യുക.">
                            <x-app.ref-button slug="5" number="6" type="quran" :ref="__('app.quran') . ' 5:6'" />
                        </x-app.quran-box>
                    </x-app.accordion>

                    <x-app.accordion :id="'topic4'" :title="'സുന്നത്ത് പ്രവർത്തികൾ'">
                        <h6 class="text-emerald-900 fw-bold">1. ബിസ്മില്ലാഹ് പറഞ്ഞു തുടങ്ങുക</h6>
                        <x-app.hadith-box text="അല്ലാഹുവിന്റെ നാമം ഉച്ചരിക്കാത്തവന്റെ വുദും സാധുവല്ല." class="mb-3">
                            <x-app.ref-button slug="abu-dawood" number="101" type="hadith" :ref="'അബു ദാവൂദ്:101'" />
                        </x-app.hadith-box>
                        <x-app.hr />

                        <h6 class="text-emerald-900 fw-bold mt-3">2. മിസ്‌വാക്ക്‌ (ദന്ത ശുദ്ധീകരണം) ചെയ്യല്‍</h6>
                        <x-app.hadith-box class="mb-3"
                            text="ജനങ്ങൾക്ക് ​​ബുദ്ധിമുട്ടായി തോന്നിയില്ലായിരുന്നുവെങ്കിൽ, എല്ലാ നമസ്കാരത്തിനും സിവാക് ഉപയോഗിച്ച് പല്ല് തേക്കാൻ ഞാൻ അവരോട് കൽപ്പിക്കുമായിരുന്നു.">
                            <x-app.ref-button slug="sahih-bukhari" number="887" type="hadith" :ref="'ബുഖാരി:887'" />
                        </x-app.hadith-box>
                        <x-app.hr />

                        <h6 class="text-emerald-900 fw-bold mt-3">3. രണ്ട്‌ മുന്‍കൈകളും കഴുകുക.</h6>
                        <p class="m-0 mb-2 text-justify" style="text-indent: 2em">
                            വിരലുകളുടെ അറ്റം മുതല്‍ രണ്ട്‌ കൈകളും മുട്ടുകള്‍ ഉള്‍പ്പെടുത്തി കഴുകുക. കൈകാലുകള്‍ കഴുകുന്ന
                            അവസരത്തില്‍ വിരലുകള്‍ അകറ്റിക്കഴുകല്‍ സുന്നത്താകുന്നു.
                        </p>

                        <x-app.hadith-box class="mb-3" text="കൈകളിൽ വെള്ളം ഒഴിച്ച് കഴുകുക">
                            <x-app.ref-button class="mb-1" slug="sahih-bukhari" number="164" type="hadith"
                                :ref="'ബുഖാരി:164'" />
                            <x-app.ref-button class="mb-1" slug="sahih-muslim" number="538" type="hadith"
                                :ref="'മുസ്ലിം:538'" />
                            <x-app.ref-button class="mb-1" slug="al-tirmidhi" number="39" type="hadith"
                                :ref="'തിർമിധി:39'" />
                            <x-app.ref-button slug="ibn-e-majah" number="447" type="hadith" :ref="'മുസ്ലിം:447'" />
                        </x-app.hadith-box>
                        <x-app.hr />

                        <h6 class="text-emerald-900 fw-bold mt-3">4. വായ്, മൂക്ക് ശുദ്ധമാക്കുക</h6>
                        <p class="m-0 mb-2 text-justify" style="text-indent: 2em">
                            വായില്‍ വെള്ളം കൊള്ളുകയും മൂക്കില്‍ വെള്ളം കയറ്റി ചീറ്റുകയും ചെയ്യുക
                        </p>
                        <x-app.hadith-box class="mb-3" text="ഹദീസ് വിശകലനങ്ങൾ.">
                            <x-app.ref-button class="mb-1" slug="sahih-bukhari" number="164" type="hadith"
                                :ref="'ബുഖാരി:164'" />
                            <x-app.ref-button slug="sahih-muslim" number="538" type="hadith" :ref="'മുസ്ലിം:538'" />
                        </x-app.hadith-box>
                        <x-app.hr />

                        <h6 class="text-emerald-900 fw-bold mt-3">5. താടിരോമങ്ങള്‍ ചികറ്റിക്കഴുകുക</h6>
                        <p class="m-0 mb-2 text-justify" style="text-indent: 2em">
                            മുഖം കഴുകുമ്പോഴാണ് താടിയുടെ തിക്കകറ്റേണ്ടത്. കാരണം, താടിരോമങ്ങൾ മുഖത്തിന്റെ ഭാഗമാണ്.
                        </p>

                        <x-app.hadith-box text="ഹദീസ്" class="mb-3 border-danger">
                            <x-app.ref-button class="mb-1" slug="abu-dawood" number="145" type="hadith"
                                :ref="'അബു ദാവൂദ്:145'" />
                            <x-app.ref-button slug="mishkat" number="408" type="hadith" :ref="'മിഷ്‌കാത്:408'" />
                        </x-app.hadith-box>
                        <x-app.hr />

                        <h6 class="text-emerald-900 fw-bold mt-3">6. തല മുഴുവൻ തടവുന്നതോടൊന്നിച്ച് ചെവി രണ്ടും തടവുക.</h6>
                        <p class="m-0 mb-2 text-justify" style="text-indent: 2em">
                            തള്ളവിരൽകൊണ്ട് ചെവിയുടെ പുറവും ചൂണ്ടുവിരൽകൊണ്ട് ചെവിയുടെ ഉള്ളും തടവണം.
                        </p>

                        <x-app.hadith-box class="mb-3"
                            text="പ്രവാചകന്‍ തന്റെ തല തുടച്ച് രണ്ട് ചൂണ്ടുവിരലുകളും ചെവിയിൽ തിരുകി; തള്ള വിരലുകള്‍ കൊണ്ട്‌ ചെവികള്‍ക്ക്‌ പുറത്തും ചൂണ്ടുവിരലുകൾ കൊണ്ട്‌ ചെവിയുടെ ഉള്‍ഭാഗവും തടവി. ">
                            <x-app.ref-button slug="abu-dawood" number="135" type="hadith" :ref="'അബു ദാവൂദ്:135'" />
                        </x-app.hadith-box>
                        <x-app.hr />

                        <h6 class="text-emerald-900 fw-bold mt-3">7. അവയവങ്ങള്‍ തേച്ചുകഴുകുക.</h6>
                        <p class="m-0 mb-3 text-justify" style="text-indent: 2em">
                            അവയവങ്ങളില്‍ വെള്ളം ഒഴുക്കുന്നതോടൊപ്പം കൈകൊണ്ട്‌ തേച്ച്‌ കഴുകുകയും ചെയ്യുക.
                        </p>
                        <x-app.hr />

                        <h6 class="text-emerald-900 fw-bold mt-3">8. മൂന്നു പ്രാവശ്യം കഴുകുക.</h6>
                        <p class="m-0 mb-2 text-justify" style="text-indent: 2em">
                            ഒരു പ്രാവശ്യം കഴുകല്‍ നിര്‍ബന്ധമാണ്‌. രണ്ടും മൂന്നും പ്രാവശ്യം കഴുകല്‍ സുന്നത്താകുന്നു. എന്നാൽ,
                            ഒരു അവയവം നാല് തവണ കഴുകാൻ പാടില്ല.
                        </p>

                        <x-app.hadith-box text="ഹദീസ്" class="mb-3">
                            <x-app.ref-button class="mb-1" slug="sahih-bukhari" number="158" type="hadith"
                                :ref="'ബുഖാരി:158'" />
                            <x-app.ref-button slug="sahih-muslim" number="545" type="hadith" :ref="'മുസ്ലിം:545'" />
                        </x-app.hadith-box>
                        <x-app.hr />

                        <h6 class="text-emerald-900 fw-bold mt-3">9. വലതുഭാഗം കൊണ്ട്‌ ആരംഭിക്കുക.</h6>
                        <p class="m-0 mb-2 text-justify" style="text-indent: 2em">
                            വുളൂഇന്റെ അവയങ്ങളില്‍ വലതു കൊണ്ട്‌ ആരംഭിക്കല്‍ സുന്നത്താകുന്നു.
                        </p>

                        <x-app.hadith-box text="ഹദീസ്" class="mb-3">
                            <x-app.ref-button class="mb-1" slug="sahih-bukhari" number="5854" type="hadith"
                                :ref="'ബുഖാരി:5854'" />
                            <x-app.ref-button slug="abu-dawood" number="4141" type="hadith" :ref="'അബു ദാവൂദ്:4141'" />
                        </x-app.hadith-box>
                        <x-app.hr />

                        <h6 class="text-emerald-900 fw-bold mt-3">10. വുളൂഇന്‌ ശേഷമുള്ള ‘ദികര്‍’ ചൊല്ലല്‍.</h6>
                        <h5 class="m-0 mb-2 text-ar lh-lg">
                            أَشْهَدُ أَنْ لَا إِلَهَ إِلَّا اللَّهُ وَحْدَهُ لَا شَرِيكَ لَهُ وَأَشْهَدُ أَنَّ مُحَمَّدًا
                            عَبْدُهُ وَرَسُولُهُ، ‏‏‏‏‏‏اللَّهُمَّ اجْعَلْنِي مِنَ التَّوَّابِينَ وَاجْعَلْنِي مِنَ
                            الْمُتَطَهِّرِينَ
                        </h5>

                        <x-app.hadith-box text="ഹദീസ്">
                            <x-app.ref-button class="mb-1" slug="al-tirmidhi" number="55" type="hadith"
                                :ref="'തിർമിധി:55'" />
                            <x-app.ref-button slug="abu-dawood" number="169" type="hadith" :ref="'അബു ദാവൂദ്:169'" />
                        </x-app.hadith-box>
                    </x-app.accordion>

                    <x-app.accordion :id="'topic5'" :title="'വുദുവിന്റെ രൂപം'">
                        <img src="{{ asset('img/namaz/wudu.webp') }}" class="img-fluid mb-3" alt="വുദുവിന്റെ രൂപം">

                        <ol class="m-0 fw-bold text-emerald-900 h6 mb-2">
                            <li class="mb-2">നിയ്യത്ത് കരുതുക.</li>
                            <li class="mb-2">ബിസ്മില്ലാഹ് ചൊല്ലൽ</li>
                            <li class="mb-2">വുളൂഇന്റെ ആദ്യത്തില്‍ മുന്‍ കൈകള്‍ കഴുകല്‍. (മൂന്ന് പ്രാവശ്യം)</li>
                            <li class="mb-2">വായില്‍ വെള്ളം ചുഴറ്റി തുപ്പലും മൂക്കില്‍ വെള്ളം കയറ്റി ചീറ്റലും. (മൂന്ന്
                                പ്രാവശ്യം)</li>
                            <li class="mb-2">മുഖം കഴുകുക. (മൂന്ന് പ്രാവശ്യം)</li>
                            <li class="mb-2">രണ്ട് കൈകള്‍ മുട്ടുകള്‍ ഉള്‍പ്പെടുത്തി കഴുകുക. (മൂന്ന് പ്രാവശ്യം)</li>
                            <li class="mb-2">തലമുഴുവനും രണ്ട്‌ ചെവികള്‍ ഉള്‍പ്പെടുത്തി തടവുക. (മൂന്ന് പ്രാവശ്യം)</li>
                            <li>രണ്ടുകാലുകള്‍ നെരിയാണികള്‍ ഉള്‍പ്പെടുത്തി കഴുകുക. (മൂന്ന് പ്രാവശ്യം)</li>
                        </ol>

                        <x-app.hadith-box class="mb-1" text="അനാവശ്യമായി മൂന്നില്‍ കൂടുതല്‍ തവണ കഴുകല്‍">
                            <x-app.ref-button slug="ibn-e-majah" number="422" type="hadith" :ref="'ഇബ്‍ൻ മാജഹ്:422'" />
                        </x-app.hadith-box>

                        <x-app.hadith-box class="mb-1" text="വെള്ളം പാഴാക്കാതിരിക്കുക">
                            <x-app.ref-button class="mb-1" slug="sahih-bukhari" number="201" type="hadith"
                                :ref="'ബുഖാരി:201'" />
                            <x-app.ref-button class="mb-1" slug="ibn-e-majah" number="425" type="hadith"
                                :ref="'ഇബ്‍ൻ മാജഹ്:425'" />
                            <x-app.ref-button slug="mishkat" number="427" type="hadith" :ref="'മിഷ്‌കാത് :427'" />
                        </x-app.hadith-box>

                        <x-app.ref-box class="mb-1">
                            വുളൂഇൽ സുന്നത്ത്‌ ഒഴിവാക്കുന്നത് പ്രതിഫലം കുറയുന്നതിന്‌ കാരണമാകും.
                        </x-app.ref-box>

                        <x-app.ref-box>
                            <strong>നജസുള്ള സ്ഥലം ഒഴിവാക്കുക.</strong> നജസ്‌ ശരീരത്തില്‍ ഏല്‍ക്കുന്നത്‌ ഭയക്കുന്നതിനാലാണ്‌
                            ഇത്‌.
                        </x-app.ref-box>
                    </x-app.accordion>

                    <x-app.accordion :id="'topic6'" :title="'വുദു മുറിയുന്ന കാര്യങ്ങള്‍'">
                        <h6 class="text-emerald-900 fw-bold">
                            1. മുന്‍പിന്‍ ദ്വാരങ്ങളിലൂടെ കാഷ്ഠം, മൂത്രം പോലെയുള്ള വല്ലതും പുറപ്പെടല്‍.
                        </h6>
                        <p class="m-0 mb-2 text-justify" style="text-indent: 2em">
                            മുന്‍-പിന്‍ ദ്വാരങ്ങളിലൂടെ പുറപ്പെടുന്നത്‌ നജസായാലും അല്ലെങ്കിലും വുളൂഅ്‌ മുറിയും.
                            പുറപ്പെടുന്നത്‌ മനിയ്യ്‌ (ബീജം) ആണെങ്കില്‍ അപ്പോള്‍ കുളി നിര്‍ബന്ധമാകും.
                        </p>

                        <x-app.quran-box class="mb-1"
                            text="…….. അല്ലെങ്കില്‍ നിങ്ങളിലൊരാള്‍ മലമൂത്രവിസര്‍ജ്ജനം കഴിഞ്ഞ് വരികയോ …….. (ചെയ്തിട്ട് വെള്ളം ലഭിച്ചില്ലെങ്കിൽ തയമ്മും ചെയ്യുക)">
                            <x-app.ref-button slug="5" number="6" type="quran" :ref="__('app.quran') . ' 5:6'" />
                        </x-app.quran-box>

                        <x-app.hadith-box text="ഹദീസ്" class="mb-3">
                            <x-app.ref-button slug="sahih-bukhari" number="269" type="hadith" :ref="'ബുഖാരി:269'" />
                        </x-app.hadith-box>
                        <x-app.hr />

                        <h6 class="text-emerald-900 fw-bold mt-3">2. കീഴ്വായു പുറപ്പെടൽ</h6>
                        <x-app.hadith-box text="ഹദീസ്" class="mb-3">
                            <x-app.ref-button slug="sahih-bukhari" number="135" type="hadith" :ref="'ബുഖാരി:135'" />
                        </x-app.hadith-box>
                        <x-app.hr />

                        <h6 class="text-emerald-900 fw-bold mt-3">
                            3. ഗാഡമായ ഉറങ്ങിപ്പോകുക (ശരീരം പൂർണ്ണമായും അശ്രദ്ധയിൽ ആയാൽ).
                        </h6>
                        <p class="m-0 mb-2 text-justify" style="text-indent: 2em">
                            നേരിയ ഉറക്കം വുളൂഇനെ നഷ്ടപ്പെടുത്തുകയില്ല.
                        </p>

                        <x-app.hadith-box class="mb-3" text="ഹദീസ്">
                            <x-app.ref-button slug="abu-dawood" number="203" type="hadith" :ref="'അബു ദാവൂദ്:203'" />
                        </x-app.hadith-box>
                        <x-app.hr />

                        <h6 class="text-emerald-900 fw-bold mt-3">4. ബോധം നശിക്കല്‍.</h6>
                        <p class="m-0 mb-2 text-justify" style="text-indent: 2em">
                            ഭ്രാന്ത്, ബോധക്ഷയം, ലഹരി, രോഗം തുടങ്ങിയ കാരണങ്ങളാല്‍ ബോധം നഷ്ടപ്പെട്ടാല്‍ അത്‌ ഉറക്കിനേക്കാള്‍
                            വുളൂഇനെ നഷ്ടപ്പെടുത്തുവാന്‍ കാരണമാകും. മാത്രവുമല്ല, വുളൂഇനെ നഷ്ടപ്പെടുത്തുന്ന വല്ലതും തന്നില്‍
                            നിന്ന്‌ സംഭവിച്ചിട്ടുണ്ടോയെന്ന്‌ അവന്‌ അറിയുകയുമില്ല.
                        </p>

                        <x-app.hadith-box class="mb-3" text="ഹദീസ്">
                            <x-app.ref-button slug="al-tirmidhi" number="1423" type="hadith" :ref="'തിർമിധി:1423'" />
                        </x-app.hadith-box>
                        <x-app.hr />

                        <h6 class="text-emerald-900 fw-bold mt-3">5. ലൈംഗീകാവയവങ്ങള്‍ സ്പര്‍ശിക്കല്‍</h6>
                        <p class="m-0 mb-2 text-justify" style="text-indent: 2em">
                            കൈപള്ള കൊണ്ട്‌ മറകൂടാതെ മനുഷ്യരുടെ മുന്‍ദ്വാരമോ പിന്‍ദ്വാരമോ സ്പര്‍ശിച്ചാല്‍ അത്‌ വുളൂഇനെ
                            നഷ്ടപ്പെടുത്തും.
                        </p>

                        <x-app.hadith-box text="ഹദീസ്" class="mb-3">
                            <x-app.ref-button slug="ibn-e-majah" number="479" type="hadith" :ref="'ഇബ്നുമാജ:479'" />
                        </x-app.hadith-box>
                        <x-app.hr />

                        <h6 class="text-emerald-900 fw-bold mt-3">6. ഒട്ടകത്തിന്റെ മാംസം ഭക്ഷിക്കല്‍.</h6>
                        <p class="m-0 mb-2 text-justify" style="text-indent: 2em">
                            ഒട്ടകത്തിന്റെ മാംസം വേവിച്ചതാണെങ്കിലും അല്ലെങ്കിലും അത്‌ ഭക്ഷിച്ചാല്‍ വുളൂഅ്‌ നഷ്ടപ്പെടും.
                        </p>

                        <x-app.hadith-box text="ഹദീസ്" class="mb-3">
                            <x-app.ref-button class="mb-1" slug="sahih-bukhari" number="5457" type="hadith"
                                :ref="'ബുഖാരി:5457'" />
                            <x-app.ref-button slug="al-tirmidhi" number="81" type="hadith" :ref="'തിർമിധി:81'" />
                        </x-app.hadith-box>
                        <x-app.hr />

                        <h6 class="text-emerald-900 fw-bold mt-3">7. ഇസ്‌ലാം മതം ഉപേക്ഷിക്കല്‍.</h6>
                        <p class="m-0 text-justify mb-1" style="text-indent: 2em">
                            അഥവാ ഇസ്ലാമില്‍ നിന്ന്‌ പുറത്താക്കുന്ന കാര്യങ്ങള്‍ (നവാഖിദുല്‍ ഇസ്ലാം) പ്രവൃത്തിക്കലാകുന്നു.
                        </p>
                        <x-app.quran-box text="ശിര്‍ക്ക്‌ കര്‍മ്മങ്ങളെ തകര്‍ക്കും; വുളൂഅ്‌ ഒരു കര്‍മ്മമാണ്‌.">
                            <x-app.ref-button slug="39" number="65" type="quran" :ref="__('app.quran') . ' 39:65'" />
                        </x-app.quran-box>
                    </x-app.accordion>

                    <x-app.accordion :id="'topic7'" :title="'വുദു ഉത്തമമായ കാര്യങ്ങൾ'" class="mb-4">
                        <h6 class="text-emerald-900 fw-bold">1. ഉറങ്ങാൻ പോകുമ്പോൾ</h6>
                        <x-app.hadith-box text="ഹദീസ്" class="mb-3">
                            <x-app.ref-button slug="sahih-bukhari" number="247" type="hadith" :ref="'ബുഖാരി:247'" />
                        </x-app.hadith-box>
                        <x-app.hr />

                        <h6 class="text-emerald-900 fw-bold mt-3">
                            2. ജനാബത്തുകാരന്‍ വീണ്ടും സംയോഗത്തിനോ ഭക്ഷണം കഴിക്കാനോ ഉറങ്ങാനോ ഉദ്ദേശിക്കുന്നുവെങ്കിൽ
                        </h6>
                        <x-app.hadith-box text="ഹദീസ്" class="mb-3">
                            <x-app.ref-button class="mb-1" slug="sahih-bukhari" number="287" type="hadith"
                                :ref="'ബുഖാരി:287'" />
                            <x-app.ref-button class="mb-1" slug="al-tirmidhi" number="141" type="hadith"
                                :ref="'തിർമിധി:141'" />
                            <x-app.ref-button class="mb-1" slug="abu-dawood" number="220" type="hadith"
                                :ref="'അബു ദാവൂദ്:220'" />
                            <x-app.ref-button class="mb-1" slug="ibn-e-majah" number="587" type="hadith"
                                :ref="'ഇബ്‍ൻ മാജഹ്:587'" />

                            <x-app.ref-button class="mb-1" slug="sunan-nasai" number="256" type="hadith"
                                :ref="'അന-നസാഈ:256'" />
                            <x-app.ref-button class="mb-1" slug="sunan-nasai" number="257" type="hadith"
                                :ref="'അന-നസാഈ:257'" />
                            <x-app.ref-button class="mb-1" slug="sunan-nasai" number="259" type="hadith"
                                :ref="'അന-നസാഈ:259'" />
                            <x-app.ref-button slug="sunan-nasai" number="404" type="hadith" :ref="'അന-നസാഈ:404'" />
                        </x-app.hadith-box>
                        <x-app.hr />

                        <h6 class="text-emerald-900 fw-bold mt-3">3. ദിക്ർ ചൊല്ലുമ്പോൾ, ഖുർആൻ പാരായണം ചെയ്യുമ്പോൾ.</h6>
                        <p class="m-0 text-justify" style="text-indent: 2em">
                            ഖുർആൻ സ്പര്‍ശിക്കുന്നതിന് വുളൂഅ് നിര്‍ബന്ധമാണെന്ന കാര്യം മേൽ സൂചിപ്പിച്ചിട്ടുണ്ട്. ഇവിടെ
                            സുന്നത്തായി പരാമര്‍ശിച്ചത് ഖുർആൻ പാരായണം ചെയ്യുന്നതിനെ കുറിച്ചാണ്.
                        </p>
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
