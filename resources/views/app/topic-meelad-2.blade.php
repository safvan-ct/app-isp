@extends('layouts.app')

@section('content')
    <div class="topbar d-flex align-items-center justify-content-between notranslate">
        <a href="{{ route('questions.show', ['menu_slug' => 'festival', 'module_slug' => 1]) }}" class="me-2">
            <i class="fas fa-chevron-left fs-3 text-secondary"></i>
        </a>

        <h6 class="fw-bold m-0 text-emerald text-center">ചരിത്രം</h6>

        <a href="javascript:void(0);" data-bs-toggle="offcanvas" data-bs-target="#overviewPanel">
            <i class="fas fa-list fs-3 text-muted"></i>
        </a>
    </div>

    <div class="app-header bg-app text-center">
        <h5 class="mb-1 text-emerald fw-bold">📜 നബിദിന ചരിത്രം</h5>
        <p class="text-muted m-0">കാലഘട്ടങ്ങളിലൂടെ നബിദിന (മൗലിദ്) ആഘോഷങ്ങളുടെ വികാസം</p>
    </div>

    <div class="container my-2 pb-5">
        <div class="timeline">

            <!-- H0 - H300 -->
            <div class="timeline-item">
                <div class="circle"></div>
                <div class="timeline-content">
                    <h5>ആദ്യകാലം (H0 - H300)</h5>
                    <p>നബി (ﷺ) കാലത്തും സഹാബിമാർ കാലത്തും നബിദിനം ആഘോഷിച്ചിരുന്നില്ല.</p>
                    <ul>
                        <li>നബി ﷺ തിങ്കളാഴ്ച നോമ്പ് എടുത്തു → “ഞാൻ ഈ ദിവസമാണ് ജനിച്ചത്” (മുസ്ലിം: 2747).</li>
                    </ul>
                </div>
            </div>

            <!-- Abbasid -->
            <div class="timeline-item">
                <div class="circle"></div>
                <div class="timeline-content">
                    <h5>അബ്ബാസി കാലം (H300 - H500)</h5>
                    <p>ബാഗ്ദാദിലെ അബ്ബാസി ഖിലാഫത്ത് കാലത്ത് ചിലർ നബിദിനം ഓർക്കാൻ സംഗമങ്ങൾ നടത്തി.</p>
                    <ul>
                        <li>ഖുർആൻ വായന, ദുആ</li>
                        <li>നബി ﷺ യെ പുകഴ്ത്തുന്ന കവിതകൾ</li>
                    </ul>
                </div>
            </div>

            <!-- Fatimid -->
            <div class="timeline-item">
                <div class="circle"></div>
                <div class="timeline-content">
                    <h5>ഫാത്തിമി കാലം (H500 - H600)</h5>
                    <p>ഈജിപ്തിലെ ഫാത്തിമികൾ പൊതുവേദിയിൽ ആദ്യമായി നബിദിനം നടത്തി.</p>
                    <ul>
                        <li>ഖുർആൻ പാരായണം, പ്രസംഗം</li>
                        <li>ഭക്ഷണം വിതരണം, ദരിദ്രരെ സഹായിക്കൽ</li>
                    </ul>
                    <p><strong>👉 “നബിദിനം പൊതുഉത്സവം” ആദ്യമായി ഇവിടെ</strong></p>
                </div>
            </div>

            <!-- Erbil -->
            <div class="timeline-item">
                <div class="circle"></div>
                <div class="timeline-content">
                    <h5>എർബിൽ (H600 - H700)</h5>
                    <p>1207-ൽ ഗോക്ക്‌ബുരി എർബിലിൽ വലിയ മൗലിദ് നടത്തി.</p>
                    <ul>
                        <li>ലക്ഷക്കണക്കിന് ആളുകൾ</li>
                        <li>ഭക്ഷണം, കവിത, പ്രസംഗം</li>
                    </ul>
                    <p><strong>👉 ആദ്യത്തെ വലിയ ഔദ്യോഗിക ആഘോഷം</strong></p>
                </div>
            </div>

            <!-- Ottoman -->
            <div class="timeline-item">
                <div class="circle"></div>
                <div class="timeline-content">
                    <h5>ഒട്ടോമാൻ സാമ്രാജ്യം (H900 - H1000)</h5>
                    <p>1588-ൽ മീലാദിനെ സർക്കാർ അവധിയായി പ്രഖ്യാപിച്ചു.</p>
                    <p><strong>👉 “Mevlid Kandil” എന്ന പേരിൽ</strong></p>
                </div>
            </div>

            <!-- Global -->
            <div class="timeline-item">
                <div class="circle"></div>
                <div class="timeline-content">
                    <h5>H1000 - ഇന്ന് വരെ</h5>
                    <ul>
                        <li>ഇന്ത്യ, പാകിസ്ഥാൻ, ടർക്കി, മലേഷ്യ, ആഫ്രിക്ക തുടങ്ങിയിടങ്ങളിൽ വ്യാപിച്ചു</li>
                        <li>പരിപാടികൾ: ഖുർആൻ, മൗലിദ് കവിത, പൊതുഭക്ഷണം</li>
                        <li>ചിലർ: ബിദ്അത് ഹസന (നല്ല പുതുമ)</li>
                        <li>ചിലർ: ബിദ്അത് (ഒഴിവാക്കേണ്ട പുതുമ)</li>
                    </ul>
                </div>
            </div>

            <!-- Makkah -->
            <div class="timeline-item">
                <div class="circle"></div>
                <div class="timeline-content">
                    <h5>🕋 മക്ക</h5>
                    <ul>
                        <li>H0 - H300: ആഘോഷമില്ല</li>
                        <li>H900 - H1200: പൊതുആഘോഷം</li>
                        <li>1924: സൗദി ഭരണത്തിൽ നിരോധനം</li>
                    </ul>
                </div>
            </div>

            <!-- Madinah -->
            <div class="timeline-item">
                <div class="circle"></div>
                <div class="timeline-content">
                    <h5>🌙 മദീന</h5>
                    <ul>
                        <li>H0 - H500: ആഘോഷമില്ല</li>
                        <li>H600 - H700: ചെറിയ സംഗമങ്ങൾ</li>
                        <li>ഒട്ടോമാൻ കാലത്ത്: വലിയ ആഘോഷം</li>
                        <li>1924: സൗദി ഭരണത്തിൽ നിരോധനം</li>
                    </ul>
                </div>
            </div>

            <!-- Palestine -->
            <div class="timeline-item">
                <div class="circle"></div>
                <div class="timeline-content">
                    <h5>🕌 ഫലസ്തീൻ (ഖുദ്സ്)</h5>
                    <ul>
                        <li>H0 - H500: ആഘോഷമില്ല</li>
                        <li>H583: സലാഹുദ്ദീൻ ജറുസലേം വീണ്ടെടുത്തപ്പോൾ → പൊതുആഘോഷം</li>
                        <li>H604: ഗോക്ക്‌ബുരി വലിയ മൗലിദ് നടത്തി</li>
                        <li>ഒട്ടോമാൻ കാലത്ത്: സർക്കാർ പിന്തുണയോടെ വലിയ ഉത്സവം</li>
                        <li>1967 - ഇന്നുവരെ: മത-സാംസ്കാരിക ഐക്യം</li>
                    </ul>
                </div>
            </div>

        </div>

        <button type="button" class="btn btn-primary btn-lg rounded-circle shadow" id="btn-back-to-top">
            <i class="fas fa-arrow-up"></i>
        </button>

        <!-- References Offcanvas -->
        <div class="offcanvas offcanvas-end" tabindex="-1" id="referencesPanel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title">References</h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"></button>
            </div>
            <div class="offcanvas-body">
                <div class="mb-3">
                    <h6>📖 Quran</h6>
                    <blockquote class="blockquote small">
                        <p>وَمَا آتَاكُمُ الرَّسُولُ فَخُذُوهُ وَمَا نَهَاكُمْ عَنْهُ فَانتَهُوا</p>
                        <footer class="blockquote-footer">Surah Al-Hashr 59:7</footer>
                    </blockquote>
                </div>
                <div class="mb-3">
                    <h6>🕌 Hadith</h6>
                    <blockquote class="blockquote small">
                        <p>“Whoever innovates something in this matter of ours that is not part of it, it will be
                            rejected.”</p>
                        <footer class="blockquote-footer">Sahih Bukhari & Muslim</footer>
                    </blockquote>
                </div>
                <div>
                    <h6>📚 Scholars</h6>
                    <p class="small text-muted">Imam Malik: “Whatever was not part of the religion at that time will not
                        be part of the religion today.”</p>
                </div>
            </div>
        </div>

        <!-- Overview Offcanvas -->
        <div class="offcanvas offcanvas-start" tabindex="-1" id="overviewPanel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title">Lesson Overview</h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"></button>
            </div>
            <div class="offcanvas-body">
                <h6>📌 Course: Festivals in Islam</h6>
                <ul class="list-group mb-3">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Meelad (Mawlid) <span class="badge bg-primary">Current</span>
                    </li>
                    <li class="list-group-item">Eid al-Fitr</li>
                    <li class="list-group-item">Eid al-Adha</li>
                    <li class="list-group-item">Laylatul Qadr</li>
                    <li class="list-group-item">Ramadan</li>
                </ul>

                <h6>📖 Progress</h6>
                <div class="progress mb-2">
                    <div class="progress-bar bg-success" style="width:40%">40%</div>
                </div>
                <small class="text-muted">2 of 5 lessons completed</small>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        let backToTop = document.getElementById("btn-back-to-top");

        window.addEventListener("scroll", function() {
            if (document.documentElement.scrollTop > 200) {
                backToTop.classList.add("show");
            } else {
                backToTop.classList.remove("show");
            }
        });

        // Smooth scroll to top
        backToTop.addEventListener("click", function() {
            window.scrollTo({
                top: 0,
                behavior: "smooth"
            });
        });
    </script>
@endpush
