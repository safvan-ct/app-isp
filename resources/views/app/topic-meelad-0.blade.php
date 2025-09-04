@extends('layouts.app')

@section('content')
    <div class="topbar d-flex align-items-center justify-content-between notranslate">
        <a href="{{ route('questions.show', ['menu_slug' => 'festival', 'module_slug' => 1]) }}" class="me-2">
            <i class="fas fa-chevron-left fs-3 text-secondary"></i>
        </a>

        <h6 class="fw-bold m-0 text-emerald text-center">റ. അവ്വൽ മാസത്തിന്റെ ശ്രേഷ്ഠത, റ.അ. 12 ന്റെ അടിസ്ഥാനം</h6>

        <a href="javascript:void(0);" data-bs-toggle="offcanvas" data-bs-target="#overviewPanel">
            <i class="fas fa-list fs-3 text-muted"></i>
        </a>
    </div>

    <div class="container my-3 pb-5">
        <div class="base-card text-center bg-app mb-4 shadow-sm rounded-4">
            <h5 class="text-emerald-900">റ. അവ്വൽ മാസത്തിന്റെ ശ്രേഷ്ഠത, റ.അ. 12 ന്റെ അടിസ്ഥാനം</h5>
            <p class="text-muted mb-2">ഖുർആൻ, ഹദീസ്, പ്രാമാണിക തെളിവുകൾ ഉൾക്കൊള്ളുന്ന ഘട്ടം ഘട്ടമായുള്ള മാർഗനിർദേശം.</p>
            <div class="small">
                ✍️ Author: Author Name • Reviewed • Verified <br>
                ⏱️ Last review: Sep 04, 2025 by Reviewer Name
            </div>
        </div>

        <!-- Lesson Body -->
        <div class="lesson-body">
            <h5 class="text-emerald">ഖുർആൻ പരാമർശം</h5>
            <p>ഖുർആനിൽ പ്രത്യേക പരാമർശമില്ല.</p>

            <h5 class="text-emerald">ഹദീസ് പരാമർശം</h5>
            <p class="m-0">സഹീഹ് ഹദീസുകളിൽ പ്രത്യേക പരാമർശമില്ല.</p>
            <p class="reference-box mt-0">നബി ﷺ ജനിച്ചത് തിങ്കളാഴ്ച എന്ന് പറയപ്പെട്ടിട്ടുണ്ട്. - മുസ്ലിം: 2747</p>

            <h5 class="text-emerald">ഖലീഫമാരും സ്വഹാബികളും</h5>
            <p>അബൂബക്കർ(റ), ഉമർ (റ), ഉസ്മാൻ (റ), അലി (റ) എന്നിവർ പ്രവാചകൻ ﷺ ജനിച്ച ദിവസം ആഘോഷിച്ചിട്ടില്ല.</p>

            <h5 class="text-emerald">മദ്ഹബുകളുടെ ഇമാമുമാർ</h5>
            <p>ഇമാം അബൂ ഹനീഫ, മാലിക്, ശാഫിഈ, ഹൻബലി — ഇവരുടെ കാലത്ത് റ.അ. മാസത്തെ പ്രത്യേക ആരാധന/ആഘോഷം ഉണ്ടായിട്ടില്ല.
            </p>

            <div class="summary-box">
                <h6>📌 Quick Summary</h6>
                <ul>
                    <li>നബി ﷺ ജന്മദിനം ആഘോഷിച്ചിട്ടില്ല.</li>
                    <li>ഖലീഫാക്കളും സഹാബികളും അത് ചെയ്തിട്ടില്ല.</li>
                    <li>ഖുർആൻ-ൽ നിർദ്ദേശമില്ല.</li>
                    <li>ഹദീസ്: തിങ്കളാഴ്ച നോമ്പ് (മുസ്ലിം: 2747).</li>
                    <li>ഇമാമുമാരുടെ കാലത്ത് ആഘോഷം ഇല്ല.</li>
                    <li>12-ാം തീയതി ചരിത്രത്തിൽ പ്രശസ്തമായെങ്കിലും വ്യത്യസ്ത അഭിപ്രായങ്ങൾ ഉണ്ട്.</li>
                </ul>
            </div>

            <h5 class="text-emerald">12-ാം തീയതി വന്ന പ്രധാന ഉറവിടം</h5>
            <p>ചരിത്രകാരന്മാരുടെ അഭിപ്രായങ്ങൾ വ്യത്യസ്തമാണ്: 8 (ഇബ്ന് ഹസ്മ്), 9 (ഇബ്ന് ദിഹ്യ), 12 (ഇബ്ന് ഇഷാഖ്).
                ഇബ്ന് കതീർ 12-ാം തീയതിയെ പ്രശസ്ത അഭിപ്രായമായി പറയുന്നു (<em>البداية والنهاية 3/375</em>),
                പക്ഷേ മറ്റ് അഭിപ്രായങ്ങളും ശക്തമാണ്.</p>

            <h5 class="text-emerald">References</h5>
            <div class="reference-box">
                <p>
                    <strong>ഇമാം മാലിക്:</strong> “അത് ആരും ചെയ്തിട്ടില്ല, അത് ബിദ്അത് ആണ്.” – <em>അൽ-ഷാതിബി,
                        അൽ-ഇ'തിസാം</em>
                </p>
                <p><strong>ഇമാം ശാഫിഈ:</strong> “ഒരു കാര്യത്തെ നല്ല ബിദ്അത് എന്നും, മോശം ബിദ്അത് എന്നും പറയാം.” –
                    <em>അൽ-ബൈഹഖി</em>
                </p>
                <p><strong>ഇമാം അഹ്മദ്:</strong> “എനിക്ക് അത് ബിദ്അത് ആയി തോന്നുന്നു.” – <em>ഇബ്ന് തൈമിയ്യ, ഇഖ്തിദാഉൽ
                        സിറാത്ത്</em></p>
                <div class="d-flex justify-content-center">
                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="offcanvas"
                        data-bs-target="#referencesPanel">
                        References
                    </button>
                </div>
            </div>

            <h5 class="text-emerald">Trust & Reminder</h5>
            <div class="reference-box">
                <p>🔹 <em>“നിനക്ക് അറിവില്ലാത്ത കാര്യത്തിന്‍റെയും പിന്നാലെ നീ പോകരുത്”</em> – S. 17:36</p>
                <p>🔹 <em>“ഇന്ന് ഞാന്‍ നിങ്ങള്‍ക്ക് നിങ്ങളുടെ മതം പൂര്‍ത്തിയാക്കി തന്നിരിക്കുന്നു”</em> – S. 5:3</p>
                <p>🔹 <em>“ഞാൻ ജനിച്ച ദിവസമായിരുന്നു അത്...”</em> – മുസ്ലിം: 2747</p>
                <p>🔹 <em>“പുതുതായി കണ്ടുപിടിച്ച കാര്യങ്ങളെ സൂക്ഷിക്കുക...”</em> – തിർമിധി: 2676</p>
            </div>

            <h5 class="text-emerald">Related Topics</h5>
            <div class="related-topics">
                @foreach ($questions['chapters'] as $item)
                    @continue($questionSlug == $loop->index)
                    <a
                        href="{{ route('answers.show', ['menu_slug' => 'festival', 'module_slug' => $questions['slug'], 'question_slug' => $loop->index]) }}">
                        <span>
                            <i class="fas fa-play-circle me-2"></i> {{ $loop->index + 1 }} : {{ $item }}
                        </span>
                    </a>
                @endforeach
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
