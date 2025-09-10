@extends('layouts.app')

@section('content')
    <div class="topbar d-flex align-items-center justify-content-between notranslate">
        <a href="{{ route('questions.show', ['menu_slug' => 'festival', 'module_slug' => $questions['slug']]) }}" class="me-2">
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
                    <h5>ഹി. 1128 - 1177</h5>
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
                                വര്യന്റെ സ്തുതികളെ വാഴ്‌ത്തുന്നതാണ് മുഹ്‌യിദ്ദീൻ മാല)</em>
                        </span><br>
                        <em> - ~ഖാദി മുഹമ്മദ് ഇബ്‌നു അബ്ദുൽ അസീസ് (കോഴിക്കോട് ഖാളിയും, ഖാദിരിയ്യ സൂഫി യതിയും)</em>
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
                        <em> - ~ഉമർ ഖാദി (ഖാദി മുഹമ്മദ്)</em>
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
@endsection
