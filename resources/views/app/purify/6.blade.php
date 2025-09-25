@extends('layouts.app')

@section('content')
    <x-app.topbar :title="$questions['title']" :url="route('questions.show', ['menu_slug' => 'topics', 'module_slug' => $questions['slug']])" />

    <div class="container my-3 pb-5">
        <x-app.banner :title="$questions['chapters'][$questionSlug]" :desc="'നബി ﷺ പറഞ്ഞു: 10 കാര്യം നബിമാരുടെ ചര്യകളില്‍ പെട്ടതാകുന്നു. <em>- മുസ്ലിം:604</em>'" :search="false" :author="'Author Name'"
            :review="date('M d, Y').
            ' by Reviewer Name'" />

        <div class="row mt-4 notranslate">
            <div class="col-12 col-lg-8">
                <div class="accordion" id="accordions">
                    <x-app.accordion :id="'topic1'" :title="'നബിമാരുടെ ചര്യകൾ'">
                        <p class="m-0 mb-1 text-justify" style="text-indent: 2em">
                            10 കാര്യം നബിമാരുടെ ചര്യകളില്‍ പെട്ടതാകുന്നു. മീശ വെട്ടുക, താടി വളര്‍ത്തുക, പല്ല് തേക്കുക,
                            (വുളുവില്‍ ) മൂക്കില്‍ വെള്ളം കയറ്റുക, നഖം വെട്ടുക, ബറാജിം കഴുകുക, കക്ഷം പറിക്കുക,
                            ഗുഹ്യഭാഗത്തെ രോമങ്ങള്‍ കളയുക, ശൗച്യം ചെയ്യുക
                        </p>

                        <x-app.quran-box class="mb-1" text="ശുദ്ധികൈവരിക്കുന്നവരെ അല്ലാഹു ഇഷ്ടപ്പെടുന്നു.">
                            <x-app.ref-button slug="2" number="222" type="quran" :ref="__('app.quran') . ' 2:222'" />
                        </x-app.quran-box>

                        <x-app.hadith-box text="ശുചിത്വം വിശ്വാസത്തിന്റെ പകുതിയാണ്." class="mb-1">
                            <x-app.ref-button slug="sahih-muslim" number="534" type="hadith" :ref="'മുസ്ലിം:534'" />
                        </x-app.hadith-box>

                        <x-app.hadith-box text="ഹദീസ്." class="mb-1">
                            <x-app.ref-button slug="sahih-muslim" number="604" type="hadith" :ref="'മുസ്ലിം:604'" />
                        </x-app.hadith-box>

                        <x-app.hadith-box text="മീശ വെട്ടുക താടി വളർത്തുക.">
                            <x-app.ref-button class="mb-1" slug="sahih-bukhari" number="5892" type="hadith" :ref="'ബുഖാരി:5892'" />
                            <x-app.ref-button class="mb-1" slug="sahih-muslim" number="600" type="hadith" :ref="'മുസ്ലിം:600'" />
                            <x-app.ref-button class="mb-1" slug="sahih-muslim" number="603" type="hadith" :ref="'മുസ്ലിം:603'" />
                            <x-app.ref-button slug="sunan-nasai" number="14" type="hadith" :ref="'അന-നസാഈ:14'" />
                        </x-app.hadith-box>
                    </x-app.accordion>

                    <x-app.accordion :id="'topic2'" :title="'വിസർജ്ജന മര്യാദകൾ'">
                        <h6 class="text-emerald-900 fw-bold">1. ഇസ്തിൻജാഉം ഇസ്തിജ്മാറും</h6>
                        <p class="m-0 mb-1 text-justify" style="text-indent: 2em">
                            മലമൂത്രദ്വാരങ്ങളിലൂടെ പുറത്തുവന്നത് വെള്ളംകൊണ്ട് ശുചീകരിക്കലാണ് ഇസ്തിൻജാഅ്. കല്ലു പോലുള്ള
                            ശുദ്ധവും അനുവദനീയവും വൃത്തിയാക്കാവുന്നതുമായ വസ്തുകൊണ്ട് തടവുന്നതിനാണ് ഇസ്തിജ്മാറ് എന്നു
                            പറയുന്നത്. ഇവയിലൊന്ന് മറ്റേതിനു പകരം മതിയാകുന്നതാണ്. തിരുനബിﷺയിൽ നിന്ന് അപ്രകാരം
                            സ്ഥിരപ്പെട്ടിട്ടുണ്ട്.
                        </p>
                        <x-app.hadith-box text="ഹദീസ്." class="mb-3">
                            <x-app.ref-button slug="sahih-muslim" number="620" type="hadith" :ref="'മുസ്ലിം:620'" />
                            <x-app.ref-button slug="al-tirmidhi" number="16" type="hadith" :ref="'തിർമിധി:16'" />
                            <x-app.ref-button slug="abu-dawood" number="40" type="hadith" :ref="'അബു ദാവൂദ്:40'" />
                        </x-app.hadith-box>
                        <x-app.hr />

                        <h6 class="text-emerald-900 fw-bold mt-3">
                            2. വിസർജ്ജന സ്ഥലത്ത് പ്രവേശിക്കുമ്പോൾ ഇസ്തിആദത്ത് ചൊല്ലുക
                        </h6>
                        <h5 class="m-0 text-ar lh-lg">اللَّهُمَّ إِنِّي أَعُوذُ بِكَ مِنَ الْخُبُثِ وَالْخَبَائِثِ
                            <strong>/</strong> بسمِ اللهِ، اللهمَّ إنَّي أعوذُ بكَ منَ الخبُثِ والخبائِثِ
                        </h5>
                        <x-app.hadith-box text="ഹദീസ്." class="mb-3">
                            <x-app.ref-button class="mb-1" slug="sahih-bukhari" number="142" type="hadith"
                                :ref="'ബുഖാരി:142'" />
                            <x-app.ref-button slug="ibn-e-majah" number="297" type="hadith" :ref="'ഇബ്‍ൻ മാജഹ്:297'" />
                        </x-app.hadith-box>
                        <x-app.hr />

                        <h6 class="text-emerald-900 fw-bold mt-3">3. ക്വിബ്‌ലക്ക് അഭിമുഖമാകലും പിന്തിരിയലും</h6>
                        <p class="m-0 mb-1 text-justify" style="text-indent: 2em">
                            മലമൂത്ര വിസർജനവേളയിൽ മരുഭൂമിയിൽ മറയില്ലാതെ ക്വിബ്‌ലയെ അഭിമുഖീകരിക്കലും പിന്തിരിയലും
                            അനുവദനീയമല്ല. വിസർജനം നിർവഹിക്കുന്നവന്റെയും കഅ്ബയുടെയും ഇടയിൽ മറയായി വല്ലതുമുണ്ടെങ്കിൽ അതിൽ
                            കുഴപ്പമൊന്നുമില്ല.
                        </p>
                        <x-app.hadith-box text="ഹദീസ്." class="mb-3">
                            <x-app.ref-button class="mb-1" slug="sahih-bukhari" number="394" type="hadith"
                                :ref="'ബുഖാരി:394'" />
                            <x-app.ref-button class="mb-1" slug="sahih-muslim" number="610" type="hadith"
                                :ref="'മുസ്ലിം:610'" />
                            <x-app.ref-button class="mb-1" slug="sahih-muslim" number="609" type="hadith"
                                :ref="'മുസ്ലിം:609'" />
                            <x-app.ref-button class="text-danger" slug="abu-dawood" number="11" type="hadith"
                                :ref="'അബൂ ദാവൂദ്:11'" />
                        </x-app.hadith-box>
                        <x-app.hr />

                        <h6 class="text-emerald-900 fw-bold mt-3">4. വിസർജ്ജനം പാടില്ലാത്ത സ്ഥലങ്ങൾ</h6>
                        <p class="m-0 mb-1 text-justify" style="text-indent: 2em">
                            ഉറവകളിലും വഴിയിലും തണലിലും, മാളത്തിൽ, കെട്ടിനിൽക്കുന്ന വെള്ളത്തിൽ, ഖബ്റിൽ
                        </p>

                        <x-app.hadith-box text="ഉറവകളിലും വഴിയിലും തണലിലും." class="mb-1">
                            <x-app.ref-button class="mb-1" slug="sahih-muslim" number="618" type="hadith"
                                :ref="'മുസ്ലിം:618'" />
                            <x-app.ref-button class="text-danger" slug="abu-dawood" number="26" type="hadith"
                                :ref="'അബൂ ദാവൂദ്:26'" />
                        </x-app.hadith-box>

                        <x-app.hadith-box text="മാളത്തിൽ" class="mb-1">
                            <x-app.ref-button class="mb-1 text-danger" slug="abu-dawood" number="29" type="hadith"
                                :ref="'അബൂ ദാവൂദ്:29'" />
                            <x-app.ref-button slug="ibn-e-majah" number="328" type="hadith" :ref="'ഇബ്‍ൻ മാജഹ്:328'" />
                        </x-app.hadith-box>

                        <x-app.hadith-box text="കെട്ടിനിൽക്കുന്ന വെള്ളത്തിൽ" class="mb-1">
                            <x-app.ref-button slug="sahih-muslim" number="655" type="hadith" :ref="'മുസ്ലിം:655'" />
                        </x-app.hadith-box>

                        <x-app.hadith-box text="ഖബ്റിൽ." class="mb-1">
                            <x-app.ref-button slug="ibn-e-majah" number="1567" type="hadith" :ref="'ഇബ്‍ൻ മാജഹ്:1567'" />
                        </x-app.hadith-box>

                        <x-app.hadith-box text="കുളിപ്പുരയിൽ മൂത്രമൊഴിക്കരുത്" class="mb-1">
                            <x-app.ref-button class="text-danger" slug="abu-dawood" number="27" type="hadith"
                                :ref="'അബൂ ദാവൂദ്:27'" />
                        </x-app.hadith-box>

                        <x-app.hadith-box text="വിസര്‍ജ്ജനം ചെയ്ത വെള്ളത്തിൽ കുളിക്കരുത്<." class="mb-3">
                            <x-app.ref-button class="mb-1" slug="sahih-muslim" number="656" type="hadith"
                                :ref="'മുസ്ലിം:656'" />
                            <x-app.ref-button slug="sahih-muslim" number="658" type="hadith" :ref="'മുസ്ലിം:658'" />
                        </x-app.hadith-box>
                        <x-app.hr />

                        <h6 class="text-emerald-900 fw-bold mt-3">5. മര്യാദകൾ</h6>
                        <p class="m-0 mb-1 text-justify" style="text-indent: 2em">
                            ജനദൃഷ്ടിയിൽ നിന്നും മറഞ്ഞിരിക്കുക, വസ്ത്രം ഉയർത്തേണ്ടത്, ഇരുന്നാണ് നിർവഹിക്കേണ്ടത്, ഇടതു കൈ
                            കൊണ്ട് ശുദ്ധിയാക്കുക, ഇസ്തിൻജാഇന് ശേഷം കൈ വൃത്തിയാക്കുക.
                        </p>
                        <x-app.hadith-box text="ജനദൃഷ്ടിയിൽ നിന്നും മറഞ്ഞിരിക്കുക" class="mb-1">
                            <x-app.ref-button class="mb-1" slug="sahih-bukhari" number="363" type="hadith"
                                :ref="'ബുഖാരി:363'" />
                            <x-app.ref-button class="mb-1" slug="ibn-e-majah" number="335" type="hadith"
                                :ref="'ഇബ്‍ൻ മാജഹ്:335'" />
                            <x-app.ref-button slug="ibn-e-majah" number="336" type="hadith" :ref="'ഇബ്‍ൻ മാജഹ്:336'" />
                        </x-app.hadith-box>

                        <x-app.hadith-box class="mb-1"
                            text="വസ്ത്രം ഉയർത്തേണ്ടത്: നബി ﷺ മലമൂത്ര വിസർജനം ഉദ്ദേശിച്ചാൽ ഭൂമിയോട് അടുക്കുന്നത് വരെ തന്റെ വസ്ത്രം ഉയർത്തുമായിരുന്നില്ല.">
                            <x-app.ref-button slug="al-tirmidhi" number="14" type="hadith" :ref="'തിർമിധി:14'" />
                        </x-app.hadith-box>

                        <x-app.hadith-box class="mb-1" text="ഇരുന്നാണ് നിർവഹിക്കേണ്ടത്">
                            <x-app.ref-button slug="sunan-nasai" number="29" type="hadith" :ref="'അന-നസാഈ:29'" />
                        </x-app.hadith-box>

                        <x-app.hadith-box class="mb-1" text="നിന്നുകൊണ്ടു മൂത്ര വിസർജനം ആകാവുന്നത് എപ്പോൾ">
                            <x-app.ref-button slug="sahih-bukhari" number="225" type="hadith" :ref="'ബുഖാരി:225'" />
                        </x-app.hadith-box>

                        <x-app.hadith-box class="mb-1" text="വലതു കൈ കൊണ്ട് ലിംഗം പിടിക്കരുത്">
                            <x-app.ref-button slug="sahih-muslim" number="613" type="hadith" :ref="'മുസ്ലിം:613'" />
                            <x-app.ref-button slug="sahih-muslim" number="614" type="hadith" :ref="'മുസ്ലിം:614'" />
                        </x-app.hadith-box>

                        <x-app.hadith-box class="mb-1" text="വലതു കൈ കൊണ്ട് ശുദ്ധിയാക്കരുത്">
                            <x-app.ref-button slug="sahih-bukhari" number="154" type="hadith" :ref="'ബുഖാരി:154'" />
                        </x-app.hadith-box>

                        <x-app.hadith-box text="ഇടതു കൈ കൊണ്ട് ശുദ്ധിയാക്കുക" class="mb-1">
                            <x-app.ref-button class="text-danger" slug="abu-dawood" number="33" type="hadith"
                                :ref="'അബൂ ദാവൂദ്:33'" />
                        </x-app.hadith-box>

                        <x-app.hadith-box class="mb-1"
                            text="വെള്ളം ലഭിക്കാതെ കല്ലോ മറ്റോ ഉപയോഗിക്കുമ്പോൾ, എല്ലും ചാണകവും ഉപയോഗിക്കരുത്">
                            <x-app.ref-button class="mb-1" slug="sahih-muslim" number="607" type="hadith"
                                :ref="'മുസ്ലിം:607'" />
                            <x-app.ref-button class="mb-1" slug="sahih-muslim" number="560" type="hadith"
                                :ref="'മുസ്ലിം:560'" />
                            <x-app.ref-button class="mb-1" slug="al-tirmidhi" number="18" type="hadith"
                                :ref="'തിർമിധി:18'" />
                            <x-app.ref-button slug="abu-dawood" number="96" type="hadith" :ref="'അബൂ ദാവൂദ്:96'" />
                        </x-app.hadith-box>

                        <x-app.hadith-box class="mb-1" text="ഇസ്തിൻജാഇന് ശേഷം കൈ വൃത്തിയാക്കണം">
                            <x-app.ref-button slug="abu-dawood" number="45" type="hadith" :ref="'അബൂ ദാവൂദ്:45'" />
                        </x-app.hadith-box>

                        <x-app.hadith-box class="mb-1" text="വിസർജ്ജനം പിടിച്ചുവെച്ച് നമസ്കരിക്കരുത്">
                            <x-app.ref-button class="mb-1" slug="sahih-muslim" number="1246" type="hadith"
                                :ref="'മുസ്ലിം:1246'" />
                            <x-app.ref-button slug="ibn-e-majah" number="617" type="hadith" :ref="'ഇബ്‍ൻ മാജഹ്:617'" />
                        </x-app.hadith-box>

                        <x-app.hadith-box class="mb-1" text="മൂത്രവിസജ്ജർനം: അലസത കാണിക്കരുത്">
                            <x-app.ref-button slug="sahih-bukhari" number="218" type="hadith" :ref="'ബുഖാരി:218'" />
                        </x-app.hadith-box>

                        <x-app.hadith-box class="mb-3" text="വിസർജ്ജന വേളയിൽ സലാം പറയുകയോ മടക്കുകയോ വേണ്ടതില്ല">
                            <x-app.ref-button class="mb-1" slug="sahih-muslim" number="822" type="hadith"
                                :ref="'മുസ്ലിം:822'" />
                            <x-app.ref-button class="mb-1" slug="sahih-muslim" number="823" type="hadith"
                                :ref="'മുസ്ലിം:823'" />
                            <x-app.ref-button slug="ibn-e-majah" number="352" type="hadith" :ref="'ഇബ്‍ൻ മാജഹ്:352'" />
                        </x-app.hadith-box>
                        <x-app.hr />

                        <h6 class="text-emerald-900 fw-bold mt-3">6. ടോയ്ലറ്റിൽ നിന്നും പുറത്ത് കടക്കുമ്പോൾ</h6>
                        <h5 class="m-0 mb-1 text-ar lh-lg">
                            غُفْرَانَكَ
                        </h5>
                        <x-app.hadith-box text="ഹദീസ്.">
                            <x-app.ref-button slug="abu-dawood" number="30" type="hadith" :ref="'അബൂ ദാവൂദ്:30'" />
                        </x-app.hadith-box>
                    </x-app.accordion>

                    <x-app.accordion :id="'topic3'" :title="'നഖം വെട്ടൽ'" class="mb-4">
                        <p class="m-0 mb-1 text-justify" style="text-indent: 2em">
                            നഖം നീട്ടി വളർത്താൻ സത്യവിശ്വാസികൾക്ക് പാടുള്ളതല്ലെന്നും നഖം വെട്ടൽ ശുദ്ധപ്രകൃതിയുടെ
                            ഭാഗമാണെന്നും മനസ്സിലാക്കുക. പ്രവാചകന്‍മാരുടെ ചര്യകളായി അറിയപ്പെടുന്ന ചില കാര്യങ്ങൾക്കാണ്
                            ശുദ്ധപ്രകൃതി ചര്യകള്‍ എന്ന് പറയുന്നത്.
                        </p>
                        <x-app.hadith-box text="ഹദീസ്." class="mb-1">
                            <x-app.ref-button class="mb-1" slug="sahih-bukhari" number="5889" type="hadith"
                                :ref="'ബുഖാരി:5889'" />
                            <x-app.ref-button slug="sahih-muslim" number="604" type="hadith" :ref="'മുസ്ലിം:604'" />
                        </x-app.hadith-box>

                        <x-app.hadith-box class="mb-1"
                            text="മീശവെട്ടുക, നഖം മുറിക്കുക, കക്ഷരോമം നീക്കല്‍, ഗുഹ്യരോമം നീക്കല്‍ തുടങ്ങി കാര്യങ്ങള്‍ 40 രാത്രികളിലധികം വിട്ടേക്കരുത്.">
                            <x-app.ref-button slug="sahih-muslim" number="599" type="hadith" :ref="'മുസ്ലിം:599'" />
                        </x-app.hadith-box>

                        <x-app.hadith-box class="mb-1" text="വലതിനെ മുന്തിക്കുക">
                            <x-app.ref-button slug="sahih-muslim" number="616" type="hadith" :ref="'മുസ്ലിം:616'" />
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
