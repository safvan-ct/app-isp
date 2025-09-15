@extends('layouts.app')

@section('content')
    <x-app.topbar :title="$questions['title']" :url="route('questions.show', ['menu_slug' => 'topics', 'module_slug' => $questions['slug']])" />

    <div class="container my-3 pb-5">
        <x-app.banner :title="$questions['chapters'][$questionSlug]" :desc="$questions['desc']" :search="false" />

        <div class="row mt-4">
            <div class="col-12 col-md-8">
                <x-app.content :title="'നമസ്കാരം സ്വീകാര്യമാകാനുള്ള നിബന്ധനകൾ മൂന്നെണ്ണം ആവുന്നു.'">
                    <h6 class="text-accent-900 fw-bold m-0 mb-2 mt-3">1. ഇസ്‌ലാം (മുസ്ലിം ആയിരിക്കണം)</h6>
                    <x-app.hadith-box class="mb-2" reference="മുസ്ലിം: 246">
                        <x-slot:text>
                            മനുഷ്യർക്കിടയിലും ബഹുദൈവാരാധനയ്ക്കും അവിശ്വാസത്തിനും ഇടയിലും പ്രാർത്ഥനയുടെ അശ്രദ്ധയാണ്.
                        </x-slot:text>
                    </x-app.hadith-box>

                    <h6 class="text-accent-900 fw-bold m-0 mb-2 mt-3">2. ബുദ്ധിശക്തി</h6>
                    <x-app.hadith-box class="mb-2" reference="അബു ദാവൂദ്:4403, അൽ-തിർമിധി:1423">
                        <x-slot:text>
                            മൂന്ന് (ആളുകൾ) അവരുടെ പ്രവൃത്തികൾ രേഖപ്പെടുത്തിയിട്ടില്ല: അവൻ ഉണരുന്നതുവരെ ഉറങ്ങുന്നവൻ,
                            പ്രായപൂർത്തിയാകുന്നതുവരെ ഒരു ആൺകുട്ടി, അവൻ യുക്തിസഹമായി വരുന്നത് വരെ ഒരു ഭ്രാന്തൻ.
                        </x-slot:text>
                    </x-app.hadith-box>

                    <h6 class="text-accent-900 fw-bold m-0 mt-3 mb-2">3. പ്രായപൂർത്തി</h6>
                    <x-app.hadith-box class="mb-2" reference="അബു ദാവൂദ്: 495">
                        <x-slot:text>
                            നിങ്ങളുടെ കുട്ടികൾക്ക് ഏഴ് വയസ്സാകുമ്പോൾ നിങ്ങൾ അവരോട് നമസ്കരിക്കാൻ കൽപ്പിക്കുക, പത്ത്
                            വയസ്സാകുമ്പോൾ അതിനായി അവരെ ശിക്ഷിക്കുക.
                        </x-slot:text>
                    </x-app.hadith-box>
                </x-app.content>

                <x-app.content :title="'നമസ്കാരം ശരി ആവാനുള്ള നിബന്ധനകൾ അഞ്ചെണ്ണം ആവുന്നു.'">
                    <h6 class="text-accent-900 fw-bold m-0 mb-2 mt-3">1. അശുദ്ധമായ അവസ്ഥയില്‍നിന്നും ശരീരം ശുദ്ധമായിരിക്കുക
                    </h6>
                    <x-app.quran-box class="mb-2" reference="5:6">
                        <x-slot:text>
                            സത്യവിശ്വാസികളേ, നിങ്ങള്‍ നമസ്കാരത്തിന് ഒരുങ്ങിയാല്‍, നിങ്ങളുടെ മുഖങ്ങളും, മുട്ടുവരെ രണ്ടുകൈകളും
                            കഴുകുകയും, നിങ്ങളുടെ തല തടവുകയും നെരിയാണിവരെ രണ്ട് കാലുകള്‍ കഴുകുകയും ചെയ്യുക(വുദു). നിങ്ങള്‍
                            ജനാബത്ത് (വലിയ അശുദ്ധി) ബാധിച്ചവരായാല്‍ നിങ്ങള്‍ (കുളിച്ച്‌) ശുദ്ധിയാകുക.
                        </x-slot:text>
                    </x-app.quran-box>
                    <x-app.hadith-box class="mb-2" reference="ബുഖാരി:6954">
                        <x-slot:text>അല്ലാഹു വുദൂ ഇല്ലാതെ ആരുടെയും നിസ്‌കാരം സ്വീകരിക്കുകയില്ല.</x-slot:text>
                    </x-app.hadith-box>

                    <h6 class="text-accent-900 fw-bold m-0 mt-3 mb-2">
                        2. ശരീരവും വസ്ത്രവും നമസ്‌കരിക്കുന്ന സ്ഥലവും മാലിന്യത്തില്‍നിന്ന് ശുദ്ധമായിരിക്കുക.
                    </h6>
                    <x-app.quran-box class="mb-2" reference="74:4-5">
                        <x-slot:text>നിന്‍റെ വസ്ത്രങ്ങള്‍ ശുദ്ധിയാക്കുകയും പാപം വെടിയുകയും ചെയ്യുക.</x-slot:text>
                    </x-app.quran-box>

                    <h6 class="text-accent-900 fw-bold m-0 mt-3 mb-2">3. ഔറത്ത് മറയ്ക്കുക.</h6>
                    <x-app.quran-box class="mb-2" reference="7:31">
                        <x-slot:text>
                            ആദം സന്തതികളേ, എല്ലാ ആരാധനാലയത്തിങ്കലും (അഥവാ എല്ലാ ആരാധനാവേളകളിലും) നിങ്ങള്‍ക്ക്
                            അലങ്കാരമായിട്ടുള്ള വസ്ത്രങ്ങള്‍ ധരിച്ചുകൊള്ളുക.
                        </x-slot:text>
                    </x-app.quran-box>

                    <h6 class="text-accent-900 fw-bold m-0 mt-3 mb-2">4. നമസ്‌കാരത്തിന് സമയം ആയിട്ടുണ്ടെന്ന് അറിയുക.</h6>
                    <x-app.quran-box class="mb-2" reference="4:103">
                        <x-slot:text>
                            തീര്‍ച്ചയായും നമസ്കാരം സത്യവിശ്വാസികള്‍ക്ക് സമയം നിര്‍ണയിക്കപ്പെട്ട ഒരു നിര്‍ബന്ധബാധ്യതയാകുന്നു.
                        </x-slot:text>
                    </x-app.quran-box>

                    <h6 class="text-accent-900 fw-bold m-0 mt-3 mb-2">5. ഖിബ്‌ലയെ അഭിമുഖീകരിക്കുക.</h6>
                    <x-app.quran-box class="mb-2" reference="2:144,149-150">
                        <x-slot:text>
                            ഏതൊരിടത്ത് നിന്ന് നീ പുറപ്പെടുകയാണെങ്കിലും മസ്ജിദുല്‍ ഹറാമിന്റെ നേര്‍ക്ക് (പ്രാര്‍ത്ഥനാവേളയില്‍)
                            നിന്റെ മുഖം തിരിക്കേണ്ടതാണ്‌.
                        </x-slot:text>
                    </x-app.quran-box>
                </x-app.content>
            </div>

            <div class="col-12 col-md-4">
                <h5 class="text-emerald fw-bold mt-3">Related Topics</h5>
                @foreach ($questions['chapters'] as $item)
                    @continue($questionSlug == $loop->index)

                    <x-app.topic-chapter :title="$loop->index + 1 . ' : ' . $item" :url="route('answers.show', [
                        'menu_slug' => 'topics',
                        'module_slug' => $questions['slug'],
                        'question_slug' => $loop->index,
                    ])" :related="true" />
                @endforeach
            </div>
        </div>
    </div>
@endsection
