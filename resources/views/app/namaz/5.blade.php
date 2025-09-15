@extends('layouts.app')

@section('content')
    <x-app.topbar :title="$questions['title']" :url="route('questions.show', ['menu_slug' => 'topics', 'module_slug' => $questions['slug']])" />

    <div class="container my-3 pb-5">
        <x-app.banner :title="$questions['chapters'][$questionSlug]" :desc="$questions['desc']" :search="false" :author="'Author Name'" :review="date('M d, Y') . ' by Reviewer Name'" />

        <div class="p-1">
            <x-app.content :title="'5 നമസ്കാരങ്ങളുടെ റക്അത്തുകൾ'">
                <h6 class="text-accent-900 fw-bold m-0 my-2 mt-3">1. സുബഹ് (ഫജ്ർ)</h6>
                <div class="ref-box ref-summary text-dark shadow-sm rounded-1 mb-3">
                    <strong>സുന്നത്:</strong> മുമ്പ് 2 റക്അത് <em>- മുസ്ലിം:1687, അൽ-തിർമിധി:415, അബു ദാവൂദ്:1251</em><br>
                    <strong>നിർബന്ധം:</strong> 2 റക്അത്<br>

                    <x-app.hadith-box class="mt-2" reference="മുസ്ലിം:1688-90">
                        <x-slot:text>
                            ഫജ്‌റിന്റെ രണ്ട് റക്അത്ത് നമസ്കാരം ഇഹലോകത്തേക്കാളും അതിലുള്ളതിനേക്കാളും ഉത്തമമാണ്.
                        </x-slot:text>
                    </x-app.hadith-box>
                </div>

                <h6 class="text-accent-900 fw-bold m-0 my-2">2. ളുഹർ</h6>
                <div class="ref-box ref-summary text-dark shadow-sm rounded-1 mb-3">
                    <strong>സുന്നത്:</strong> മുമ്പ് 4 റക്അത് <em>- അൽ-തിർമിധി:415, അബു ദാവൂദ്:1251</em><br>
                    <strong>നിർബന്ധം:</strong> 4 റക്അത്<br>
                    <strong>സുന്നത്:</strong> ശേഷം 2 റക്അത് <em>- അൽ-തിർമിധി:415, അബു ദാവൂദ്:1251</em><br>

                    <x-app.hadith-box class="mt-2" reference="മുസ്ലിം:1581-82, ബുഖാരി:1089">
                        <x-slot:text>
                            മദീനയിൽ വെച്ച് നബി (ﷺ) യുടെ കൂടെ നാല് റക്അത്ത് ളുഹർ നമസ്കാരം നിർവഹിച്ചു.
                        </x-slot:text>
                    </x-app.hadith-box>
                </div>

                <h6 class="text-accent-900 fw-bold m-0 my-2">3. അസർ</h6>
                <div class="ref-box ref-summary text-dark shadow-sm rounded-1 mb-3">
                    <strong>നിർബന്ധം:</strong> 4 റക്അത്<br>
                    <x-app.hadith-box class="mt-2" reference="മുസ്ലിം:1581-82, ബുഖാരി:1089">
                        <x-slot:text>
                            മദീനയിൽ വെച്ച് നബി (ﷺ) യുടെ കൂടെ നാല് റക്അത്ത് ളുഹർ നമസ്കാരവും ദുൽഹുലൈഫയിൽ രണ്ട് റക്അത്തും ഞാൻ
                            നിർവഹിച്ചു. (അതായത് 'അസർ' നമസ്കാരം ചുരുക്കി).
                        </x-slot:text>
                    </x-app.hadith-box>
                </div>

                <h6 class="text-accent-900 fw-bold m-0 my-2">4. മഗ്രിബ്</h6>
                <div class="ref-box ref-summary text-dark shadow-sm rounded-1 mb-3">
                    <strong>നിർബന്ധം:</strong> 3 റക്അത്<br>
                    <strong>സുന്നത്:</strong> ശേഷം 2 റക്അത് <em>- അൽ-തിർമിധി:415, അബു ദാവൂദ്:1251</em><br>

                    <x-app.hadith-box class="mt-2" reference="ബുഖാരി:1091,1109">
                        <x-slot:text>
                            യാത്രയിൽ തിരക്കിലാണെങ്കിൽ, മഗ്‌രിബ് നമസ്കാരം മാറ്റിവയ്ക്കുകയും, മൂന്ന് റക്അത്ത് നമസ്കരിക്കുകയും,
                            പിന്നീട് സലാം പറയുകയും ചെയ്യും.
                        </x-slot:text>
                    </x-app.hadith-box>
                </div>

                <h6 class="text-accent-900 fw-bold m-0 my-2">5. ഇശാ</h6>
                <div class="ref-box ref-summary text-dark shadow-sm rounded-1 mb-2">
                    <strong>നിർബന്ധം:</strong> 4 റക്അത്<br>
                    <strong>സുന്നത്:</strong> ശേഷം 2 റക്അത് <em>- അൽ-തിർമിധി:415, അബു ദാവൂദ്:1251</em><br>

                    <x-app.hadith-box class="mt-2" reference="ബുഖാരി:1091,1109">
                        <x-slot:text>
                            യാത്രയിൽ തിരക്കിലാണെങ്കിൽ, മഗ്‌രിബ് നമസ്കാരം മാറ്റിവയ്ക്കുകയും, മൂന്ന് റക്അത്ത് നമസ്കരിക്കുകയും,
                            പിന്നീട് സലാം പറയുകയും ചെയ്യും. പിന്നീട്, ഇശാ നമസ്കാരത്തിന് ഇഖാമ ചൊല്ലുകയും. രണ്ട് റക്അത്ത്
                            നമസ്കരിക്കുകയും തസ്ലീം ചെയ്യുകയും ചെയ്യുമായിരുന്നു.
                        </x-slot:text>
                    </x-app.hadith-box>
                </div>

                <hr class="mt-2 mb-3" style="border: none; border-top: 2px solid #166534; opacity: 1;">

                <x-app.hadith-box class="mb-2" reference="മുസ്ലിം:1575-76">
                    <x-slot:text>
                        പ്രവാചകൻ (സ) യുടെ വചനത്തിലൂടെ അല്ലാഹു നമസ്കാരത്തെ താമസത്തിനിടയിൽ നാല് റക്അത്തും,
                        യാത്രയിലായിരിക്കുമ്പോൾ രണ്ട് റക്അത്തും, അപകടാവസ്ഥയിൽ ഒരു റക്അത്തും ആയി നിശ്ചയിച്ചിരിക്കുന്നു.
                    </x-slot:text>
                </x-app.hadith-box>

                <x-app.hadith-box class="mb-2" reference="അൽ-തിർമിധി:415, അബു ദാവൂദ്:1251">
                    <x-slot:text>
                        ആരെങ്കിലും ഒരു പകലും രാത്രിയും പന്ത്രണ്ട് റക്അത്ത് നമസ്കരിച്ചാൽ സ്വർഗത്തിൽ അവനിൽ നിന്ന് ഒരു വീട്
                        നിർമ്മിക്കപ്പെടും: ളുഹറിന് മുമ്പ് നാല് റക്അത്ത്, അതിന് ശേഷം രണ്ട് റക്അത്ത്, മഗ്‌രിബിന് ശേഷം രണ്ട്
                        റക്അത്ത്, ഇശാഇന് ശേഷം രണ്ട് റക്അത്ത്, പ്രഭാത നമസ്കാരത്തിൽ ഫജ്‌റിന് മുമ്പ് രണ്ട് റക്അത്ത്.
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
