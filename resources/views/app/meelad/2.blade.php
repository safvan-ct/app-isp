@extends('layouts.app')

@section('content')
    <x-app.topbar :title="$questions['title']" :url="route('questions.show', ['menu_slug' => 'topics', 'module_slug' => $questions['slug']])" />

    <div class="container my-3 pb-5">
        <x-app.banner :title="'നബിദിന ആഘോഷങ്ങളുടെ ചരിത്രം'" :desc="'കാലഘട്ടങ്ങളിലൂടെ നബിദിന (മൗലിദ്) ആഘോഷങ്ങളുടെ വികാസം'" :search="false" />

        <div class="timeline">
            <!-- 1 - 11 -->
            <div class="timeline-item">
                <div class="circle"></div>
                <div class="timeline-content pb-1">
                    <h5>ഹി. 1 - 11 (പ്രവാചക കാലഘട്ടം)</h5>
                    <p class="mb-1">
                        പ്രവാചകൻ ﷺ യുടെ ജന്മദിനം ആഘോഷിക്കാൻ, പ്രത്യേക ദിനങ്ങൾ നിശ്ചയിക്കാൻ യാതൊരു സാക്ഷ്യവും ഇല്ല.
                    </p>
                    <ul>
                        <li>
                            നബി ﷺ തിങ്കളാഴ്ച നോമ്പ് എടുത്തു → “ഞാൻ ഈ ദിവസമാണ് ജനിച്ചത്”
                            <em class="small">- മുസ്ലിം: 2747</em>
                            <span data-bs-toggle="offcanvas" data-bs-target="#overviewPanel" data-ref-id="ref1">[1]</span>.
                        </li>
                    </ul>
                </div>
            </div>

            <!-- 11 - 40 -->
            <div class="timeline-item">
                <div class="circle"></div>
                <div class="timeline-content pb-1">
                    <h5>ഹി. 11 - 40 (റാഷിദൂൻ ഖലീഫകളുടെ കാലഘട്ടം)</h5>
                    <ul>
                        <li>
                            ഇസ്ലാമിക ചരിത്രഗ്രന്ഥങ്ങളിൽ നബിദിനാഘോഷങ്ങൾ ആഘോഷങ്ങൾ ഉണ്ടായിരുന്നുവെന്ന് സൂചിപ്പിക്കുന്ന തെളിവുകൾ
                            ഇല്ല.
                        </li>
                    </ul>
                </div>
            </div>

            <!-- 41 - 132 -->
            <div class="timeline-item">
                <div class="circle"></div>
                <div class="timeline-content pb-1">
                    <h5>ഹി. 41 - 132 (ഉമയ്യദ ഖിലാഫത് - ദമാസ്കസ്)</h5>
                    <ul>
                        <li>ഈ കാലഘട്ടത്തിൽ നബിദിനാഘോഷങ്ങൾ ഉണ്ടായിരുന്നു എന്നതിനെക്കുറിച്ച് വ്യക്തമായ വിവരങ്ങൾ ലഭ്യമല്ല.</li>
                    </ul>
                </div>
            </div>

            <!-- 132 - 656 -->
            <div class="timeline-item">
                <div class="circle"></div>
                <div class="timeline-content pb-1">
                    <h5>ഹി. 132 - 656 (അബ്ബാസിദ് ഖിലാഫത് - ബഗ്ദാദ് & ഇറാഖ്)</h5>
                    <ul>
                        <li>
                            നബിദിനാഘോഷങ്ങൾ ഔദ്യോഗികമായി സ്ഥാപിക്കപ്പെട്ടിരുന്നില്ല.
                            <span data-bs-toggle="offcanvas" data-bs-target="#overviewPanel" data-ref-id="ref2">[2]</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- 297 - 567 -->
            <div class="timeline-item">
                <div class="circle"></div>
                <div class="timeline-content pb-1">
                    <h5>ഹി. 297 - 567 (ഫാതിമി ഖിലാഫത് - കയ്‌റോ ഇജിപ്ത്)</h5>
                    <ul>
                        <li>
                            ഫാതിമി (ശിയ) ഖിലാഫത്ത് ആണ് ആദ്യമായി സർക്കാർ തലത്തിൽ “മൗലിദ്” ആഘോഷം തുടങ്ങിയത്.
                            <span data-bs-toggle="offcanvas" data-bs-target="#overviewPanel" data-ref-id="ref3">[3]</span>
                        </li>
                        <li>ഇതിനുശേഷം, മൗലിദ് ആഘോഷങ്ങൾ സുന്നി സമൂഹത്തിലേക്ക് വ്യാപിച്ചു.</li>
                    </ul>
                </div>
            </div>

            <!-- 586 - 630 -->
            <div class="timeline-item">
                <div class="circle"></div>
                <div class="timeline-content pb-1">
                    <h5>ഹി. 586 - 630 (എർബിൽ കാലഘട്ടം - മുളഫ്ഫറുദ്ദീൻ ഗോക്ബുരി)</h5>
                    <ul class="m-0">
                        <li>
                            ഹിജ്റ 604-ൽ പൊതുസമൂഹത്തിൽ ആദ്യമായി വലിയ രീതിയിൽ മൗലിദ് ആഘോഷങ്ങൾ സംഘടിപ്പിച്ചു.
                            <span data-bs-toggle="offcanvas" data-bs-target="#overviewPanel" data-ref-id="ref4">[4]</span>
                        </li>
                        <li>മൗലിദ് ആഘോഷങ്ങളെ സുന്നി ലോകത്ത് ഒരു സാധാരണ ആചാരമാക്കി മാറ്റുന്നതിൽ നിർണായക പങ്ക് വഹിച്ചു.</li>
                    </ul>
                </div>
            </div>

            <!-- 648 - 923 -->
            <div class="timeline-item">
                <div class="circle"></div>
                <div class="timeline-content pb-1">
                    <h5>ഹി. 648 - 923 (മമ്ലുക് സാമ്രാജ്യം - കയ്‌റോ)</h5>
                    <ul>
                        <li>
                            നബി ﷺ ജന്മദിനം ആഘോഷിക്കുന്ന മൗലിദ് ഒരു പൊതു ജന, സാംസ്കാരിക ഉത്സവമായി മാറി.
                            <span data-bs-toggle="offcanvas" data-bs-target="#overviewPanel" data-ref-id="ref5">[5]</span>
                        </li>
                        <li>
                            മമ്ലുക് കാലഘട്ടത്തിൽ മൗലിദ് ആഘോഷത്തെ കുറിച്ച് പണ്ഡിതന്മാരുടെ അഭിപ്രായങ്ങൾ വ്യത്യസ്തമായിരുന്നു.
                        </li>
                    </ul>
                </div>
            </div>

            <!-- 584 - 923 -->
            <div class="timeline-item d-none">
                <div class="circle"></div>
                <div class="timeline-content pb-1">
                    <h5>ഹി. 584 - 923 (ഡൽഹി സുൽത്താനേറ്റ് - ഡൽഹി)</h5>
                </div>
            </div>

            <!-- 1014 - 1212 -->
            <div class="timeline-item d-none">
                <div class="circle"></div>
                <div class="timeline-content pb-1">
                    <h5>ഹി. 1014 - 1212 (മുഗൾ സാമ്രാജ്യം - ഇന്ത്യൻ ഉപഭൂഖണ്ഡം)</h5>
                </div>
            </div>

            <!-- 699 - 1342 -->
            <div class="timeline-item">
                <div class="circle"></div>
                <div class="timeline-content pb-1">
                    <h5>ഹി. 699 - 1342 (ഒട്ടോമാൻ സാമ്രാജ്യം - ഇസ്താൻബുൾ)</h5>
                    <ul>
                        <li>
                            മസ്ജിദുകളിൽ പ്രാർത്ഥനകൾ, ഖുര്‍ആൻ പാരായണം, പ്രൊഫറ്റ് മുഹമ്മദ് (സ.അ.വ)യുടെ ജീവിതത്തെക്കുറിച്ചുള്ള
                            പ്രഭാഷണങ്ങൾ എന്നിവ സംഘടിപ്പിക്കപ്പെട്ടു.
                            <span data-bs-toggle="offcanvas" data-bs-target="#overviewPanel" data-ref-id="ref6">[6]</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- 1300 - 1500 -->
            <div class="timeline-item">
                <div class="circle"></div>
                <div class="timeline-content pb-1">
                    <h5>ഹി. 1342 - (ആധുനികകാലഘട്ടം)</h5>
                    <ul>
                        <li>പല രാജ്യങ്ങളിലും മൗലിദ് ഔദ്യോഗിക അവധി.</li>
                        <li>ചില രാജ്യങ്ങൾ (സൗദി, ഖത്തർ) – വിരുദ്ധ നിലപാട്.</li>
                        <li>മിക്ക മുസ്ലിം ലോകത്തും: ഖുർആൻ, പ്രസംഗം, കവിത, പ്രദക്ഷിണം, ഭക്ഷണവിതരണം.</li>
                    </ul>
                </div>
            </div>

            <!-- Makkah -->
            <div class="timeline-item">
                <div class="circle"></div>
                <div class="timeline-content pb-1 bg-success-subtle">
                    <h5>🕋 മക്ക & 🌙 മദീന & 🕌 ഫലസ്തീൻ (ഖുദ്സ്)</h5>
                    <ul>
                        <li>0 - 350 ഹി.: ആഘോഷമില്ല</li>
                        <li>400 - 1342 ഹി.: ഫാതിമി, എർബിൽ, മമ്ലുക് - ആഘോഷങ്ങളുടെ പ്രതിഫലനം</li>
                        <li>1342 ഹി.: സൗദി ഭരണത്തിൽ നിരോധനം</li>
                        <li>1386 ഹി.: മത-സാംസ്കാരിക ആഘോഷം (ഫലസ്തീൻ)</li>
                    </ul>
                </div>
            </div>

            <!-- Kerela, India -->
            <div class="timeline-item">
                <div class="circle"></div>
                <div class="timeline-content pb-1 bg-success-subtle">
                    <h5>കേരളം</h5>
                    <ul>
                        <li>
                            ~ 905 ഹി.: അറബിക്കടൽ വ്യാപാരികളും, യെമൻ സൂഫി പണ്ഡിതന്മാരും വഴിയാണ് മൗലിദ് കേരളത്തിലേക്ക്
                            എത്തിയത്.
                            <em> - Roland E. Miller, Mappila Muslims of Kerala, Oxford University Press, 1992.</em>
                        </li>
                        <li>
                            ~ 906 - 1300 ഹി.:സൂഫി സ്വാധീനം. ഈ സമയത്താണ് മാലപ്പാട്ടുകൾ രചിക്കപ്പെട്ടതും മൗലിദ് സദസ്സുകൾ
                            കൂടുതൽ ജനകീയമായതും.
                        </li>
                        <li>1344 ഹി.: മത-സാംസ്കാരിക ആഘോഷം (by Samastha Kerala Jem-iyyathul Ulama)</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="ref-box text-dark bg-warning-subtle shadow-sm mb-4 mt-3">
            <div class="gap-3" bis_skin_checked="1">
                <p class="mb-2 text-justify ps-1" style="text-indent: 5rem;">
                    നബിദിനാഘോഷങ്ങൾ പ്രവാചക ﷺ യുടെ കാലത്ത് ഉണ്ടായിരുന്നില്ല. ആദ്യമായി സർക്കാർ തലത്തിൽ ഫാതിമി ഖിലാഫത്ത്
                    ആരംഭിച്ചു, പിന്നീട് പൊതുസമൂഹത്തിൽ എർബിൽ കാലത്ത് പ്രചരിച്ചു. മമ്ലുക് കാലത്ത് ഇത് പൊതുസമ്മേളനവും
                    സാംസ്കാരിക ഉത്സവവും ആയി മാറി.
                </p>

                <p class="mb-2 text-justify ps-1" style="text-indent: 5rem;">
                    ആധുനികകാലത്ത് മിക്ക മുസ്ലിം രാജ്യങ്ങളിലും മൗലിദ് ഔദ്യോഗിക അവധിയായി മാറി, ചിലയിടങ്ങളിൽ വിരോധം
                    നിലനിൽക്കുന്നു. കേരളത്തിൽ സൂഫി സ്വാധീനത്തോടെ മാലപ്പാട്ടുകൾ, മൗലിദ് സദസ്സുകൾ ജനകീയമായി വളർന്നു.
                </p>

                <p class="fst-italic text-muted m-0 mt-2 ref-box ref-quran">
                    ഇന്ന് ഞാന്‍ നിങ്ങള്‍ക്ക് നിങ്ങളുടെ മതം പൂര്‍ത്തിയാക്കി തന്നിരിക്കുന്നു.<em> - 5:3 </em>
                </p>

                <p class="fst-italic text-muted m-0 mt-2 ref-box ref-hadith">
                    ക്രിസ്ത്യാനികൾ മർയമിന്റെ മകനെ പുകഴ്ത്തിയതുപോലെ എന്നെ നിങ്ങൾ പുകഴ്ത്തരുത്.
                    <em> - ബുഖാരി: 3445</em>
                </p>

                <p class="fst-italic text-muted m-0 mt-2 ref-box ref-hadith">
                    പുതുതായി കണ്ടുപിടിച്ച കാര്യങ്ങളെ സൂക്ഷിക്കുക, അവ വഴിതെറ്റിയതാണ്. <em> - തിർമിധി: 2676</em>
                </p>
            </div>
        </div>

        <h5 class="text-emerald fw-bold">Related Topics</h5>
        @foreach ($questions['chapters'] as $item)
            @continue($questionSlug == $loop->index)

            <x-app.related-topics :title="$loop->index + 1 . ' : ' . $item" :url="route('answers.show', [
                'menu_slug' => 'topics',
                'module_slug' => $questions['slug'],
                'question_slug' => $loop->index,
            ])" />
        @endforeach
    </div>

    <!-- Overview Offcanvas -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="overviewPanel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title">References</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"></button>
        </div>

        <div class="offcanvas-body py-0">
            <div class="reference-box mt-0 pb-2" id="ref1">
                <span class="fw-bold">[1]. തിങ്കളാഴ്ച നോമ്പ്</span><br>
                (തിങ്കളാഴ്ച നോമ്പിനെ കുറിച് ചോദിക്കപ്പെട്ടപ്പോൾ): ഞാൻ ജനിച്ച ദിവസമായിരുന്നു അത്. അന്ന് എനിക്ക്
                പ്രവാചകത്വം നൽകുകയോ എനിക്ക് ദിവ്യബോധനം നൽകുകയോ ചെയ്തു.<br>
                <em class="small">- മുസ്ലിം: 2747 <span class="text-ar">(كتاب الصِّيَامِ)</span></em>
            </div>

            <div class="reference-box mt-0 pb-2" id="ref2">
                <span class="fw-bold">[2]. ഹി. 132 - 656 (അബ്ബാസിദ് ഖിലാഫത്)</span><br>

                <ul class="m-0">
                    <li class="mb-2">
                        ഹദീസ് ശേഖരണത്തിന്റെ വികാസം:<br>
                        <span class="small">
                            ഈ കാലഘട്ടത്തിലാണ് (ഹി. 200 - 303) ഇമാം ബുഖാരി, മുസ്‌ലിം, തിർമിദി, അബൂ ദാവൂദ്, നസാഇ,
                            ഇബ്നു മാജ എന്നിവർ ഹദീസുകൾ കൃത്യമായി രേഖപ്പെടുത്തിയത്.
                        </span>
                    </li>

                    <li class="mb-2">
                        ഇസ്‌ലാമിക നിയമങ്ങളുടെ വളർച്ച:<br>
                        <span class="small">
                            ഹദീസുകളുടെയും ഖുർആനിന്റെയും അടിസ്ഥാനത്തിൽ ഇസ്‌ലാമിക നിയമങ്ങൾ രൂപപ്പെടുത്തിയതും ഈ കാലത്താണ് (ഹി.
                            100 - 241). ഇമാം
                            അബൂ ഹനീഫ, മാലിക്, ഷാഫി, അഹ്മദ് ബിൻ ഹൻബൽ.
                        </span>
                    </li>
                </ul>
            </div>

            <div class="reference-box mt-0 pb-2" id="ref3">
                <span class="fw-bold">[3]. ഹി. 297 - 567 (ഫാതിമി ഖിലാഫത്)</span><br>
                <p class="small">
                    അബ്ബാസിദുകൾക്ക് ഇത്തരം ചടങ്ങുകൾ ഇല്ലാതിരുന്നതിനാൽ, ഫാതിമിദുകൾ “ഞങ്ങളാണ് അഹ്ലുൽ ബൈത്-ന്റെ യഥാർത്ഥ
                    അവകാശികൾ.” തെളിയിക്കാൻ മൗലിദിനെ (ഖുര്‍ആൻ, പ്രസംഗം, കവിതകൾ, ജനങ്ങൾക്ക് ദാനം,
                    വിരുന്നുകൾ, അലങ്കാരങ്ങൾ) ഉപയോഗിച്ചു.
                </p>

                <ul class="m-0">
                    <li class="mb-2">
                        <span class="fw-bold">അൽ-മക്രിസി (Al-Maqrīzī 845 ഹി.)</span><br>
                        <span>
                            ഫാത്തിമിദ് ഖലീഫമാർ വർഷം മുഴുവൻ ആഘോഷിച്ചിരുന്ന ഉത്സവങ്ങളിൽ മൗലിദ് അന്നബി ﷺ, കൂടാതെ അലി,
                            ഫാത്തിമ, ഹസൻ, ഹുസൈൻ, ഖലീഫയുടെ ജന്മദിനങ്ങൾ ഉൾപ്പെടുന്നു.
                        </span>
                        <a href="https://archive.org/search?query=%D8%A7%D9%84%D8%AE%D8%B7%D8%B7+%D8%A7%D9%84%D9%85%D9%82%D8%B1%D9%8A%D8%B2%D9%8A"
                            target="_blank">
                            Archive.org
                        </a>
                        <a href="https://shamela.ws/" target="_blank">Shamela</a>
                        <br>
                        <em>- അൽ-ഖിത്തത് (അൽ-മവാഇസ് വൽ-ഇഅ്തിബാർ ബി-ദിക്രി അൽ-ഖിതത് വൽ-ആഥാർ)</em><br>
                        <em>- ഇത്തിആസുൽ ഹുനഫാ ബി അഖ്ബാരി അൽ-ഐമ്മത്തി അൽ-ഫാത്വിമിയ്യീനൽ ഖുലഫാ (ഫാത്വിമി ഖിലാഫത്തിൻ്റെ ചരിത്രം
                            മാത്രം പ്രതിപാദിക്കുന്ന ഒരു പുസ്തകമാണിത്.)</em>
                    </li>

                    <li>
                        <span class="fw-bold">ബ്രിട്ടാനിക്ക (എൻസൈക്ലോപീഡിയ)</span><br>
                        <span>
                            11-ആം നൂറ്റാണ്ടിൽ ഈജിപ്തിലെ ശിയാ ഫാത്തിമിദ് ഭരണാധികാരികൾ നാല് മൗലിദുകൾ ആഘോഷിച്ചിരുന്നു: നബി ﷺ,
                            അലി, ഫാത്തിമ, ഭരണത്തിലുള്ള ഖലീഫ.
                        </span>
                        <a href="https://www.britannica.com/topic/mawlid" target="_blank"> Britannica.com</a>
                        <br>
                        <em>- Mawlid article</em>
                    </li>

                    {{-- <li class="mb-2">
                        <span class="fw-bold">ഡോ. യാസിർ ഖാദി (ആധുനിക പണ്ഡിതൻ)</span><br>
                        <span>
                            അൽ-മക്രിസിയും ഇബ്‌നു അൽ-മഅ്മൂനും അടക്കം ചരിത്രകാരന്മാരെ ഉദ്ധരിച്ച് → ഫാത്തിമിദ് ഭരണകാലത്താണ്
                            ആദ്യമായി സർക്കാർ തലത്തിൽ മൗലിദ് ആഘോഷം തുടങ്ങിയത്.
                        </span>
                        <a href="https://5pillarsuk.com/2015/01/01/dr-yasir-qadhi-on-the-origin-of-the-mawlid-and-the-fatimids/"
                            target="_blank"> 5pillarsuk.com</a>
                        <br>
                        <em>- ലേഖനം: Origin of Mawlid and the Fatimids</em>
                    </li>

                    <li class="m-0">
                        <span class="fw-bold">Islamic Centre UK</span><br>
                        <span>
                            മൗലിദിന്റെ ചരിത്രം സംഗ്രഹിച്ച്: ഫാത്തിമിദുകൾ ആണ് ആദ്യമായി സർക്കാർ തലത്തിൽ മൗലിദ് ആരംഭിച്ചത്.
                        </span>
                        <a href="https://5pillarsuk.com/2015/01/01/dr-yasir-qadhi-on-the-origin-of-the-mawlid-and-the-fatimids/"
                            target="_blank"> 5pillarsuk.com</a>
                        <br>
                        <em>- PDF: History of Mawlid</em>
                    </li> --}}
                </ul>
            </div>

            <div class="reference-box mt-0 pb-2" id="ref4">
                <span class="fw-bold">[4]. ഹി. 586 - 630 (എർബിൽ കാലഘട്ടം)</span><br>

                <p class="small fst-italic">
                    ഫാത്വിമി കാലഘട്ടത്തിലെ ആഘോഷങ്ങൾ ശിയാ സ്വാധീനത്തിലായിരുന്നത് കൊണ്ട് സുന്നി പണ്ഡിതന്മാർക്ക്
                    മൗലിദിനോട് എതിർപ്പുണ്ടായിരുന്നു.
                </p>

                <p class="small">
                    മൗലിദ് വലിയ ജനപങ്കാളിത്തത്തോടെ, ദാനധർമ്മം, കവിതകളും പ്രസംഗങ്ങളും ഉൾപ്പെടുത്തി ആഴ്ചകളോളം ആഘോഷിച്ചു.
                </p>

                <ul class="m-0">
                    <li>
                        <span class="fw-bold">ഇബ്ന്‍ ദഹിയ (Ibn Dihya, d. 633H)</span><br>
                        അദ്ദേഹം തന്നെ ഗോക്ബുരിക്കു വേണ്ടി “മൗലിദ്” ഗ്രന്ഥം എഴുതിയിരുന്നു.<br>
                        <em>- al-Tanwīr fī Mawlid al-Bashīr al-Nadhīr</em>
                    </li>

                    <li>
                        <span class="fw-bold">ഇമാദ് അൽദീൻ അൽ-ഇസ്ഫഹാനി (d. 597H)</span><br>
                        അദ്ദേഹം സലാഹുദ്ദീൻ അയ്യൂബിയുടെ കാലഘട്ട ചരിത്രകാരൻ ആണ്. (Ibn Khallikān, Ibn Kathir മുതലായവർ) ഈ രേഖകൾ
                        ആശ്രയിച്ചു.<br>
                        <em>- al-Barq al-Shāmī</em>
                    </li>

                    <li>
                        <span class="fw-bold">ഇബ്ന്‍ ഖലികാൻ (Ibn Khallikān, d. 681H)</span><br>
                        <em>- 'വഫയാത്തുൽ അഅ്യാൻ' (Wafayāt al-Aʿyān)</em>
                    </li>

                    <li>
                        <span class="fw-bold">ഇബ്ന്‍ കസീർ (Ibn Kathīr, d. 774H)</span><br>
                        <em>- 'അൽ-ബിദായ വൻ നിഹായ' (al-Bidāyah wa-l-Nihāyah)</em>
                    </li>

                    <li>
                        <span class="fw-bold">അൽ-സൂയൂത്തി (al-Suyūṭī, d. 911H)</span><br>
                        പ്രശസ്ത ശാഫിഈ പണ്ഡിതൻ.
                        <em>- Husn al-Maqṣid fī ʿAmal al-Mawlid</em>
                    </li>

                    <li class="mb-2">
                        <span class="fw-bold">അൽ-മക്രിസി (Al-Maqrīzī 845 ഹി.)</span><br>
                        <a href="https://archive.org/search?query=%D8%A7%D9%84%D8%AE%D8%B7%D8%B7+%D8%A7%D9%84%D9%85%D9%82%D8%B1%D9%8A%D8%B2%D9%8A"
                            target="_blank">
                            Archive.org
                        </a>
                        <em>- അൽ-ഖിത്തത് </em>
                    </li>
                </ul>
            </div>

            <div class="reference-box mt-0 pb-2" id="ref5">
                <span class="fw-bold">[5]. ഹി. 648 - 923 (മമ്ലുക് സാമ്രാജ്യം)</span><br>
                <p class="small">
                    മമ്ലുക്കുകാർ ഫാത്വിമി കാലഘട്ടത്തിലെ ആഘോഷങ്ങൾ ഏറ്റെടുത്ത് കൂടുതൽ സങ്കീര്‍ണമായ ആഘോഷമായി വികസിപ്പിച്ചു.
                </p>

                <ul class="m-0">
                    <li>
                        <span class="fw-bold">ഇബ്ന്‍ തഘ്രി-ബർദീ (Ibn Taghribirdi)</span><br>
                        <em>- al-Nujūm al-Zāhirah fī Mulūk Miṣr wa-al-Qāhirah</em>
                    </li>

                    <li>
                        <span class="fw-bold">ഇബ്ന്‍ ഇയാസ് (Ibn Iyas)</span><br>
                        <em>- Badā'iʿ al-Zuhūr fī Waqā'iʿ al-Duhūr</em>
                    </li>

                    <li class="mb-2">
                        <span class="fw-bold">അൽ-മക്രിസി (Al-Maqrīzī 845 ഹി.)</span><br>
                        <a href="https://archive.org/search?query=%D8%A7%D9%84%D8%AE%D8%B7%D8%B7+%D8%A7%D9%84%D9%85%D9%82%D8%B1%D9%8A%D8%B2%D9%8A"
                            target="_blank">
                            Archive.org
                        </a>
                        <em>- അൽ-ഖിത്തത് </em>
                    </li>
                </ul>

                <ul class="m-0">
                    <li class="mb-2">
                        <span class="fw-bold">അനുകൂലിച്ച പണ്ഡിതന്മാർ</span><br>
                        <span class="small">
                            അൽ-സുയൂതി (Al-Suyuti ഹിജ്റി 849-911) <em>- Husn al-Maqṣid fī ʿAmal al-Mawlid.</em>
                        </span><br>
                        <span class="small">
                            അൽ-ദിംയാത്തി (Al-Dimyati ഹിജ്റി 850-908) <em>- Al-Mawlid al-Nabawi.</em>
                        </span><br>
                    </li>

                    <li class="mb-2">
                        <span class="fw-bold">എതിർത്ത പണ്ഡിതന്മാർ</span><br>
                        <span class="small">
                            ഇബ്ന്‍ തയ്മിയ്യ (Ibn Taymiyyah ഹിജ്റി 661-728) <em>- Iqtidā' al-Sirāt al-Mustaqīm.</em>
                        </span><br>
                        <span class="small">
                            ഇമാം അൽ-ഷാതിബി (Imam al-Shatibi ഹിജ്റി 538-790) <em>- Al-I'tisām.</em>
                        </span><br>
                        <span class="small">
                            ഇബ്ന്‍ അൽ-ഹാജ് (Ibn al-Hajj ഹിജ്റി 723-799) <em>- Madkhal al-Hawāyi.</em>
                        </span><br>
                    </li>
                </ul>
            </div>

            <div class="reference-box mt-0 pb-2" id="ref6">
                <span class="fw-bold">[6]. ഹി. 648 - 923 ഹി. 699 - 1342 (ഒട്ടോമാൻ സാമ്രാജ്യം)</span><br>
                <ul class="m-0">
                    <li>
                        <span class="fw-bold">Halil İnalcık</span><br>
                        <em>- The Ottoman Empire and Its Heritage</em><br>
                        <em>- The Ottoman Empire: The Classical Age 1300-1600</em>
                    </li>

                    <li>
                        <span class="fw-bold">Daniel Goffman</span><br>
                        <em>- The Ottoman Empire and Early Modern Europe</em>
                    </li>

                    <li>
                        <span class="fw-bold">ames M. Perry</span><br>
                        <em>- Ottoman Imperialism and the Bosnian Ulema</em>
                    </li>
                </ul>
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
                    // ✅ Remove highlight ONLY from this offcanvas-body
                    offcanvasBody.querySelectorAll('.summary-box').forEach(child => {
                        child.classList.remove('summary-box');
                        child.classList.add('reference-box');
                    });

                    // ✅ If refId is provided, scroll + highlight
                    if (refId) {
                        const target = document.getElementById(refId);
                        if (target) {
                            target.scrollIntoView({
                                behavior: 'smooth',
                                block: 'start'
                            });
                            target.classList.add('summary-box');
                        }
                    }
                }, {
                    once: true
                });
            });
        });
    </script>
@endpush
