@extends('layouts.app')

@section('content')
    <x-app.topbar :title="$questions['title']" :url="route('questions.show', ['menu_slug' => 'topics', 'module_slug' => $questions['slug']])" />

    <div class="container my-3 pb-5">
        <x-app.banner :title="$questions['chapters'][$questionSlug]" :desc="$questions['desc']" :search="false" :author="'Author Name'" :review="date('M d, Y') . ' by Reviewer Name'" />

        <div class="row mt-4">
            <div class="col-12 col-md-8">
                <x-app.content :title="'ജമാഅത്തിന്റെ ശ്രേഷ്ഠത'">
                    <x-app.quran-box class="mt-2" reference="4:102">
                        <x-slot:text>
                            (നബിയേ,) നീ അവരുടെ കൂട്ടത്തിലുണ്ടായിരിക്കുകയും, അവര്‍ക്ക് നേതൃത്വം നല്‍കിക്കൊണ്ട് നമസ്കാരം
                            നിര്‍വഹിക്കുകയുമാണെങ്കില്‍ അവരില്‍ ഒരു വിഭാഗം നിന്‍റെ കൂടെ നില്‍ക്കട്ടെ.
                        </x-slot:text>
                    </x-app.quran-box>

                    <x-app.hadith-box class="mt-2" reference="ബുഖാരി:649">
                        <x-slot:text>
                            ഒരാൾ ഒറ്റയ്ക്ക് നമസ്കരിക്കുന്നതിനേക്കാൾ ഇരുപത്തിയേഴ് ഇരട്ടി കൂടുതലാണ്.
                        </x-slot:text>
                    </x-app.hadith-box>

                    <x-app.hadith-box class="mt-2" reference="ബുഖാരി:655">
                        <x-slot:text>
                            സൽകർമ്മങ്ങളിലേക്കുള്ള ഓരോ ചുവടും പ്രതിഫലം നൽകുന്നു.
                        </x-slot:text>
                    </x-app.hadith-box>

                    <x-app.hadith-box class="mt-2" reference="ബുഖാരി:2119">
                        <x-slot:text>
                            നമസ്കാരം ഒഴികെ മറ്റൊന്നും അവനെ പള്ളിയിലേക്ക് പോകാൻ പ്രേരിപ്പിക്കുന്നില്ലെങ്കിൽ, അവൻ
                            പള്ളിയിലേക്ക് എടുക്കുന്ന ഓരോ ചുവടുവയ്പ്പിലും ഒരു പദവി ഉയർത്തപ്പെടും.
                        </x-slot:text>
                    </x-app.hadith-box>
                </x-app.content>

                <x-app.content :title="'ജമാഅത്തിൽ ഇമാമിന്റെ ബാധ്യത'">
                    <x-app.hadith-box class="mt-2" reference="അബു ദാവൂദ്:582">
                        <x-slot:text>
                            നിങ്ങളിൽ അല്ലാഹുവിന്റെ ഗ്രന്ഥങ്ങളിൽ ഏറ്റവും അറിവുള്ളവൻ ജനങ്ങൾക്ക് ഇമാമായി പ്രവർത്തിക്കട്ടെ.
                        </x-slot:text>
                    </x-app.hadith-box>
                    <x-app.hadith-box class="mt-2" reference="മുസ്ലിം:1044,1046">
                        <x-slot:text>
                            നിങ്ങളിൽ ആരെങ്കിലും ആളുകളെ നമസ്കാരത്തിന് നയിക്കുന്നുവെങ്കിൽ അവൻ അൽപ്പം മാത്രം സംസാരിക്കണം
                        </x-slot:text>
                    </x-app.hadith-box>
                </x-app.content>

                <x-app.content :title="'ജമാഅത്തിൽ പങ്കെടുക്കുന്നവർ ശ്രദ്ധിക്കേണ്ടത്'">
                    <x-app.hadith-box class="mt-2" reference="ബുഖാരി:907, അബു ദാവൂദ്:572">
                        <x-slot:text>
                            നമസ്കാരം ആരംഭിച്ചാൽ അതിനായി ഓടരുത്, മറിച്ച് ശാന്തമായി അതിനായി നടക്കുക, നിങ്ങൾക്ക് ലഭിക്കുന്നത്
                            നമസ്കരിക്കുക, നഷ്ടപ്പെട്ടത് പൂർത്തിയാക്കുക.
                        </x-slot:text>
                    </x-app.hadith-box>
                </x-app.content>

                <x-app.content :title="'സ്ത്രീകൾ പള്ളികളിൽ പോകുന്നത് (ജമാഅത്തിൽ പങ്കെടുക്കൽ)'">
                    <x-app.hadith-box class="mt-2" reference="മുസ്ലിം:989-95, ബുഖാരി:900, ഇബ്‍ൻ മാജഹ്:15">
                        <x-slot:text>
                            നിങ്ങളുടെ സ്ത്രീകൾ പള്ളിയിൽ പോകുന്നത് അനുവാദം ചോദിക്കുമ്പോൾ നിങ്ങൾ തടയരുത്.
                        </x-slot:text>
                    </x-app.hadith-box>

                    <x-app.hadith-box class="mt-2" reference="അബു ദാവൂദ്:567">
                        <x-slot:text>
                            നിങ്ങളുടെ സ്ത്രീകളെ പള്ളിയിൽ പോകുന്നത് നിങ്ങൾ തടയരുത്; എന്നാൽ അവരുടെ വീടുകളാണ് അവർക്ക് ഉത്തമം.
                        </x-slot:text>
                    </x-app.hadith-box>

                    <x-app.hadith-box class="mt-2" reference="മുസ്ലിം:996-99">
                        <x-slot:text>
                            നിങ്ങളിൽ ആരെങ്കിലും പള്ളിയിൽ വന്നാൽ അവൾ സുഗന്ധം പൂശരുത്.
                        </x-slot:text>
                    </x-app.hadith-box>
                </x-app.content>
            </div>

            <div class="col-12 col-md-4">
                <h5 class="text-emerald fw-bold">Related Topics</h5>
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
