@extends('layouts.app')

@section('content')
    <x-app.topbar :title="$questions['title']" :url="route('questions.show', ['menu_slug' => 'topics', 'module_slug' => $questions['slug']])" />

    <div class="container my-3 pb-5">
        <x-app.banner :title="'റ. അ. മാസത്തിന്റെ ശ്രേഷ്ഠത, റ. അ. 12 ന്റെ അടിസ്ഥാനം'" :desc="$questions['desc']" :search="false" :author="'Author Name'" :review="date('M d, Y') . ' by Reviewer Name'" />

        <!-- Lesson Body -->
        <div class="p-1">
            <x-app.content :title="'ഖുർആൻ പരാമർശം'" :desc="'റ. അ. മാസത്തെയോ 12-ാം തീയതിയെ കുറിച്ചോ പ്രത്യേക പരാമർശമില്ല.'" />

            <x-app.content :title="'ഹദീസ് പരാമർശം'" :desc="'സഹീഹ് ഹദീസുകളിൽ പ്രത്യേക പരാമർശമില്ല.'">
                <x-app.hadith-box text="നബി ജനിച്ചത് തിങ്കളാഴ്ച എന്ന് പറയപ്പെട്ടിട്ടുണ്ട്." reference="മുസ്ലിം: 2747 [1]"
                    data-bs-toggle="offcanvas" data-bs-target="#authenticPanel" data-ref-id="auth1" />
            </x-app.content>

            <x-app.content :title="'ഖലീഫമാരും സ്വഹാബികളും'" :desc="'അബൂബക്കർ(റ), ഉമർ (റ), ഉസ്മാൻ (റ), അലി (റ) എന്നിവർ പ്രവാചകൻ ﷺ ജനിച്ച ദിവസം ആരാധന/ആഘോഷം ചെയ്തിട്ടില്ല.'" />

            <x-app.content :title="'മദ്ഹബുകളിലെ പരാമർശങ്ങൾ'" :desc="'ഇമാം അബൂ ഹനീഫ, മാലിക്, ശാഫിഈ, ഹൻബലി — ഇവരുടെ കാലത്ത് റ.അ. മാസത്തിൽ പ്രത്യേക ആരാധന/ആഘോഷം ഉണ്ടായിട്ടില്ല.'">
                <x-app.hadith-box
                    text="<strong>ഇമാം അബൂ ഹനീഫ (ഹി 80 - 150):</strong> നിശ്ചിത സമയങ്ങളെ, ശരീഅത്ത് നിർദ്ദേശിക്കാതെ,
                    ആരാധനയ്‌ക്കായി വേർതിരിക്കുന്നത് ബിദ്അത് ആണ്."
                    class="mb-2 mt-2" reference="അൽ-ഹിദായ, അൽ-മബ്സൂത് [1]" data-bs-toggle="offcanvas"
                    data-bs-target="#referencesPanel" data-ref-id="ref1" />

                <x-app.hadith-box
                    text="<strong>ഇമാം മാലിക് (ഹി 93 - 179):</strong> സലഫുകൾ (ആദ്യകാല സഹാബികൾ, താബിഉൻ) ആരും ചെയ്തിട്ടില്ല, അത്
                    ബിദ്അത് ആണ്."
                    class="mb-2" reference="അൽ-ഇ'തിസാം [2]" data-bs-toggle="offcanvas" data-bs-target="#referencesPanel"
                    data-ref-id="ref2" />

                <x-app.hadith-box
                    text="<strong>ഇമാം ശാഫിഈ (ഹി 150 - 204):</strong> <span class='small'>നേരിട്ട് മീലാദിനെക്കുറിച്ച്
                        പറഞ്ഞിട്ടില്ല.</span> ഒരു കാര്യത്തെ നല്ല ബിദ്അത് എന്നും, മോശം ബിദ്അത് എന്നും പറയാം."
                    class="mb-2" reference="മനാഖിബ് അൽ-ശാഫിഈ [3]" data-bs-toggle="offcanvas"
                    data-bs-target="#referencesPanel" data-ref-id="ref3" />

                <x-app.hadith-box
                    text="<strong>ഇമാം അഹ്മദ് ബിൻ ഹൻബൽ (ഹി 164 - 241):</strong> എനിക്ക് അത് ബിദ്അത് ആയി
                    തോന്നുന്നു."
                    reference="ഇഖ്തിദാഉൽ സിറാത്ത് [4]" data-bs-toggle="offcanvas" data-bs-target="#referencesPanel"
                    data-ref-id="ref4" />
            </x-app.content>

            <x-app.content :title="'റ. അ. 12 വന്ന പ്രധാന ഉറവിടം'"
                desc="ചരിത്രകാരന്മാരുടെ അഭിപ്രായങ്ങൾ (8, 9, 12) വ്യത്യസ്തമാണ് <span data-bs-toggle='offcanvas' data-bs-target='#referencesPanel' data-ref-id='ref5'>[5]</span>. ഇബ്ന് കതീർ 12-ാം തീയതിയെ പ്രശസ്ത അഭിപ്രായമായി പറയുന്നു. <span data-bs-toggle='offcanvas' data-bs-target='#referencesPanel' data-ref-id='ref6'>[6]</span>. മറ്റ് അഭിപ്രായങ്ങളും ശക്തമാണ്." />

            <x-app.content :title="'Trust & Reminder'">
                <x-app.quran-box text="🔹 നിനക്ക് അറിവില്ലാത്ത കാര്യത്തിന്‍റെയും പിന്നാലെ നീ പോകരുത്" class="mb-2"
                    reference=" 17:36 [3]" data-bs-toggle="offcanvas" data-bs-target="#authenticPanel"
                    data-ref-id="auth3" />

                <x-app.quran-box text="🔹 ഇന്ന് ഞാന്‍ നിങ്ങള്‍ക്ക് നിങ്ങളുടെ മതം പൂര്‍ത്തിയാക്കി തന്നിരിക്കുന്നു"
                    class="mb-2" reference=" 5:3 [4]" data-bs-toggle="offcanvas" data-bs-target="#authenticPanel"
                    data-ref-id="auth4" />

                <x-app.hadith-box text="🔹 ഞാൻ ജനിച്ച ദിവസമായിരുന്നു അത്(തിങ്കളാഴ്ച)..." class="mb-2"
                    reference="മുസ്ലിം: 2747 [1]" data-bs-toggle="offcanvas" data-bs-target="#authenticPanel"
                    data-ref-id="auth1" />

                <x-app.hadith-box text="🔹പുതുതായി കണ്ടുപിടിച്ച കാര്യങ്ങളെ സൂക്ഷിക്കുക, അവ വഴിതെറ്റിയതാണ്."
                    reference="തിർമിധി: 2676 [2]" data-bs-toggle="offcanvas" data-bs-target="#authenticPanel"
                    data-ref-id="auth2" />

                <x-app.hadith-box text="🔹ക്രിസ്ത്യാനികൾ മർയമിന്റെ മകനെ പുകഴ്ത്തിയതുപോലെ എന്നെ നിങ്ങൾ പുകഴ്ത്തരുത്."
                    reference="ബുഖാരി: 3445 [5]" data-bs-toggle="offcanvas" data-bs-target="#authenticPanel"
                    data-ref-id="auth5" />
            </x-app.content>

            <div class="ref-box ref-summary text-dark shadow-sm rounded-1 pb-2 mb-3">
                <div class="text-center m-0 mb-2"><i class="fas fa-exclamation-triangle fs-1 mt-1 text-danger"></i></div>

                <p class="text-justify m-0 mb-3" style="text-indent: 2em">
                    നബി ﷺ തന്റെ ജന്മദിനം ഒരിക്കലും ആഘോഷിച്ചിട്ടില്ല. അതുപോലെ തന്നെ ഖലീഫാക്കളും സഹാബികളും
                    ഇത്തരത്തിൽ ഒന്നും ചെയ്തിട്ടില്ല. ആദ്യകാല ഇമാമുമാരുടെ കാലത്തും ഇത്തരം ആഘോഷങ്ങൾ ഉണ്ടായിരുന്നില്ല.
                    12 പ്രശസ്തമായിരുന്നുവെങ്കിലും അഭിപ്രായ വ്യത്യാസം ഉണ്ടായിരുന്നു.
                </p>

                <p class="text-justify m-0" style="text-indent: 2em">
                    ആചാരമാക്കുന്നവര്‍ ഖുർആൻ, സുന്നത്ത്, ഇജ്മാഅ് വിരുദ്ധമല്ലാതെ മാര്‍ഗ്ഗങ്ങളില്‍
                    നില്‍ക്കുക. പുതുതായ കൂട്ടിച്ചേർക്കലുകൾ ഒഴിവാക്കുക.<br>
                    <em class="text-danger">
                        (പ്രതേക ചടങ്ങുകൾ, ഗാനങ്ങൾ, മൗലിദ് സദസ്സ്, ലൈറ്റുകൾ, അലങ്കാരം, കൂട്ടം ചേർന്ന്
                        ആഘോഷിക്കൽ, കലാപരിപാടികൾ)
                    </em>
                </p>
            </div>
        </div>

        <h5 class="text-emerald fw-bold m-0">Related Topics</h5>
        @foreach ($questions['chapters'] as $item)
            @continue($questionSlug == $loop->index)

            <x-app.topic-chapter :title="$loop->index + 1 . ' : ' . $item" :url="route('answers.show', [
                'menu_slug' => 'topics',
                'module_slug' => $questions['slug'],
                'question_slug' => $loop->index,
            ])" :related="true" />
        @endforeach

        <!-- References Offcanvas -->
        <div class="offcanvas offcanvas-end" tabindex="-1" id="referencesPanel">
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
                </div>

                <div class="ref-box ref-hadith m-0 mb-3" id="ref6">
                    <span class="fw-bold">[6].</span><br>

                    <p class="m-0 small">
                        <span class="fw-bold">ഇബ്ന്‍ കതീർ (d - 774 ഹി)</span><br>
                        <em>- “അൽ-ബിദായ വൽ നിഹായ” (Vol. 3, Chapter: Dhikr Mawlidihi al-Sharif) -ൽ വ്യക്തമാക്കുന്നു: “ഇബ്നു
                            ഇഷാഖിന്റെ അഭിപ്രായത്തിൽ ഏറ്റവും പ്രസിദ്ധമായ അഭിപ്രായം - റ. അ. 12”</em>
                    </p>
                </div>
            </div>
        </div>

        <!-- Overview Offcanvas -->
        <div class="offcanvas offcanvas-end" tabindex="-1" id="authenticPanel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title">References</h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"></button>
            </div>

            <div class="offcanvas-body py-0">
                <p class="ref-box ref-hadith m-0 mb-1" id="auth1">
                    <span class="fw-bold">[1].</span>
                    (തിങ്കളാഴ്ച നോമ്പിനെ കുറിച് ചോദിക്കപ്പെട്ടപ്പോൾ): ഞാൻ ജനിച്ച ദിവസമായിരുന്നു അത്. അന്ന് എനിക്ക്
                    പ്രവാചകത്വം നൽകുകയോ എനിക്ക് ദിവ്യബോധനം നൽകുകയോ ചെയ്തു.<br>
                    <em class="small">- മുസ്ലിം: 2747 <span class="text-ar">(كتاب الصِّيَامِ)</span></em>
                </p>

                <p class="ref-box ref-hadith m-0 mb-1" id="auth2">
                    <span class="fw-bold">[2].</span>
                    പുതുതായി കണ്ടുപിടിച്ച കാര്യങ്ങളെ സൂക്ഷിക്കുക, അവ വഴിതെറ്റിയതാണ്. നിങ്ങളിൽ ആരെങ്കിലും അത്
                    കാണുന്നുവെങ്കിൽ, അവൻ എന്റെ സുന്നത്തും സന്മാർഗ്ഗം പ്രാപിച്ച ഖുലഫയുടെ സുന്നത്തും മുറുകെ പിടിക്കണം.<br>
                    <em class="small">- തിർമിധി: 2676 <span class="text-ar">(كتاب العلم عن رسول الله (ص))</span></em><br>
                    <span class="fw-bold">സമാനമായ ഹദീസുകൾ</span><br>
                    <em class="small">- ബുഖാരി: 2697 <span class="text-ar">(كتاب الصلح)</span></em><br>
                    <em class="small">- മുസ്ലിം: 4493 <span class="text-ar">(كتاب الْأَقْضِيَةِ)</span></em><br>
                    <em class="small">- അബു ദാവൂദ്: 4607 <span class="text-ar">(كتاب السنة)</span></em>
                </p>

                <p class="ref-box ref-hadith m-0 mb-1" id="auth3">
                    <span class="fw-bold">[3].</span>
                    നിനക്ക് അറിവില്ലാത്ത യാതൊരു കാര്യത്തിന്‍റെയും പിന്നാലെ നീ പോകരുത്‌. തീര്‍ച്ചയായും കേള്‍വി, കാഴ്ച, ഹൃദയം
                    എന്നിവയെപ്പറ്റിയെല്ലാം ചോദ്യം ചെയ്യപ്പെടുന്നതാണ്‌.<br>
                    <em class="small">- അല്‍-ഇസ്റാ: 36</em>
                </p>

                <p class="ref-box ref-hadith m-0 mb-1" id="auth4">
                    <span class="fw-bold">[4].</span>
                    ഇന്ന് ഞാന്‍ നിങ്ങള്‍ക്ക് നിങ്ങളുടെ മതം പൂര്‍ത്തിയാക്കി തന്നിരിക്കുന്നു. എന്‍റെ അനുഗ്രഹം നിങ്ങള്‍ക്ക്
                    ഞാന്‍ നിറവേറ്റിത്തരികയും ചെയ്തിരിക്കുന്നു. മതമായി ഇസ്ലാമിനെ ഞാന്‍ നിങ്ങള്‍ക്ക് തൃപ്തിപ്പെട്ട്
                    തന്നിരിക്കുന്നു.<br>
                    <em class="small">- അല്‍-മായിദ: 3</em>
                </p>

                <p class="ref-box ref-hadith m-0 mb-3" id="auth5">
                    <span class="fw-bold">[5].</span>
                    ക്രിസ്ത്യാനികൾ മർയമിന്റെ മകനെ പുകഴ്ത്തിയതുപോലെ എന്നെ പുകഴ്ത്തുന്നതിൽ നിങ്ങൾ അതിശയോക്തി കാണിക്കരുത്,
                    കാരണം ഞാൻ ഒരു അടിമ മാത്രമാണ്. അതിനാൽ എന്നെ അല്ലാഹുവിന്റെ അടിമയെന്നും അവന്റെ ദൂതനെന്നും വിളിക്കൂ.<br>
                    <em class="small">- ബുഖാരി: 3445 <span class="text-ar">(كتاب أحاديث الأنبياء)</span></em>
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
