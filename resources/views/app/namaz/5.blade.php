@extends('layouts.app')

@section('content')
    <x-app.topbar :title="$questions['title']" :url="route('questions.show', ['menu_slug' => 'topics', 'module_slug' => $questions['slug']])" />

    <div class="container my-3 pb-5">
        <x-app.banner :title="$questions['chapters'][$questionSlug]" :desc="$questions['desc']" :search="false" :author="'Author Name'" :review="date('M d, Y') . ' by Reviewer Name'" />

        <div class="row mt-4 notranslate">
            <div class="col-12 col-md-8">
                <x-app.study-card :title="'ജമാഅത്തിന്റെ ശ്രേഷ്ഠത'">
                    <p class="m-0 mb-2">
                        ഒരാൾ ഒറ്റയ്ക്ക് നമസ്കരിക്കുന്നതിനേക്കാൾ ഇരുപത്തിയേഴ് ഇരട്ടി കൂടുതലാണ്
                    </p>
                    <x-app.quran-box text="ഖുർആൻ വിശകലനങ്ങൾ." class="mb-1">
                        <x-app.ref-button class="mb-1" slug="4" number="102" type="quran" :ref="__('app.quran') . ' 4:102'" />
                    </x-app.quran-box>

                    <x-app.hadith-box text="ഹദീസ് വിശകലനങ്ങൾ.">
                        <x-app.ref-button class="mb-1" slug="sahih-bukhari" number="649" type="hadith"
                            :ref="'ബുഖാരി:649'" />
                        <x-app.ref-button class="mb-1" slug="sahih-bukhari" number="655" type="hadith"
                            :ref="'ബുഖാരി:655'" />
                        <x-app.ref-button class="mb-1" slug="sahih-bukhari" number="2119" type="hadith"
                            :ref="'ബുഖാരി:2119'" />
                    </x-app.hadith-box>
                </x-app.study-card>

                <x-app.study-card :title="'ജമാഅത്തിൽ ഇമാമിന്റെ ബാധ്യത'">
                    <p class="m-0 mb-2">
                        നിങ്ങളിൽ അല്ലാഹുവിന്റെ ഗ്രന്ഥങ്ങളിൽ ഏറ്റവും അറിവുള്ളവൻ ജനങ്ങൾക്ക് ഇമാമായി പ്രവർത്തിക്കട്ടെ. നിങ്ങളിൽ
                        ആരെങ്കിലും ആളുകളെ നമസ്കാരത്തിന് നയിക്കുന്നുവെങ്കിൽ അവൻ അൽപ്പം മാത്രം സംസാരിക്കണം
                    </p>

                    <x-app.hadith-box text="ഹദീസ് വിശകലനങ്ങൾ.">
                        <x-app.ref-button class="mb-1" slug="abu-dawood" number="582" type="hadith"
                            :ref="'അബു ദാവൂദ്:582'" />
                        <x-app.ref-button class="mb-1" slug="sahih-muslim" number="1044" type="hadith"
                            :ref="'മുസ്ലിം:1044'" />
                        <x-app.ref-button class="mb-1" slug="sahih-muslim" number="1046" type="hadith"
                            :ref="'മുസ്ലിം:1046'" />
                    </x-app.hadith-box>
                </x-app.study-card>

                <x-app.study-card :title="'ജമാഅത്തിൽ പങ്കെടുക്കുന്നവർ ശ്രദ്ധിക്കേണ്ടത്'">
                    <p class="m-0 mb-2">
                        നമസ്കാരം ആരംഭിച്ചാൽ അതിനായി ഓടരുത്, മറിച്ച് ശാന്തമായി അതിനായി നടക്കുക, നിങ്ങൾക്ക് ലഭിക്കുന്നത്
                        നമസ്കരിക്കുക, നഷ്ടപ്പെട്ടത് പൂർത്തിയാക്കുക.
                    </p>

                    <x-app.hadith-box text="ഹദീസ് വിശകലനങ്ങൾ.">
                        <x-app.ref-button class="mb-1" slug="abu-dawood" number="572" type="hadith"
                            :ref="'അബു ദാവൂദ്:572'" />
                    </x-app.hadith-box>
                </x-app.study-card>

                <x-app.study-card :title="'സ്ത്രീകൾ പള്ളികളിൽ പോകുന്നത് (ജമാഅത്തിൽ പങ്കെടുക്കൽ)'">
                    <p class="m-0 mb-2">
                        നിങ്ങളുടെ സ്ത്രീകളെ പള്ളിയിൽ പോകുന്നത് നിങ്ങൾ തടയരുത്; എന്നാൽ അവരുടെ വീടുകളാണ് അവർക്ക് ഉത്തമം.
                    </p>

                    <x-app.hadith-box text="ഹദീസ് വിശകലനങ്ങൾ.">
                        <x-app.ref-button class="mb-1" slug="sahih-bukhari" number="900" type="hadith"
                            :ref="'ബുഖാരി:900'" />
                        <x-app.ref-button class="mb-1" slug="sahih-muslim" number="989" type="hadith"
                            :ref="'മുസ്ലിം:989'" />
                        <x-app.ref-button class="mb-1" slug="sahih-muslim" number="990" type="hadith"
                            :ref="'മുസ്ലിം:990'" />
                        <x-app.ref-button class="mb-1" slug="sahih-muslim" number="991" type="hadith"
                            :ref="'മുസ്ലിം:991'" />
                        <x-app.ref-button class="mb-1" slug="sahih-muslim" number="992" type="hadith"
                            :ref="'മുസ്ലിം:992'" />
                        <x-app.ref-button class="mb-1" slug="sahih-muslim" number="993" type="hadith"
                            :ref="'മുസ്ലിം:993'" />
                        <x-app.ref-button class="mb-1" slug="sahih-muslim" number="994" type="hadith"
                            :ref="'മുസ്ലിം:994'" />
                        <x-app.ref-button class="mb-1" slug="sahih-muslim" number="995" type="hadith"
                            :ref="'മുസ്ലിം:995'" />
                        <x-app.ref-button class="mb-1" slug="sahih-muslim" number="996" type="hadith"
                            :ref="'മുസ്ലിം:996'" />
                        <x-app.ref-button class="mb-1" slug="sahih-muslim" number="997" type="hadith"
                            :ref="'മുസ്ലിം:997'" />
                        <x-app.ref-button class="mb-1" slug="sahih-muslim" number="998" type="hadith"
                            :ref="'മുസ്ലിം:998'" />
                        <x-app.ref-button class="mb-1" slug="sahih-muslim" number="999" type="hadith"
                            :ref="'മുസ്ലിം:999'" />
                        <x-app.ref-button class="mb-1" slug="ibn-e-majah" number="15" type="hadith"
                            :ref="'ഇബ്‍ൻ മാജഹ്:15'" />
                        <x-app.ref-button class="mb-1" slug="abu-dawood" number="567" type="hadith"
                            :ref="'അബു ദാവൂദ്:567'" />
                    </x-app.hadith-box>
                </x-app.study-card>
            </div>

            <div class="col-12 col-lg-4">
                <x-app.related-topics :data="$questions['chapters']" :current="$questionSlug" :menu_slug="'topics'" :module_slug="$questions['slug']" />
            </div>
        </div>
    </div>
@endsection
