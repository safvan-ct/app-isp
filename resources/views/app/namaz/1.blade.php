@extends('layouts.app')

@section('content')
    <x-app.topbar :title="$questions['title']" :url="route('questions.show', ['menu_slug' => 'topics', 'module_slug' => $questions['slug']])" />

    <div class="container my-3 pb-5">
        <x-app.banner :title="$questions['chapters'][$questionSlug]" :desc="$questions['desc']" :search="false" :author="'Author Name'" :review="date('M d, Y') . ' by Reviewer Name'" />

        <div class="p-1">
            <x-app.content :title="'5 നമസ്കാരങ്ങളുടെ സമയക്രമം'">
                <h6 class="text-accent-900 fw-bold m-0 my-2 mt-3">1. സുബഹ് (ഫജ്ർ)</h6>
                <div class="ref-box ref-summary text-dark shadow-sm rounded-1 mb-3">
                    പുലർച്ചെ വെളിച്ചം മുതൽ സൂര്യോദയം വരെ
                </div>

                <h6 class="text-accent-900 fw-bold m-0 my-2">2. ളുഹർ</h6>
                <div class="ref-box ref-summary text-dark shadow-sm rounded-1 mb-3">
                    സൂര്യൻ ആകാശമദ്ധ്യത്തില്‍ നിന്ന് താഴേക്ക് പോകുമ്പോൾ മുതൽ ഒരു വസ്തുവിന്റെ നീളം അതിന്റെ നിഴലിന്റെ നീളത്തിന്
                    സമമാകുന്നത് വരെ
                </div>

                <h6 class="text-accent-900 fw-bold m-0 my-2">3. അസർ</h6>
                <div class="ref-box ref-summary text-dark shadow-sm rounded-1 mb-3">
                    ഒരു വസ്തുവിന്റെ നീളം അതിന്റെ നിഴലിന്റെ നീളത്തിന് സമമാകുന്നത് മുതൽ സൂര്യാസ്തമയം വരെ
                </div>

                <h6 class="text-accent-900 fw-bold m-0 my-2">4. മഗ്രിബ്</h6>
                <div class="ref-box ref-summary text-dark shadow-sm rounded-1 mb-3">
                    സൂര്യാസ്തമയം മുതൽ ചുവന്ന വെളിച്ചം ഇല്ലാതാകുന്നത് വരെ
                </div>

                <h6 class="text-accent-900 fw-bold m-0 my-2">5. ഇശാ</h6>
                <div class="ref-box ref-summary text-dark shadow-sm rounded-1 mb-2">
                    ചുവന്ന വെളിച്ചം ഇല്ലാതാകുന്നത് മുതൽ അർദ്ധരാത്രി വരെ
                </div>

                <hr class="mt-2 mb-3" style="border: none; border-top: 2px solid #166534; opacity: 1;">

                <x-app.quran-box class="mb-2" reference="17:78">
                    <x-slot:text>
                        സൂര്യന്‍ (ആകാശമദ്ധ്യത്തില്‍ നിന്ന്‌) തെറ്റിയത് മുതല്‍ രാത്രി ഇരുട്ടുന്നത് വരെ (നിശ്ചിത സമയങ്ങളില്‍)
                        നീ നമസ്കാരം മുറപ്രകാരം നിര്‍വഹിക്കുക ഖുര്‍ആന്‍ പാരായണം ചെയ്തുകൊണ്ടുള്ള പ്രഭാത നമസ്കാരവും
                        (നിലനിര്‍ത്തുക)
                    </x-slot:text>
                </x-app.quran-box>

                <x-app.quran-box class="mb-2" reference="11:114">
                    <x-slot:text>
                        പകലിന്‍റെ രണ്ടറ്റങ്ങളിലും, രാത്രിയിലെ ആദ്യയാമങ്ങളിലും നീ നമസ്കാരം മുറപോലെ നിര്‍വഹിക്കുക.
                    </x-slot:text>
                </x-app.quran-box>

                <x-app.hadith-box class="mb-2"
                    reference="മുസ്ലിം: 1385,1388,1389, ബുഖാരി:541,556, അബു ദാവൂദ്:149,151,152">
                    <x-slot:text>
                        നമസ്കാര സമയങ്ങൾ
                    </x-slot:text>
                </x-app.hadith-box>

                <x-app.hadith-box class="mb-2" reference="ബുഖാരി:527">
                    <x-slot:text>
                        അല്ലാഹുവിന് ഏറ്റവും ഇഷ്ടപ്പെട്ട കർമ്മം ഏതാണ്?" അദ്ദേഹം മറുപടി പറഞ്ഞു, "അവയുടെ ആദ്യ സമയങ്ങളിൽ
                        നമസ്കരിക്കുക.
                    </x-slot:text>
                </x-app.hadith-box>
            </x-app.content>
        </div>

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
@endsection
