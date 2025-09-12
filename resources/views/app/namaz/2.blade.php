@extends('layouts.app')

@section('content')
    <x-app.topbar :title="$questions['title']" :url="route('questions.show', ['menu_slug' => 'topics', 'module_slug' => $questions['slug']])" />

    <div class="container my-3 pb-5">
        <x-app.banner :title="$questions['chapters'][$questionSlug]" :desc="$questions['desc']" :search="false" :author="'Author Name'" :review="date('M d, Y') . ' by Reviewer Name'" />

        <!-- Lesson Body -->
        <div class="lesson-body">
            <h5 class="text-emerald fw-bold">അദാനിന്റെ ആരംഭം</h5>
            <p class="reference-box mt-0 mb-1">
                മുസ്ലീങ്ങൾ മദീനയിൽ എത്തിയപ്പോൾ അവർ ഒത്തുകൂടി പ്രാർത്ഥന സമയം അറിയാൻ ശ്രമിച്ചു, പക്ഷേ ആരും അവരെ വിളിച്ചില്ല.
                ഒരു ദിവസം അവർ ഈ വിഷയം ചർച്ച ചെയ്തു, അവരിൽ ചിലർ പറഞ്ഞു: ക്രിസ്ത്യാനികളുടെ മണി പോലുള്ള ഒന്ന് ഉപയോഗിക്കുക, ചിലർ
                പറഞ്ഞു: ജൂതന്മാരുടേത് പോലുള്ള ഒരു കൊമ്പ് ഉപയോഗിക്കുക. ഉമർ (റ) ചോദിച്ചു: (ആളുകളെ) പ്രാർത്ഥനയ്ക്ക് വിളിക്കാൻ
                ഒരാളെ നിയമിച്ചുകൂടേ? അല്ലാഹുവിന്റെ ദൂതൻ (സ) പറഞ്ഞു: ഓ ബിലാൽ, എഴുന്നേറ്റ് (ജനങ്ങളെ) പ്രാർത്ഥനയ്ക്ക്
                വിളിക്കുക. <br><em class="small">- മുസ്ലിം: 837, ബുഖാരി:603,604</em>
            </p>

            <div class="summary-box">
                <h5 class="text-emerald fw-bold">അദാനിന്റെ ശര്‍ത്തുകള്‍(നിബന്ധനകള്‍)</h5>
                <ol class="m-0">
                    <li>സമയത്ത് വിളിക്കുക. <em>- നമസ്കാരം സമയക്രമത്തോടെ നിർബന്ധിതമാക്കിയിരിക്കുന്നു. 4:103</em></li>
                    <li>അറബിയിൽ, ശരിയായ വാക്കുകൾ.</li>
                    <li>ക്രമം പാലിക്കുക.</li>
                    <li>തുടർച്ചയായി വിളിക്കുക.</li>
                    <li>
                        മുഅദ്ദിൻ → മുസ്ലിം, ബുദ്ധിശക്തിയുള്ള പുരുഷൻ.
                        <em>ഇമാം ഉത്തരവാദിത്തമുള്ളവനും മുഅദ്ദീൻ വിശ്വസ്തനുമാണ് - അബു ദാവൂദ്:517</em>
                    </li>
                </ol>
            </div>

            <h5 class="text-emerald fw-bold mt-3">അദാനിന്റെ ഘടന</h5>
            <p class="m-0">(ഹയ്യാ അലസ്-സലാഃ) → മുഖം വലത്തേക്ക് തിരിക്കുക.</p>
            <p class="m-0">(ഹയ്യാ അലൽ-ഫലാഹ്) → മുഖം ഇടത്തേക്ക് തിരിക്കുക.</p>
            <p class="m-0">
                പ്രഭാത പ്രാർത്ഥനയാണെങ്കിൽ, നിങ്ങൾ ഉച്ചരിക്കണം:
                <span class="fs-3 text-ar">الصَّلَاةُ خَيْرٌ مِنَ النَّوْمِ</span>
            </p>

            <img src="{{ asset('img/namaz/Azaan.gif') }}" class="icon-img w-100 mb-1 mt-2" style="max-width: 400px" />
            <p class="reference-box mt-0 mb-1">
                നബി ﷺ അദാൻ പഠിപ്പിച്ചു. <em class="small">- മുസ്ലിം: 842, അബു ദാവൂദ്: 500</em>
            </p>
            <p class="reference-box mt-0 mb-1">
                ബിലാൽ (റ) നമസ്കാരത്തിന് അദാൻ ഉച്ചരിക്കുമ്പോൾ മുഖം അങ്ങോട്ടുമിങ്ങോട്ടും തിരിക്കുന്നത് ഞാൻ കണ്ടു.
                <em class="small">- മുസ്ലിം: 634</em>
            </p>
            <p class="reference-box mt-0 mb-1">
                പ്രഭാത പ്രാർത്ഥനയാണെങ്കിൽ, നിങ്ങൾ ഉച്ചരിക്കണം: الصَّلَاةُ خَيْرٌ مِنَ النَّوْمِ
                <em class="small">- അബു ദാവൂദ്: 500</em>
            </p>

            <h5 class="text-emerald fw-bold mt-3">അദാൻ കേൾക്കുമ്പോൾ</h5>
            <p class="reference-box mt-0 mb-1">
                നിങ്ങൾ അദാൻ കേൾക്കുമ്പോഴെല്ലാം മുആദിൻ പറയുന്നത് പോലെ പറയുക.
                <em class="small">- ബുഖാരി:611, മുസ്ലിം:848,849</em>
            </p>
            <p class="reference-box mt-0 mb-1">
                മുഅദ്ദീൻ <span class="fs-4">حَيَّ عَلَى الصَّلَاةِ</span> എന്ന് പറയുമ്പോൾ, ഒരാൾ പ്രതികരിക്കണം: <span
                    class="fs-4">لَا حَوْلَ وَلَا قُوَّةَ إِلَّا بِاللهِ</span> മുഅദ്ദീൻ <span class="fs-4">حَيَّ عَلَى
                    الْفَلَاحِ</span> എന്ന് പറയുമ്പോൾ, <span class="fs-4">لَا حَوْلَ وَلَا قُوَّةَ إِلَّا بِاللهِ</span>
                <em class="small">- മുസ്ലിം:850, ബുഖാരി:613</em>
            </p>

            <h5 class="text-emerald fw-bold mt-3">അദാൻ സമയത്തെ പ്രാർത്ഥന</h5>
            <p class="reference-box mt-0 mb-1 text-ar lh-lg">
                <span class="fs-3">
                    اللَّهُمَّ رَبَّ هَذِهِ الدَّعْوَةِ التَّامَّةِ وَالصَّلاَةِ الْقَائِمَةِ آتِ مُحَمَّدًا الْوَسِيلَةَ
                    وَالْفَضِيلَةَ وَابْعَثْهُ مَقَامًا مَحْمُودًا الَّذِي وَعَدْتَهُ
                </span>
                <em class="small">- ബുഖാരി:614</em>
            </p>

            <h5 class="text-emerald fw-bold mt-3">ഇഖാമത്</h5>
            <img src="{{ asset('img/namaz/iqama.png') }}" class="icon-img w-100 mb-1" style="max-width: 300px" />
            <p class="reference-box mt-0 mb-1">
                ഖാദ്-ഖമത്ത്-ഇസ്-സലാത്ത് ഒഴികെയുള്ള ഇഖാമയുടെ പദങ്ങൾ ഒരിക്കൽ ഉച്ചരിക്കാൻ
                <em class="small">- ബുഖാരി:607, മുസ്ലിം: 838</em>
            </p>

            <h5 class="text-emerald fw-bold mt-3">ഇഖാമത് കേൾക്കുമ്പോൾ</h5>
            <p class="reference-box mt-0">
                മുഅദ്ദീന്റെ വാക്കുകൾ കേൾക്കുമ്പോൾ, അവൻ പറയുന്നത് ആവർത്തിക്കുക.
                <em class="small">- ബുഖാരി:611, മുസ്ലിം:848,849</em>
            </p>

            <div class="summary-box mt-0">
                <h6>Reminders</h6>
                <ul class="m-0">
                    <li>വുദൂ ഇല്ലാതെ അദാൻ വിളിച്ചാലും സാധുവാണ്.</li>
                    <li>പക്ഷേ വുദൂ ഉണ്ടായിരിക്കുമ്പോഴാണ് ഏറ്റവും ഉത്തമം, കാരണം അത് ആരാധനയാണ്.</li>
                    <li>
                        (ഹനഫി, ഷാഫിഈ, മാലികി, ഹൻബലി): ഖിബ്‌ലയ്ക്ക് നേരെ തിരിഞ്ഞ് അദാൻ വിളിക്കുന്നത് സുന്നത്ത് (ശുപാർശ
                        ചെയ്തത്) ആണ്.
                    </li>
                    <li>
                        നിർബന്ധമല്ല. വശത്തേക്ക് നോക്കി വിളിച്ചാലും അദാൻ സാധുവാണ്.
                    </li>
                </ul>
            </div>
        </div>

        <h5 class="text-emerald fw-bold mt-4">Related Topics</h5>
        @foreach ($questions['chapters'] as $item)
            @continue($questionSlug == $loop->index)

            <x-app.related-topics :title="$loop->index + 1 . ' : ' . $item" :url="route('answers.show', [
                'menu_slug' => 'topics',
                'module_slug' => $questions['slug'],
                'question_slug' => $loop->index,
            ])" />
        @endforeach
    </div>
@endsection
