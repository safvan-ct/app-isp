@extends('layouts.app')

@section('content')
    <div class="topbar d-flex align-items-center justify-content-between notranslate">
        <a href="{{ route('questions.show', ['menu_slug' => 'festival', 'module_slug' => 1]) }}" class="me-2">
            <i class="fas fa-chevron-left fs-3 text-secondary"></i>
        </a>

        <h6 class="fw-bold m-0 text-emerald text-center">മൗലിദ് കൃതികൾ</h6>

        <a href="javascript:void(0);">
            <i class="fas fa-list fs-3 text-muted"></i>
        </a>
    </div>

    <div class="app-header bg-app text-center">
        <h5 class="mb-1 text-emerald fw-bold">മൗലിദ് കൃതികൾ</h5>
        <p class="text-muted m-0">പ്രധാനപ്പെട്ട മൗലിദ് കൃതികളും ആരംഭവും</p>
    </div>

    <div class="container my-2 pb-5">
        <div class="timeline">
            <!-- 633 -->
            <div class="timeline-item">
                <div class="circle"></div>
                <div class="timeline-content pb-1">
                    <h5>ഹി. 633</h5>
                    <p class="mb-1">
                        <span class="fw-bold">മൗലിദ് സിംതുദ്ദുറർ (سمط الدرر)</span><br>
                        <em> - ഇബ്ന്‍ ദഹ്‌യ അൽ-കല്ബി (എർബിൽ കാലഘട്ടം)</em>
                    </p>
                </div>
            </div>

            <!-- 944 -->
            <div class="timeline-item">
                <div class="circle"></div>
                <div class="timeline-content pb-1">
                    <h5>ഹി. 866 - 944</h5>
                    <p class="mb-1">
                        <span class="fw-bold">മൗലിദ് അദ്-ദിബാഈ (المولد الديبعي)</span><br>
                        <em> - അബ്ദുറഹ്‌മാൻ ബിൻ അലി അദ്-ദിബാഈ (യെമൻ).</em>
                    </p>
                </div>
            </div>

            <!-- 1177 -->
            <div class="timeline-item">
                <div class="circle"></div>
                <div class="timeline-content pb-1">
                    <h5>ഹി. 1126 - 1177</h5>
                    <p class="mb-1">
                        <span class="fw-bold">മൗലിദ് അൽ-ബറ്ജൻജി (المولد البرزنجي)</span><br>
                        <em> - ജാഫർ ബിൻ ഹസ്സൻ അൽ-ബറ്ജൻജി അൽ-മദനീ.</em>
                    </p>
                </div>
            </div>

            <!-- Kerela, India -->
            <div class="timeline-item">
                <div class="circle"></div>
                <div class="timeline-content pb-1 bg-info-subtle">
                    <h6 class="fw-bold">
                        അറബിക്കടൽ വ്യാപാരികളും, യെമൻ സൂഫി പണ്ഡിതന്മാരും വഴിയാണ് മൗലിദ് കേരളത്തിലേക്ക് എത്തിയത്.
                    </h6>
                    <em> - Roland E. Miller, Mappila Muslims of Kerala, Oxford University Press, 1992.</em>
                </div>
            </div>

            <!-- 985 -->
            <div class="timeline-item">
                <div class="circle"></div>
                <div class="timeline-content pb-1 bg-secondary-subtle">
                    <h5>~ ഹി. 985</h5>
                    <p class="mb-1">
                        <span class="fw-bold">
                            മുഹ്‌യിദ്ദീൻ മാല <em>(മുഹ്‌യിദ്ദീൻ അബ്ദുൽ ഖാദിർ ജീലാനി എന്ന പ്രമുഖ സൂഫി
                                വര്യന്റെ അപദാനങ്ങളെ വാഴ്‌ത്തുന്നതാണ് മുഹ്‌യിദ്ദീൻ മാല)</em>
                        </span><br>
                        <em> - ഖാദി മുഹമ്മദ് ഇബ്‌നു അബ്ദുൽ അസീസ് (കോഴിക്കോട് ഖാളിയും, ഖാദിരിയ്യ സൂഫി യതിയും)</em>
                    </p>
                </div>
            </div>

            <!-- 905 - 1008 -->
            <div class="timeline-item">
                <div class="circle"></div>
                <div class="timeline-content pb-1 bg-secondary-subtle">
                    <h5>~ ഹി. 1190 - 1290</h5>
                    <p class="mb-1">
                        <span class="fw-bold">മൻഖൂസ് മൗലിദ് (ദിബാഈ, ബറ്ജൻജി പോലുള്ളവ ചുരുക്കി)</span><br>
                        <em> - ~സൈനുദ്ദീൻ മഖ്ദൂം ഒന്നാമൻ.</em>
                    </p>
                </div>
            </div>

            <div class="timeline-item">
                <div class="circle"></div>
                <div class="timeline-content pb-1 bg-secondary-subtle">
                    <h5>~ ഹി. 1157 - 1234</h5>
                    <p class="mb-1">
                        <span class="fw-bold">
                            രിഫാഇ മാല <em>(രിഫാഇ ത്വരീഖത്തിന്റെ സ്ഥാപകനായ ശൈഖ് അഹ്മദുൽ കബീർ രിഫാഇ -
                                ചരിത്രവും സ്തുതികളും വിവരിക്കുന്നു)</em>
                        </span><br>
                        <em> - ഉമർ ഖാദി (ഖാദി മുഹമ്മദ്)</em>
                    </p>
                </div>
            </div>

            <div class="timeline-item">
                <div class="circle"></div>
                <div class="timeline-content pb-1 bg-secondary-subtle">
                    <h5>~ ഹി. 1305</h5>
                    <p class="mb-1">
                        <span class="fw-bold">
                            നഫീസത്ത് മാല <em>(സയ്യിദത്ത് നഫീസത്തുൽ മിസ്‌രിയ്യ (റ) യെക്കുറിച്ചുള്ള സ്തുതികളും അവരുടെ
                                മഹത്വങ്ങളും)</em>
                        </span><br>
                        <em> - ~പുതുശ്ശേരി ആമിനക്കുട്ടി</em>
                    </p>
                </div>
            </div>

            <div class="timeline-item">
                <div class="circle"></div>
                <div class="timeline-content pb-1 bg-secondary-subtle">
                    <h5>~ ഹി. 1366 - 1443</h5>
                    <p class="mb-1">
                        <span class="fw-bold">മജ്‌ലിസുന്നൂർ</span><br>
                        <em> - പാണക്കാട് സയ്യിദ് ഹൈദരലി ശിഹാബ് തങ്ങൾ</em>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Overview Offcanvas -->
    <div class="offcanvas offcanvas-end d-none" tabindex="-1" id="overviewPanel">
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
