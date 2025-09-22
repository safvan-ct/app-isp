@extends('layouts.app')

@section('content')
    <x-app.topbar :title="$questions['title']" :url="route('questions.show', ['menu_slug' => 'topics', 'module_slug' => $questions['slug']])" />

    <div class="container my-3 pb-5">
        <x-app.banner :title="$questions['chapters'][$questionSlug]" :desc="$questions['desc']" :search="false" :author="'Author Name'" :review="date('M d, Y') . ' by Reviewer Name'" />

        <div class="row mt-4 notranslate">
            <div class="col-12 col-md-8">
                <x-app.study-card title="സുബഹ് (ഫജ്ർ)">
                    <x-slot:desc>
                        <x-app.ref-box>പുലർച്ചെ വെളിച്ചം മുതൽ സൂര്യോദയം വരെ.</x-app.ref-box>

                        <x-app.ref-box>
                            <strong class="text-emerald">നിർബന്ധം:</strong> 2 റക്അത്.<br>
                            <strong>സുന്നത്:</strong> മുമ്പ് 2 റക്അത്.
                        </x-app.ref-box>
                    </x-slot:desc>
                </x-app.study-card>

                <x-app.study-card title="ളുഹർ">
                    <x-slot:desc>
                        <x-app.ref-box>
                            സൂര്യൻ ആകാശമദ്ധ്യത്തില്‍ നിന്ന് താഴേക്ക് പോകുമ്പോൾ മുതൽ ഒരു വസ്തുവിന്റെ നീളം അതിന്റെ നിഴലിന്റെ
                            നീളത്തിന് സമമാകുന്നത് വരെ.
                        </x-app.ref-box>

                        <x-app.ref-box>
                            <strong class="text-emerald">നിർബന്ധം:</strong> 4 റക്അത്.<br>
                            <strong>സുന്നത്:</strong> മുമ്പ് 4 റക്അത്, ശേഷം 2 റക്അത്.
                        </x-app.ref-box>
                    </x-slot:desc>
                </x-app.study-card>

                <x-app.study-card title="അസർ">
                    <x-slot:desc>
                        <x-app.ref-box>
                            ഒരു വസ്തുവിന്റെ നീളം അതിന്റെ നിഴലിന്റെ നീളത്തിന് സമമാകുന്നത് മുതൽ സൂര്യാസ്തമയം വരെ.
                        </x-app.ref-box>

                        <x-app.ref-box>
                            <strong class="text-emerald">നിർബന്ധം:</strong> 4 റക്അത്
                        </x-app.ref-box>
                    </x-slot:desc>
                </x-app.study-card>

                <x-app.study-card title="മകരിബ്">
                    <x-slot:desc>
                        <x-app.ref-box>സൂര്യാസ്തമയം മുതൽ ചുവന്ന വെളിച്ചം ഇല്ലാതാകുന്നത് വരെ.</x-app.ref-box>

                        <x-app.ref-box>
                            <strong class="text-emerald">നിർബന്ധം:</strong> 3 റക്അത്<br>
                            <strong>സുന്നത്:</strong> ശേഷം 2 റക്അത്
                        </x-app.ref-box>
                    </x-slot:desc>
                </x-app.study-card>

                <x-app.study-card title="ഇശാ">
                    <x-slot:desc>
                        <x-app.ref-box>ചുവന്ന വെളിച്ചം ഇല്ലാതാകുന്നത് മുതൽ അർദ്ധരാത്രി വരെ.</x-app.ref-box>

                        <x-app.ref-box>
                            <strong class="text-emerald">നിർബന്ധം:</strong> 4 റക്അത്<br>
                            <strong>സുന്നത്:</strong> ശേഷം 2 റക്അത്
                        </x-app.ref-box>
                    </x-slot:desc>
                </x-app.study-card>

                <x-app.content :title="__('app.quran') . ' & ' . __('app.hadith') . ' വിശകലനങ്ങൾ'">
                    <x-app.hadith-box class="mb-1 notranslate" text="നമസ്കാര സമയങ്ങൾ:">
                        <x-app.ref-button class="mb-1" slug="17" number="78" type="quran" :ref="__('app.quran') . ' 17:78'" />
                        <x-app.ref-button class="mb-1" slug="11" number="114" type="quran" :ref="__('app.quran') . ' 17:114'" />

                        <x-app.ref-button class="mb-1" slug="sahih-bukhari" number="541" type="hadith"
                            ref="ബുഖാരി:541" />
                        <x-app.ref-button class="mb-1" slug="sahih-bukhari" number="556" type="hadith"
                            ref="ബുഖാരി:556" />

                        <x-app.ref-button class="mb-1" slug="sahih-muslim" number="1385" type="hadith"
                            ref="മുസ്ലിം:1385" />
                        <x-app.ref-button class="mb-1" slug="sahih-muslim" number="1388" type="hadith"
                            ref="മുസ്ലിം:1388" />
                        <x-app.ref-button class="mb-1" slug="sahih-muslim" number="1389" type="hadith"
                            ref="മുസ്ലിം:1389" />

                        <x-app.ref-button class="mb-1" slug="al-tirmidhi" number="149" type="hadith"
                            ref="അൽ-തിർമിധി:149" />
                        <x-app.ref-button class="mb-1" slug="al-tirmidhi" number="151" type="hadith"
                            ref="അൽ-തിർമിധി:151" />
                        <x-app.ref-button class="mb-1" slug="al-tirmidhi" number="152" type="hadith"
                            ref="അൽ-തിർമിധി:152" />
                    </x-app.hadith-box>

                    <x-app.hadith-box class="mb-1" text="നമസ്കാരം ആദ്യ സമയങ്ങളിൽ നമസ്കരിക്കുക.">
                        <x-app.ref-button class="mb-1" slug="sahih-bukhari" number="527" type="hadith"
                            ref="ബുഖാരി:527" />
                    </x-app.hadith-box>

                    <x-app.hadith-box class="mb-1 notranslate" text="റക്അത്തുകളുടെ എണ്ണം:">
                        <x-app.ref-button class="mb-1" slug="sahih-bukhari" number="1089" type="hadith"
                            ref="ബുഖാരി:1089" />
                        <x-app.ref-button class="mb-1" slug="sahih-bukhari" number="1091" type="hadith"
                            ref="ബുഖാരി:1091" />
                        <x-app.ref-button class="mb-1" slug="sahih-bukhari" number="1109" type="hadith"
                            ref="ബുഖാരി:1109" />

                        <x-app.ref-button class="mb-1" slug="sahih-muslim" number="1581" type="hadith"
                            ref="മുസ്ലിം:1581" />
                        <x-app.ref-button class="mb-1" slug="sahih-muslim" number="1582" type="hadith"
                            ref="മുസ്ലിം:1582" />
                        <x-app.ref-button class="mb-1" slug="sahih-muslim" number="1688" type="hadith"
                            ref="മുസ്ലിം:1688" />
                        <x-app.ref-button class="mb-1" slug="sahih-muslim" number="1689" type="hadith"
                            ref="മുസ്ലിം:1689" />
                    </x-app.hadith-box>

                    <x-app.hadith-box class="mb-1"
                        text="അല്ലാഹു നിങ്ങളുടെ ദൂതന്റെ നാവിലൂടെ നമസ്‌കരിക്കാൻ അല്ലാഹു നിർബന്ധമാക്കിയിരിക്കുന്നു, യാത്രക്കാരന് രണ്ട് റക്അത്തും, താമസക്കാരന് നാല് റക്അത്തും, ഭയത്തിന്റെ സമയത്ത് ഒരു റക്അത്തും.">
                        <x-app.ref-button class="mb-1" slug="sahih-muslim" number="1575" type="hadith"
                            ref="മുസ്ലിം:1575" />
                        <x-app.ref-button class="mb-1" slug="sahih-muslim" number="1576" type="hadith"
                            ref="മുസ്ലിം:1576" />
                    </x-app.hadith-box>

                    <x-app.hadith-box class="mb-1 notranslate" text="സുന്നത്ത് നമസ്കാരങ്ങൾ:">
                        <x-app.ref-button class="mb-1" slug="sahih-muslim" number="1687" type="hadith"
                            ref="മുസ്ലിം:1687" />
                        <x-app.ref-button class="mb-1" slug="al-tirmidhi" number="415" type="hadith"
                            ref="അൽ-തിർമിധി:415" />
                        <x-app.ref-button class="mb-1" slug="abu-dawood" number="1251" type="hadith"
                            ref="അബു ദാവൂദ്:1251" />
                    </x-app.hadith-box>
                </x-app.content>
            </div>

            <div class="col-12 col-md-4 mb-4">
                <x-app.related-topics :data="$questions['chapters']" :current="$questionSlug" :menu_slug="'topics'" :module_slug="$questions['slug']" />
            </div>
        </div>
    </div>
@endsection
