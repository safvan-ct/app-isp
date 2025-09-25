@extends('layouts.app')

@section('content')
    <x-app.topbar :title="$questions['title']" :url="route('questions.show', ['menu_slug' => 'topics', 'module_slug' => $questions['slug']])" />

    <div class="container my-3 pb-5">
        <x-app.banner :title="$questions['chapters'][$questionSlug]" :desc="$questions['desc']" :search="false" />

        <div class="row mt-4 notranslate">
            <div class="col-12 col-md-8">
                <x-app.study-card :title="'ഏതൊരു ആരാധനയും രണ്ട് നിബന്ധനകൾ ഒത്താലല്ലാതെ സ്വീകരിക്കപ്പെടുകയില്ല.'">
                    <h6 class="text-accent-900 fw-bold m-0 mb-1 mt-2">1. ഇഖ്ലാസ്</h6>
                    <p class="m-0 mb-2">
                        ആരാധനകളെല്ലാം അല്ലാഹുവിന് വേണ്ടി മാത്രമായിരിക്കൽ അഥവാ അവന്റെ പൊരുത്തവും പ്രീതിയും മാത്രം
                        ഉദ്ദേശിച്ചുള്ളതായിരിക്കല്‍.
                    </p>
                    <x-app.quran-box
                        text="ഖുർആനിൽ നിരവധി സ്ഥലങ്ങളിൽ ആരാധന മാത്രം അല്ലാഹുവിനുവേണ്ടി ആയിരിക്കണമെന്ന് വ്യക്തമാക്കുന്നു.">
                        <x-app.ref-button class="mb-1" slug="98" number="5" type="quran" :ref="__('app.quran') . ' 98:5'" />
                        <x-app.ref-button class="mb-1" slug="6" number="162" type="quran" :ref="__('app.quran') . ' 6:162'" />
                        <x-app.ref-button class="mb-1" slug="6" number="163" type="quran" :ref="__('app.quran') . ' 6:163'" />
                        <x-app.ref-button class="mb-1" slug="67" number="2" type="quran" :ref="__('app.quran') . ' 67:2'" />
                    </x-app.quran-box>

                    <h6 class="text-accent-900 fw-bold m-0 mb-1 mt-3">2. സുന്നത്ത്</h6>
                    <p class="m-0 mb-2">ആരാധനകളെല്ലാം അല്ലാഹുവിന്റെ റസൂലിന്റെ(സ്വ) ചര്യക്കനുസരിച്ചായിരിക്കൽ.</p>
                    <x-app.hadith-box
                        text="ആരാധനകളെല്ലാം നബിയുടെ(സ്വ) സുന്നത്തനുസരിച്ചായിരിക്കണം നി൪വ്വഹിക്കേണ്ടത്. നമസ്കാരത്തിന്റെ കാര്യത്തില്‍ അത് നബി(സ്വ) പ്രത്യേകം ഉണ൪ത്തിയിട്ടുമുണ്ട്.">
                        <x-app.ref-button class="mb-1" slug="sahih-bukhari" number="631" type="hadith"
                            :ref="'ബുഖാരി:631'" />
                        <x-app.ref-button class="mb-1" slug="sahih-bukhari" number="6008" type="hadith"
                            :ref="'ബുഖാരി:6008'" />
                        <x-app.ref-button class="mb-1" slug="sahih-bukhari" number="7246" type="hadith"
                            :ref="'ബുഖാരി:7246'" />
                    </x-app.hadith-box>
                </x-app.study-card>

                <x-app.study-card :title="'നമസ്കാരം സ്വീകാര്യമാകാനുള്ള നിബന്ധനകൾ മൂന്നെണ്ണമാകുന്നു.'">
                    <h6 class="text-accent-900 fw-bold m-0 mb-1 mt-2">1. ഇസ്‌ലാം (മുസ്ലിം ആയിരിക്കണം)</h6>
                    <p class="m-0 mb-2">
                        നമസ്കാരം ഉള്‍പ്പടെയുള്ള ഏത് ക൪മ്മവും അല്ലാഹു സ്വീകരിക്കണമെങ്കില്‍ രണ്ട് ശഹാദത്തുകള്‍
                        അംഗീകരിച്ചുകൊണ്ട് ഇസ്ലാമില്‍ പ്രവേശിച്ചിരിക്കണം. അല്ലാത്തവരുടെ ക൪മ്മങ്ങള്‍ അല്ലാഹു
                        സ്വീകരിക്കുകയില്ല.
                    </p>
                    <x-app.quran-box text="ഖുർആൻ വിശകലനങ്ങൾ" class="mb-1">
                        <x-app.ref-button class="mb-1" slug="3" number="19" type="quran" :ref="__('app.quran') . ' 3:19'" />
                        <x-app.ref-button class="mb-1" slug="3" number="85" type="quran" :ref="__('app.quran') . ' 3:85'" />
                        <x-app.ref-button class="mb-1" slug="17" number="19" type="quran" :ref="__('app.quran') . ' 17:19'" />
                        <x-app.ref-button class="mb-1" slug="18" number="30" type="quran" :ref="__('app.quran') . ' 18:30'" />
                        <x-app.ref-button class="mb-1" slug="25" number="23" type="quran" :ref="__('app.quran') . ' 25:23'" />
                    </x-app.quran-box>
                    <x-app.hadith-box text="ഹദീസ് വിശകലനങ്ങൾ.">
                        <x-app.ref-button class="mb-1" slug="sahih-muslim" number="246" type="hadith"
                            :ref="'മുസ്ലിം:246'" />
                    </x-app.hadith-box>

                    <h6 class="text-accent-900 fw-bold m-0 mb-1 mt-3">2. ബുദ്ധി</h6>
                    <p class="m-0 mb-2">
                        മൂന്ന് ആളുകളില്‍ നിന്ന് അവരുടെ പ്രവൃത്തികൾ രേഖപ്പെടുത്തിയിട്ടില്ല: 1) ബുദ്ധിഭ്രമം ബാധിച്ചവന്‍, അവന്
                        സ്വബോധം ഉണ്ടാകുന്നതുവരെ 2) ഉറങ്ങുന്നവ൪, ഉണരുന്നതുവരെ 3) ചെറിയ കുട്ടി പ്രായപൂ൪ത്തിയാകുന്നതുവരെ.
                    </p>
                    <x-app.hadith-box text="ഹദീസ് വിശകലനങ്ങൾ.">
                        <x-app.ref-button class="mb-1" slug="al-tirmidhi" number="1423" type="hadith"
                            :ref="'അൽ-തിർമിധി:1423'" />
                        <x-app.ref-button class="mb-1" slug="abu-dawood" number="4401" type="hadith"
                            :ref="'അബു ദാവൂദ്:4401'" />
                        <x-app.ref-button class="mb-1" slug="abu-dawood" number="4403" type="hadith"
                            :ref="'അബു ദാവൂദ്:4403'" />
                    </x-app.hadith-box>

                    <h6 class="text-accent-900 fw-bold m-0 mb-1 mt-3">3. വകതിരിവ് (പ്രായപൂ൪ത്തിയാകുക)</h6>
                    <p class="m-0 mb-2">
                        നിങ്ങളുടെ കുട്ടികൾക്ക് ഏഴ് വയസ്സാകുമ്പോൾ നിങ്ങൾ അവരോട് നമസ്കരിക്കാൻ കൽപ്പിക്കുക, പത്ത്
                        വയസ്സാകുമ്പോൾ അതിനായി അവരെ ശിക്ഷിക്കുക.
                    </p>
                    <x-app.hadith-box text="ഹദീസ് വിശകലനങ്ങൾ.">
                        <x-app.ref-button class="mb-1" slug="al-tirmidhi" number="1423" type="hadith"
                            :ref="'അൽ-തിർമിധി:1423'" />
                        <x-app.ref-button class="mb-1" slug="abu-dawood" number="495" type="hadith"
                            :ref="'അബു ദാവൂദ്:495'" />
                        <x-app.ref-button class="mb-1" slug="abu-dawood" number="4401" type="hadith"
                            :ref="'അബു ദാവൂദ്:4401'" />
                        <x-app.ref-button class="mb-1" slug="abu-dawood" number="4403" type="hadith"
                            :ref="'അബു ദാവൂദ്:4403'" />
                    </x-app.hadith-box>
                </x-app.study-card>

                <x-app.study-card :title="'നമസ്കാരം ശരി ആവാനുള്ള നിബന്ധനകൾ ആറെണ്ണമാകുന്നു.'">
                    <h6 class="text-accent-900 fw-bold m-0 mb-1 mt-2">1. സമയമാകുക</h6>
                    <p class="m-0 mb-2">
                        ഓരോ നമസ്കാരത്തിന്റെയും സമയം ആയാല്‍ മാത്രമേ പ്രസ്തുത നമസ്കാരം നി൪വ്വഹിക്കാന്‍ പാടുള്ളൂ.
                        അതല്ലാതെയുള്ള നമസ്കാരം സ്വീകരിക്കപ്പെടുകയില്ല.
                    </p>
                    <x-app.quran-box
                        text="നമസ്കാരം സത്യവിശ്വാസികള്‍ക്ക് സമയം നിര്‍ണയിക്കപ്പെട്ട ഒരു നിര്‍ബന്ധബാധ്യതയാകുന്നു">
                        <x-app.ref-button class="mb-1" slug="4" number="103" type="quran"
                            :ref="__('app.quran') . ' 4:103'" />
                    </x-app.quran-box>

                    <h6 class="text-accent-900 fw-bold m-0 mb-2 mt-3">
                        2. വലുതും ചെറുതുമായ അശുദ്ധികളില്‍ നിന്നും ശുദ്ധിയാകുക
                    </h6>
                    <p class="m-0 mb-2">
                        ശുദ്ധിയില്ലാതെയുള്ള നമസ്കാരം അല്ലാഹു സ്വീകരിക്കുകയില്ല. ശുദ്ധി നമസ്കാരത്തിന്റെ ശ൪ത്വില്‍ പെട്ടതാണ്.
                    </p>
                    <x-app.quran-box text="ഖുർആൻ വിശകലനങ്ങൾ" class="mb-1">
                        <x-app.ref-button class="mb-1" slug="5" number="6" type="quran"
                            :ref="__('app.quran') . ' 5:6'" />
                    </x-app.quran-box>
                    <x-app.hadith-box text="ഹദീസ് വിശകലനങ്ങൾ.">
                        <x-app.ref-button class="mb-1" slug="sahih-bukhari" number="6954" type="hadith"
                            :ref="'ബുഖാരി:6954'" />
                        <x-app.ref-button class="mb-1" slug="sahih-bukhari" number="320" type="hadith"
                            :ref="'ബുഖാരി:320'" />
                        <x-app.ref-button class="mb-1" slug="sahih-bukhari" number="135" type="hadith"
                            :ref="'ബുഖാരി:135'" />
                        <x-app.ref-button class="mb-1" slug="sahih-bukhari" number="348" type="hadith"
                            :ref="'ബുഖാരി:348'" />
                        <x-app.ref-button class="mb-1" slug="sahih-muslim" number="535" type="hadith"
                            :ref="'മുസ്ലിം:535'" />
                        <x-app.ref-button class="mb-1" slug="sahih-muslim" number="537" type="hadith"
                            :ref="'മുസ്ലിം:537'" />
                        <x-app.ref-button class="mb-1" slug="abu-dawood" number="61" type="hadith"
                            :ref="'അബു ദാവൂദ്:61'" />
                    </x-app.hadith-box>

                    <h6 class="text-accent-900 fw-bold m-0 mt-3 mb-2">
                        3. നമസ്കാര സ്ഥലം, നമസ്കരിക്കുന്നവന്റെ വസ്ത്രം, ശരീരം എന്നിവ നജസില്‍ നിന്നും ശുദ്ധിയായിരിക്കുക
                    </h6>
                    <p class="m-0 mb-1">
                        <strong>നമസ്കാര സ്ഥലം: </strong>നമസ്കാര സ്ഥലം എല്ലാവിധ നജസില്‍ നിന്നും ശുദ്ധിയായിരിക്കണം
                    </p>
                    <x-app.hadith-box text="ഹദീസ് വിശകലനങ്ങൾ.">
                        <x-app.ref-button class="mb-1" slug="sahih-bukhari" number="220" type="hadith"
                            :ref="'ബുഖാരി:220'" />
                    </x-app.hadith-box>

                    <p class="m-0 mb-1 mt-3">
                        <strong>നമസ്കരിക്കുന്നവന്റെ വസ്ത്രം: </strong>നമസ്കരിക്കുന്നവരുടെ വസ്ത്രം നജസില്‍ നിന്ന്
                        മുക്തമായിരിക്കല്‍ നി൪ബന്ധമാണ്. ഭക്ഷണം കഴിക്കാത്ത ആണ്‍കുട്ടിയുടെ മൂത്രം വസ്ത്രത്തില്‍ വീണാല്‍
                        വൃത്തിയാക്കുന്നതിന് വേണ്ടി അതില്‍ വെള്ളം കുടയുകയും പെണ്‍കുട്ടിയുടെ മൂത്രം വസ്ത്രത്തില്‍ വീണാല്‍ അത്
                        കഴുകുകയുമാണ് വേണ്ടത്.
                    </p>
                    <x-app.quran-box text="ഖുർആൻ വിശകലനങ്ങൾ" class="mb-1">
                        <x-app.ref-button class="mb-1" slug="74" number="4" type="quran"
                            :ref="__('app.quran') . ' 74:4'" />
                    </x-app.quran-box>
                    <x-app.hadith-box text="ഹദീസ് വിശകലനങ്ങൾ.">
                        <x-app.ref-button class="mb-1" slug="sahih-bukhari" number="227" type="hadith"
                            :ref="'ബുഖാരി:227'" />
                        <x-app.ref-button class="mb-1" slug="al-tirmidhi" number="610" type="hadith"
                            :ref="'അൽ-തിർമിധി:610'" />
                        <x-app.ref-button class="mb-1" slug="ibn-e-majah" number="522" type="hadith"
                            :ref="'ഇബ്നുമാജ :522'" />
                    </x-app.hadith-box>

                    <p class="m-0 mb-1 mt-3">
                        <strong>നമസ്കരിക്കുന്നവന്റെ ശരീരം: </strong>നമസ്കരിക്കുന്ന വ്യക്തി എല്ലാവിധ നജസില്‍ നിന്നും
                        വൃത്തിയാകല്‍ നി൪ബന്ധമാണ്. മലമൂത്ര വസ൪ജ്ജനത്തിന് ശേഷം ശൌച്യം ചെയ്യല്‍, മദിയ്യ് കഴുകല്‍ എന്നിവ
                        ശരീരത്തിലെ നജസിനെ നീക്കുന്നതിനുള്ള മാ൪ഗങ്ങളാണ്.
                    </p>
                    <x-app.hadith-box text="ഹദീസ് വിശകലനങ്ങൾ.">
                        <x-app.ref-button class="mb-1" slug="sahih-bukhari" number="152" type="hadith"
                            :ref="'ബുഖാരി:152'" />
                        <x-app.ref-button class="mb-1" slug="abu-dawood" number="41" type="hadith"
                            :ref="'അബു ദാവൂദ്:41'" />
                    </x-app.hadith-box>

                    <h6 class="text-accent-900 fw-bold m-0 mt-3 mb-2">4. ഔറത്ത് (നഗ്നത) മറക്കുക.</h6>
                    <p class="m-0 mb-1">
                        ശരീരത്തിന്റെ തൊലി പുറത്ത് കാണാത്ത രീതിയിലാണ് വസ്ത്രം കൊണ്ട് ഔറത്ത് മറക്കേണ്ടത്. ഔറത്ത് മറക്കാന്‍
                        കഴിവുണ്ടായിട്ടും മറക്കാതെ നമസ്കരിച്ചവന്റെ നമസ്കാരം ഫാസിദാണ് എന്നതില്‍ പണ്ഢിതന്‍മാ൪
                        ഏകോപിച്ചിട്ടുണ്ട്. പുരുഷന്റെ ഔറത്ത് പൊക്കിള്‍ മുതല്‍ മുട്ട് വരെയാകുന്നു. എന്നാല്‍ അവന്റെ
                        ചുമലും കൂടി മറയുന്ന വസ്ത്രം ധരിച്ചാണ് നമസ്കാരിക്കേണ്ടത്. സ്ത്രീകള്‍ അവരുടെ മുഖവും മുന്‍കൈയും
                        ഒഴികെയുള്ള ഭാഗങ്ങളെല്ലാം മറയുന്ന വസ്ത്രം ധരിച്ചാണ് നമസ്കാരിക്കേണ്ടത്.
                    </p>
                    <x-app.quran-box text="ഖുർആൻ വിശകലനങ്ങൾ" class="mb-1">
                        <x-app.ref-button class="mb-1" slug="7" number="31" type="quran"
                            :ref="__('app.quran') . ' 7:31'" />
                    </x-app.quran-box>
                    <x-app.hadith-box text="ഹദീസ് വിശകലനങ്ങൾ.">
                        <x-app.ref-button class="mb-1" slug="sahih-bukhari" number="359" type="hadith"
                            :ref="'ബുഖാരി:359'" />
                        <x-app.ref-button class="mb-1 text-danger" slug="abu-dawood" number="640" type="hadith"
                            :ref="'അബു ദാവൂദ്:640'" />
                        <x-app.ref-button class="mb-1" slug="abu-dawood" number="641" type="hadith"
                            :ref="'അബു ദാവൂദ്:641'" />
                        <x-app.ref-button class="mb-1" slug="abu-dawood" number="4014" type="hadith"
                            :ref="'അബു ദാവൂദ്:4014'" />
                        <x-app.ref-button class="mb-1" slug="al-tirmidhi" number="2796" type="hadith"
                            :ref="'അൽ-തിർമിധി:2796'" />
                        <x-app.ref-button slug="ibn-e-majah" number="655" type="hadith" :ref="'ഇബ്‍ൻ മാജഹ്:655'" />
                    </x-app.hadith-box>

                    <h6 class="text-accent-900 fw-bold m-0 mt-3 mb-2">5. ഖിബ്‌’ലക്ക് മുന്നിടുക.</h6>
                    <p class="m-0 mb-1">
                        നമസ്കാരം നി൪ബന്ധമാക്കിയ സമയത്ത് ബൈത്തുല്‍ മുഖദ്ദസായിരുന്നു ഖിബ്’ലയായി നിശ്ചയിച്ചിരുന്നത്. എന്നാല്‍
                        പിന്നീട് അല്ലാഹു കഅ്ബയെ ഖിബ്’ലയാക്കി നിശ്ചയിച്ചു.
                    </p>
                    <x-app.quran-box text="ഖുർആൻ വിശകലനങ്ങൾ" class="mb-1">
                        <x-app.ref-button class="mb-1" slug="2" number="144" type="quran"
                            :ref="__('app.quran') . ' 2:144'" />
                        <x-app.ref-button class="mb-1" slug="2" number="149" type="quran"
                            :ref="__('app.quran') . ' 2:149'" />
                        <x-app.ref-button class="mb-1" slug="2" number="150" type="quran"
                            :ref="__('app.quran') . ' 2:150'" />
                    </x-app.quran-box>
                    <x-app.hadith-box text="ഹദീസ് വിശകലനങ്ങൾ.">
                        <x-app.ref-button class="mb-1" slug="sahih-bukhari" number="399" type="hadith"
                            :ref="'ബുഖാരി:399'" />
                        <x-app.ref-button class="mb-1" slug="sahih-bukhari" number="403" type="hadith"
                            :ref="'ബുഖാരി:403'" />
                        <x-app.ref-button class="mb-1" slug="sahih-muslim" number="886" type="hadith"
                            :ref="'മുസ്ലിം:886'" />
                    </x-app.hadith-box>

                    <h6 class="text-accent-900 fw-bold m-0 mt-3 mb-2">6. നിയ്യത്ത്.</h6>
                    <p class="m-0 mb-1">
                        നമസ്കാരത്തിന്റെ ശ൪ത്വുകളില്‍ പെട്ടതാണ് നിയ്യത്ത്. ഓരോ ക൪മ്മങ്ങളും സ്വീകരിക്കപ്പെടുക നിയ്യത്തിന്റെ
                        അടിസ്ഥാനത്തിലാകുന്നു.
                    </p>
                    <x-app.quran-box
                        text="പ്രാര്‍ത്ഥനകള്‍ (അഥവാ നമസ്കാരങ്ങള്‍) നിങ്ങള്‍ സൂക്ഷ്മതയോടെ നിര്‍വഹിച്ചു പോരേണ്ടതാണ്‌."
                        class="mb-1">
                        <x-app.ref-button class="mb-1" slug="23" number="2" type="quran"
                            :ref="__('app.quran') . ' 23:2'" />
                        <x-app.ref-button class="mb-1" slug="2" number="238" type="quran"
                            :ref="__('app.quran') . ' 2:238'" />
                    </x-app.quran-box>
                    <x-app.hadith-box text="ഹദീസ് വിശകലനങ്ങൾ.">
                        <x-app.ref-button class="mb-1" slug="sahih-bukhari" number="1" type="hadith"
                            :ref="'ബുഖാരി:1'" />
                        <x-app.ref-button class="mb-1" slug="sahih-muslim" number="4927" type="hadith"
                            :ref="'മുസ്ലിം:4927'" />
                    </x-app.hadith-box>
                </x-app.study-card>

                <x-app.ref-box class="mt-3 mb-4">
                    <p class="m-0 text-center">
                        മേല്‍ പറഞ്ഞിട്ടുള്ള ശ൪ത്വുകളില്‍ ഏതെങ്കിലും ഒന്നിന് ഭംഗം വന്നാല്‍ നമസ്കാരം
                        ശരിയാകുകയില്ലെന്നുള്ളത് പ്രത്യേകം മനസ്സിലാക്കുക.
                    </p>
                </x-app.ref-box>
            </div>

            <div class="col-12 col-md-4 mb-4">
                <x-app.related-topics :data="$questions['chapters']" :current="$questionSlug" :menu_slug="'topics'" :module_slug="$questions['slug']" />
            </div>
        </div>
    </div>
@endsection
