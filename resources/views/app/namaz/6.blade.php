@extends('layouts.app')

@section('content')
    <style>
        .accordion-item {
            margin-bottom: 8px;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
        }

        .accordion-button:focus {
            box-shadow: none !important;
        }

        .accordion-button:not(.collapsed) {
            background: #e9f7ef;
            color: #198754;
        }
    </style>

    <x-app.topbar :title="$questions['title']" :url="route('questions.show', ['menu_slug' => 'topics', 'module_slug' => $questions['slug']])" />

    <div class="container my-3 pb-5">
        <x-app.banner :title="$questions['chapters'][$questionSlug]" :desc="$questions['desc']" :search="false" :author="'Author Name'" :review="date('M d, Y') . ' by Reviewer Name'" />

        <div class="row mt-4 notranslate">
            <div class="col-12 col-lg-8">
                <div class="accordion" id="jumuahTopics">

                    <!-- Topic 1 -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button collapsed text-emerald" type="button" data-bs-toggle="collapse"
                                data-bs-target="#topic1" aria-expanded="true">
                                <i class="fas fa-lightbulb text-accent me-2"></i>
                                <span class="fw-bold">അല്ലാഹുവും, റസൂൽ ﷺ യും ശ്രേഷ്ടത നൽകാത്തതിന് ശ്രേഷ്ടത
                                    കൽപ്പിക്കുന്നു.</span>
                            </button>
                        </h2>

                        <div id="topic1" class="accordion-collapse collapse" data-bs-parent="#jumuahTopics">
                            <div class="accordion-body p-3">
                                <p class="m-0 mb-2" style="text-indent: 2em">
                                    റബീഉൽ അവ്വൽ മാസത്തിന് പ്രത്യേക ശ്രേഷ്ടത കൽപ്പിച്ചു. <strong>‘പുണ്യ റബീഅ്’</strong> എന്ന്
                                    ഈ മാസത്തെ വിശേഷിപ്പിക്കുന്നത്. ചില മാസങ്ങള്‍ക്ക് അല്ലാഹുവും അവന്റെ റസൂൽ ﷺ യും
                                    ശ്രേഷ്ടതയും പ്രത്യേകതയും നല്‍കിയിട്ടുണ്ട്. അതിൽ റ. അവ്വൽ ഇല്ല.
                                </p>

                                <x-app.quran-box class="mb-1"
                                    text="ആകാശങ്ങളും ഭൂമിയും സൃഷ്ടിച്ച ദിവസം അല്ലാഹു രേഖപ്പെടുത്തിയതനുസരിച്ച് അല്ലാഹുവിന്‍റെ അടുക്കല്‍ മാസങ്ങളുടെ എണ്ണം പന്ത്രണ്ടാകുന്നു. അവയില്‍ നാലെണ്ണം (യുദ്ധം) വിലക്കപ്പെട്ടമാസങ്ങളാകുന്നു. അതാണ് വക്രതയില്ലാത്ത മതം....">
                                    <x-app.ref-button class="mb-1" slug="9" number="36" type="quran"
                                        :ref="__('app.quran') . ' 9:36'" />
                                </x-app.quran-box>

                                <x-app.hadith-box
                                    text="ഒരു വര്‍ഷം പന്ത്രണ്ട് മാസമാകുന്നു. അതില്‍ നാലെണ്ണം പവിത്രമാക്കപ്പെട്ട മാസങ്ങളാണ്. ദുല്‍ഖഅ്ദ, ദുല്‍ഹിജ്ജ, മുഹര്‍റം, റജബ് എന്നിവ.">
                                    <x-app.ref-button slug="sahih-bukhari" number="4662" type="hadith"
                                        :ref="'ബുഖാരി:4662'" />
                                </x-app.hadith-box>
                            </div>
                        </div>
                    </div>

                    <!-- Topic 2 -->
                    <div class="accordion-item ">
                        <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button collapsed text-emerald" type="button" data-bs-toggle="collapse"
                                data-bs-target="#topic2">
                                <i class="fas fa-lightbulb text-accent me-2"></i>
                                <span class="fw-bold">റ. അവ്വൽ 12 & പ്രത്യേക ആരാധനകൾ (ഇബാദത്)</span>
                            </button>
                        </h2>

                        <div id="topic2" class="accordion-collapse collapse" data-bs-parent="#jumuahTopics">
                            <div class="accordion-body topic-points">
                                <p class="m-0 mb-2" style="text-indent: 2em">
                                    റ. അവ്വൽ മാസത്തിൽ പ്രത്യേകം ഇബാദത്തുകൾ അനുഷ്ടിക്കേണ്ട സാഹചര്യം ഇല്ല. റ. അവ്വൽ
                                    മാസത്തിൽ പ്രത്യേകം പുണ്യം കല്‍പ്പിച്ച് ചെയ്യുന്ന ഇബാദത്തുകൾ ബിദ്അത്താണ്.
                                </p>

                                <p class="m-0 mb-2" style="text-indent: 2em">
                                    അബൂബക്കർ(റ), ഉമർ (റ), ഉസ്മാൻ (റ), അലി (റ) & മദ്ഹബുകളുടെ ഇമാമുമാർ (ഇമാം അബൂ ഹനീഫ, മാലിക്,
                                    ഷാഫിഈ, ഹൻബലി) എന്നിവർ പ്രവാചകൻ ﷺ ജനിച്ച ദിവസം പ്രത്യേകം പുണ്യം കല്‍പ്പിച്ച് ഇബാദത്തുകൾ
                                    ചെയ്തിട്ടില്ല.
                                </p>

                                <ul class="m-0 mb-2">
                                    <li>
                                        <strong>അബൂ ഹനീഫ:</strong> നിശ്ചിത സമയങ്ങളെ, ശരീഅത്ത് നിർദ്ദേശിക്കാതെ,
                                        ആരാധനയ്‌ക്കായി വേർതിരിക്കുന്നത് ബിദ്അത് ആണ്. - <em data-bs-toggle="offcanvas"
                                            data-bs-target="#referencesPanel" data-ref-id="ref1">അൽ-ഹിദായ, അൽ-മബ്സൂത്
                                            [1]</em>
                                    </li>
                                    <li>
                                        <strong>മാലിക്:</strong> സലഫുകൾ (ആദ്യകാല സഹാബികൾ, താബിഉൻ) ആരും ചെയ്തിട്ടില്ല, അത്
                                        ബിദ്അത് ആണ്. - <em data-bs-toggle="offcanvas" data-bs-target="#referencesPanel"
                                            data-ref-id="ref2">അൽ-ഇ'തിസാം [2]</em>
                                    </li>
                                    <li>
                                        <strong>ശാഫിഈ:</strong> നേരിട്ട് മീലാദിനെക്കുറിച്ച് പറഞ്ഞിട്ടില്ല. ഒരു കാര്യത്തെ
                                        നല്ല ബിദ്അത് എന്നും, മോശം ബിദ്അത് എന്നും പറയാം. - <em data-bs-toggle="offcanvas"
                                            data-bs-target="#referencesPanel" data-ref-id="ref3">മനാഖിബ് അൽ-ശാഫിഈ [3]</em>
                                    </li>
                                    <li>
                                        <strong>ഹൻബലി:</strong> എനിക്ക് അത് ബിദ്അത് ആയി തോന്നുന്നു. - <em
                                            data-bs-toggle="offcanvas" data-bs-target="#referencesPanel"
                                            data-ref-id="ref4">ഇഖ്തിദാഉൽ സിറാത്ത് [4]</em>
                                    </li>
                                </ul>

                                <p class="m-0 mb-1" style="text-indent: 2em">
                                    ഏതെങ്കിലും ഒരു പ്രത്യേക തിയ്യതിയിലാണ് നബി ﷺ ജനിച്ചതെന്ന് ആരെങ്കിലും
                                    വാദിക്കുന്നുണ്ടെങ്കിൽ, അതിന് ഒരു തെളിവുമില്ല. നബി ﷺ എന്നാണ് ജനിച്ചതെന്ന കാര്യത്തിൽ,
                                    പണ്ഡിതന്മാർക്കിടയിൽ വ്യത്യസ്ത അഭിപ്രായങ്ങളുണ്ട്. ചിലര്‍ റ. അവ്വൽ 12 നാണ് ജനിച്ചതെന്ന്
                                    പറയുന്നുണ്ടെങ്കിലും, അങ്ങനെ ഉറപ്പിച്ച് പറയാൻ തെളിവൊന്നുമില്ല. <span
                                        data-bs-toggle="offcanvas" data-bs-target="#referencesPanel"
                                        data-ref-id="ref5">[5]</span>
                                </p>

                                <x-app.hadith-box class="mb-1"
                                    text="ജനങ്ങളില്‍ ഏറ്റവും ഉത്തമര്‍ എന്റെ നൂറ്റാണ്ടാണ്‌. പിന്നീട് അതിനുശേഷം വന്നവര്‍, പിന്നീട് അവര്‍ക്ക് ശേഷം വന്നവര്‍. ">
                                    <x-app.ref-button slug="sahih-bukhari" number="2652" type="hadith"
                                        :ref="'ബുഖാരി:2652'" />
                                    <x-app.ref-button slug="sahih-bukhari" number="3651" type="hadith"
                                        :ref="'ബുഖാരി:3651'" />
                                    <x-app.ref-button slug="sahih-bukhari" number="6429" type="hadith"
                                        :ref="'ബുഖാരി:6429'" />
                                    <x-app.ref-button slug="sahih-muslim" number="6472" type="hadith"
                                        :ref="'മുസ്ലിം:6472'" />
                                </x-app.hadith-box>

                                <div class="m-0">
                                    <p class="m-0 mb-1" style="text-indent: 2em">
                                        റബീഉൽ അവ്വൽ 12 രണ്ട് പെരുന്നാൾ പോലെയുള്ള ഒരു ആഘോഷ ദിവസമായി ആളുകൾ
                                        തെറ്റിദ്ധരിക്കുന്നു. ഇസ്ലാമില്‍ രണ്ട് ആഘോഷങ്ങള്‍ മാത്രമാണുള്ളത്.
                                    </p>

                                    <x-app.hadith-box
                                        text="നല്ല രണ്ട് (പെരുന്നാളുകള്‍) നിങ്ങള്‍ക്ക് നല്‍കിയിരിക്കുന്നു. ഈദുല്‍ അള്ഹയും ഈദുല്‍ ഫിത്വറും.">
                                        <x-app.ref-button slug="abu-dawood" number="1134" type="hadith"
                                            :ref="'അബൂദാവൂദ്:1134'" />
                                    </x-app.hadith-box>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Topic 3 -->
                    <div class="accordion-item ">
                        <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button collapsed text-emerald" type="button" data-bs-toggle="collapse"
                                data-bs-target="#topic3">
                                <i class="fas fa-lightbulb text-accent me-2"></i>
                                <span class="fw-bold">ആഘോഷങ്ങളും മൗലിദ് പാരായണങ്ങളും</span>
                            </button>
                        </h2>

                        <div id="topic3" class="accordion-collapse collapse" data-bs-parent="#jumuahTopics">
                            <div class="accordion-body topic-points">
                                <div class="m-0 mb-2">
                                    <p class="m-0 mb-1" style="text-indent: 2em">
                                        നബി ﷺ യുടെ ചരിത്രവും ഗുണങ്ങളും എടുത്തുപറയുന്നതും അവിടുത്തെ പുകഴ്ത്തി പറയുന്നതും
                                        പ്രവാചക സ്നേഹത്തില്‍ പെട്ടതാണ്. പറയുന്ന കാര്യങ്ങളും സത്യസന്ധവും ഇസ്ലാമിക
                                        ആദ൪ശത്തിനകത്ത് നില്‍ക്കുന്നതായിരിക്കണം. കാരണം അതിരു വിടുന്നത് നബി ﷺ താക്കീത്
                                        ചെയ്തിട്ടുണ്ട്.
                                    </p>

                                    <x-app.hadith-box
                                        text="ക്രൈസ്തവ൪ മറിയമിന്റെ മകനെ പുകഴ്ത്തിയതുപോലെ നിങ്ങള്‍ എന്നെ പുകഴ്ത്തരുത്.">
                                        <x-app.ref-button slug="sahih-bukhari" number="3445" type="hadith"
                                            :ref="'ബുഖാരി:3445'" />
                                    </x-app.hadith-box>
                                </div>

                                <x-app.hadith-box text="പുതുതായി കെട്ടിച്ചമച്ച കാര്യങ്ങളെ സൂക്ഷിക്കുക, കാരണം അവ വഴികേടാണ്."
                                    class="mb-2">
                                    <x-app.ref-button slug="sahih-bukhari" number="2697" type="hadith"
                                        :ref="'ബുഖാരി:2697'" class="mb-1" />
                                    <x-app.ref-button slug="sahih-muslim" number="4493" type="hadith"
                                        :ref="'മുസ്ലിം:4493'" class="mb-1" />
                                    <x-app.ref-button slug="sahih-muslim" number="4784" type="hadith"
                                        :ref="'മുസ്ലിം:4784'" />
                                    <x-app.ref-button slug="al-tirmidhi" number="2676" type="hadith" :ref="'തിർമിധി:2676'"
                                        class="mb-1" />
                                    <x-app.ref-button slug="al-tirmidhi" number="2677" type="hadith" class="mb-1"
                                        :ref="'തിർമിധി:2677'" />
                                    <x-app.ref-button slug="abu-dawood" number="4607" type="hadith"
                                        :ref="'അബു ദാവൂദ്:4607'" />
                                </x-app.hadith-box>

                                <div class="m-0">
                                    <p class="m-0 mb-1" style="text-indent: 2em">
                                        ജൂത-ക്രൈസ്തവ വിഭാഗങ്ങളോട് സാദൃശ്യമുണ്ടാകുന്നു. പ്രവാചകന്മാരുടെ ജന്മദിനത്തെ
                                        ഉത്സവവേളയാക്കുക എന്നത് ജൂത-ക്രൈസ്തവ വിഭാഗങ്ങളുടെ പതിവാണ്.
                                    </p>
                                    <p class="m-0 mb-1" style="text-indent: 2em">
                                        ചില മതങ്ങൾ മതസ്ഥാപകരുടെയും മറ്റും ജന്മദിനം ആഘോഷിച്ചു വരുന്നു. ബുദ്ധമത വിശ്വാസികൾ
                                        ബുദ്ധന്റെ ജന്മ ദിനം ഒരു പ്രധാന ആഘോഷമായി കാണുന്നു. ക്രിസ്തുവിന്റെ ജന്മദിനം
                                        ക്രിസ്തുമസ്സും ലോകം മുഴുവൻ കൊണ്ടാടപ്പെടുന്നു. ഗുരുനാനാക്ക് ജനിച്ച ദിവസം സിഖുക്കാരും
                                        ആഘോഷിക്കുന്നു. മുസ്‌ലിംകൾ പ്രവാചകൻ(സ)യുടെ ജന്മദിനം ലോകമെങ്ങും സമുചിതമായി
                                        ആഘോഷിക്കുന്നു.
                                    </p>

                                    <x-app.hadith-box
                                        text="ആരെങ്കിലും ഏതെങ്കിലും ജനതയോട്‌ സാമ്യപ്പെട്ടാല്‍ അവന്‍ അവരില്‍പെട്ടവനാണ്‌.">
                                        <x-app.ref-button slug="abu-dawood" number="4031" type="hadith"
                                            :ref="'അബൂദാവൂദ്:4031'" />
                                        <x-app.ref-button slug="al-tirmidhi" number="2695" type="hadith"
                                            class="mb-1" :ref="'തിർമിധി:2695'" />
                                        <x-app.ref-button slug="sahih-bukhari" number="7320" type="hadith"
                                            :ref="'ബുഖാരി:7320'" />
                                    </x-app.hadith-box>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Topic 4 -->
                    <div class="accordion-item ">
                        <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button collapsed text-emerald" type="button"
                                data-bs-toggle="collapse" data-bs-target="#topic4">
                                <i class="fas fa-lightbulb text-accent me-2"></i>
                                <span class="fw-bold">നബി ﷺ യുടെ ചര്യ (സുന്നത്ത്)</span>
                            </button>
                        </h2>

                        <div id="topic4" class="accordion-collapse collapse" data-bs-parent="#jumuahTopics">
                            <div class="accordion-body topic-points">
                                <div class="m-0 mb-2">
                                    <p class="m-0 mb-1" style="text-indent: 2em">
                                        പ്രവാചക ചര്യ, സ്റ്റേഹമെന്നാൽ നബിദിനം ആഘോഷിക്കലാണെന്ന് സമൂഹം
                                        തെറ്റിദ്ധരിക്കപ്പെടുന്നു. നബി ﷺ യെ കൊണ്ട് സന്തോഷിക്കാനും നബി ﷺ യെ പറ്റി
                                        സംസാരിക്കാനുമൊക്കെ ഒരു പ്രത്യേക ദിവസമോ മാസമോ നിശ്ചയിക്കേണ്ടതില്ല. അത് എല്ലാ ദിവസവും
                                        നടക്കേണ്ടതാണ്. നബി ﷺ യെ സ്‌നേഹിക്കുക എന്നതിന്റെ പ്രധാന ഉദ്ദേശ്യം തിരുസുന്നത്തിനെ
                                        സ്‌നേഹിക്കലാണ്. അത് നമ്മുടെ ജീവിതത്തില്‍ പകര്‍ത്തലാണ്.
                                    </p>

                                    <x-app.quran-box class="mb-1"
                                        text="നബിﷺയുടെ വാക്കുകളെ മറ്റുള്ളവരുടെ വാക്കുകളേക്കാള്‍ പ്രാധാന്യപൂ൪വ്വം പരിഗണിക്കുകയും ജീവിതത്തില്‍ പക൪ത്തുകയും ചെയ്യണം.">
                                        <x-app.ref-button class="mb-1" slug="4" number="65" type="quran"
                                            :ref="__('app.quran') . ' 4:65'" />
                                    </x-app.quran-box>

                                    <x-app.hadith-box
                                        text="ആരെങ്കിലും എന്റെ സുന്നത്ത് പിൻപറ്റിയാൽ അവൻ എന്നെ ഇഷ്ടപ്പെട്ടു, ആരെങ്കിലും എന്നെ ഇഷ്ടപ്പെട്ടാൽ അവൻ എന്റെ കൂടെ സ്വർഗത്തിലായിരിക്കും">
                                        <x-app.ref-button slug="al-tirmidhi" number="2678" type="hadith"
                                            :ref="'തിർമിധി:2678'" />
                                        <x-app.ref-button slug="sahih-bukhari" number="5063" type="hadith"
                                            :ref="'ബുഖാരി:5063'" />
                                        <x-app.ref-button slug="sahih-muslim" number="3403" type="hadith"
                                            :ref="'മുസ്ലിം:3403'" />
                                        <x-app.ref-button slug="al-tirmidhi" number="2154" type="hadith"
                                            :ref="'തിർമിധി:2154'" />
                                    </x-app.hadith-box>
                                </div>

                                <div class="m-0 mb-2">
                                    <p class="m-0 mb-1" style="text-indent: 2em">
                                        നബി ﷺ യുടെ ജനനത്തോട് അനുബന്ധിച്ച് തിങ്കളാഴ്ച നോമ്പ് അനുഷ്ഠിക്കൽ നബി ചര്യ ആണ്.
                                    </p>

                                    <x-app.hadith-box text="ഞാൻ ജനിച്ച ദിവസമായിരുന്നു അത് (തിങ്കളാഴ്ച).">
                                        <x-app.ref-button slug="sahih-muslim" number="2747" type="hadith"
                                            :ref="'മുസ്ലിം:2747'" />
                                    </x-app.hadith-box>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Topic 5 -->
                    <div class="accordion-item mb-4">
                        <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button collapsed text-emerald" type="button"
                                data-bs-toggle="collapse" data-bs-target="#topic5">
                                <i class="fas fa-lightbulb text-accent me-2"></i>
                                <span class="fw-bold">മതത്തിൽ പുതുതായി കൂട്ടി ചേർക്കുന്നവർക്കുള്ള (ബിദ്അത്ത്)
                                    മുന്നറിയിപ്പ്</span>
                            </button>
                        </h2>

                        <div id="topic5" class="accordion-collapse collapse" data-bs-parent="#jumuahTopics">
                            <div class="accordion-body topic-points">
                                <div class="m-0">
                                    <p class="m-0 mb-1" style="text-indent: 2em">
                                        എനിക്ക് ശേഷം ജീവിക്കുന്ന നിങ്ങളിൽ വലിയ അഭിപ്രായവ്യത്യാസങ്ങൾ കാണും. അപ്പോൾ നിങ്ങൾ
                                        എന്റെയും സന്മാർഗ്ഗം പ്രാപിച്ച ഖലീഫമാരുടെയും സുന്നത്ത് പിന്തുടരണം. അത് മുറുകെ
                                        പിടിക്കുകയും അതിൽ ഉറച്ചുനിൽക്കുകയും ചെയ്യുക. പുതുമകൾ ഒഴിവാക്കുക, കാരണം എല്ലാ
                                        പുതുമകളും ഒരു പുതുമയാണ്, എല്ലാ പുതുമകളും ഒരു തെറ്റാണ്.
                                    </p>

                                    <x-app.hadith-box class="mb-1"
                                        text="പുതുതായി കെട്ടിച്ചമച്ച കാര്യങ്ങളെ സൂക്ഷിക്കുക, കാരണം അവ വഴികേടാണ്.">
                                        <x-app.ref-button slug="sahih-bukhari" number="2697" type="hadith"
                                            :ref="'ബുഖാരി:2697'" class="mb-1" />
                                        <x-app.ref-button slug="sahih-muslim" number="4493" type="hadith"
                                            :ref="'മുസ്ലിം:4493'" class="mb-1" />
                                        <x-app.ref-button slug="sahih-muslim" number="4784" type="hadith"
                                            :ref="'മുസ്ലിം:4784'" />
                                        <x-app.ref-button slug="al-tirmidhi" number="2676" type="hadith"
                                            :ref="'തിർമിധി:2676'" class="mb-1" />
                                        <x-app.ref-button slug="al-tirmidhi" number="2677" type="hadith"
                                            class="mb-1" :ref="'തിർമിധി:2677'" />
                                        <x-app.ref-button slug="abu-dawood" number="4607" type="hadith"
                                            :ref="'അബു ദാവൂദ്:4607'" />
                                    </x-app.hadith-box>

                                    <x-app.quran-box text="നിങ്ങളുടെ മതത്തിനെപ്പറ്റി നിങ്ങള്‍ അല്ലാഹുവെ പഠിപ്പിക്കുകയാണോ?"
                                        class="mb-1">
                                        <x-app.ref-button slug="49" number="16" type="quran"
                                            :ref="__('app.quran') . ' 49:16'" />
                                    </x-app.quran-box>

                                    <x-app.quran-box class="mb-1"
                                        text="ഇന്ന് ഞാന്‍ നിങ്ങള്‍ക്ക് നിങ്ങളുടെ മതം പൂര്‍ത്തിയാക്കി തന്നിരിക്കുന്നു. എന്റെ അനുഗ്രഹം നിങ്ങള്‍ക്ക് ഞാന്‍ നിറവേറ്റിത്തരികയും ചെയ്തിരിക്കുന്നു.">
                                        <x-app.ref-button slug="5" number="3" type="quran"
                                            :ref="__('app.quran') . ' 5:3'" />
                                    </x-app.quran-box>

                                    <x-app.quran-box class="mb-1"
                                        text="പ്രവാചകന്‍ സത്യവിശ്വാസികള്‍ക്ക് സ്വദേഹങ്ങളെക്കാളും അടുത്ത ആളാകുന്നു……">
                                        <x-app.ref-button slug="33" number="6" type="quran"
                                            :ref="__('app.quran') . ' 33:6'" />
                                    </x-app.quran-box>

                                    <x-app.hadith-box class="mb-1"
                                        text="ഒരു സത്യവിശ്വാസിക്ക് സ്വന്തം മാതാപിതാക്കളേക്കാളും സന്താനത്തെക്കാളും മുഴുവന്‍ മനുഷ്യരെക്കാളും ഏറ്റവും പ്രിയപ്പെട്ടവന്‍  മുഹമ്മദ് നബി ﷺ ആയിരിക്കണം.">
                                        <x-app.ref-button slug="sahih-bukhari" number="6632" type="hadith"
                                            :ref="'ബുഖാരി:6632'" class="mb-1" />
                                    </x-app.hadith-box>

                                    <x-app.hadith-box text="തീ൪ച്ചയായും അല്ലാഹു ആദ്യം സൃഷ്ടിച്ചിട്ടുള്ളത് പേനയാണ്.">
                                        <x-app.ref-button slug="abu-dawood" number="4700" type="hadith"
                                            :ref="'അബു ദാവൂദ്:4700'" />
                                    </x-app.hadith-box>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-4">
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
