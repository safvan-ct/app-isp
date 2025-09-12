@extends('layouts.app')

@section('content')
    <x-app.topbar :title="$questions['title']" :url="route('questions.show', ['menu_slug' => 'topics', 'module_slug' => $questions['slug']])" />

    <div class="container my-3 pb-5">
        <x-app.banner :title="$questions['chapters'][$questionSlug]" :desc="$questions['desc']" :search="true" :author="'Author Name'" :review="date('M d, Y') . ' by Reviewer Name'" />

        <!-- Lesson Body -->
        <div class="lesson-body">
            <h4 class="text-emerald fw-bold text-center">
                നമസ്കാരം സ്വീകാര്യമാകാനുള്ള നിബന്ധനകൾ മൂന്നെണ്ണം ആവുന്നു.
            </h4>

            <h6 class="text-emerald-900 fw-bold m-0">1. ഇസ്‌ലാം (മുസ്ലിം ആയിരിക്കണം)</h6>
            <p class="ref-box ref-hadith mt-0 mb-1">
                മനുഷ്യർക്കിടയിലും ബഹുദൈവാരാധനയ്ക്കും അവിശ്വാസത്തിനും ഇടയിലും പ്രാർത്ഥനയുടെ അശ്രദ്ധയാണ്.
                <em class="small">- മുസ്ലിം: 246</em>
            </p>

            <h6 class="text-emerald-900 fw-bold m-0 mt-3">2. ബുദ്ധിശക്തി</h6>
            <p class="ref-box ref-hadith mt-0 mb-1">
                മൂന്ന് (ആളുകൾ) അവരുടെ പ്രവൃത്തികൾ രേഖപ്പെടുത്തിയിട്ടില്ല: അവൻ ഉണരുന്നതുവരെ ഉറങ്ങുന്നവൻ,
                പ്രായപൂർത്തിയാകുന്നതുവരെ ഒരു ആൺകുട്ടി, അവൻ യുക്തിസഹമായി വരുന്നത് വരെ ഒരു ഭ്രാന്തൻ.
                <em class="small">- അബു ദാവൂദ്:4403, അൽ-തിർമിധി:1423</em>
            </p>

            <h6 class="text-emerald-900 fw-bold m-0 mt-3">3. പ്രായപൂർത്തി</h6>
            <p class="ref-box ref-hadith mt-0 mb-1">
                നിങ്ങളുടെ കുട്ടികൾക്ക് ഏഴ് വയസ്സാകുമ്പോൾ നിങ്ങൾ അവരോട് നമസ്കരിക്കാൻ കൽപ്പിക്കുക, പത്ത് വയസ്സാകുമ്പോൾ അതിനായി
                അവരെ ശിക്ഷിക്കുക; അവരുടെ കിടക്കകൾ പ്രത്യേകം ക്രമീകരിക്കുക. <em class="small">- അബു ദാവൂദ്: 495</em>
            </p>
        </div>

        <div class="lesson-body mt-3 mb-4">
            <h4 class="text-emerald fw-bold text-center">
                നമസ്കാരം ശരി ആവാനുള്ള നിബന്ധനകൾ അഞ്ചെണ്ണം ആവുന്നു.
            </h4>

            <h6 class="text-emerald-900 fw-bold m-0">1. അശുദ്ധമായ അവസ്ഥയില്‍നിന്നും ശരീരം ശുദ്ധമായിരിക്കുക</h6>
            <p class="ref-box ref-quran mt-0 mb-1">
                സത്യവിശ്വാസികളേ, നിങ്ങള്‍ നമസ്കാരത്തിന് ഒരുങ്ങിയാല്‍, നിങ്ങളുടെ മുഖങ്ങളും, മുട്ടുവരെ രണ്ടുകൈകളും കഴുകുകയും,
                നിങ്ങളുടെ തല തടവുകയും നെരിയാണിവരെ രണ്ട് കാലുകള്‍ കഴുകുകയും ചെയ്യുക(വുദു). നിങ്ങള്‍ ജനാബത്ത് (വലിയ അശുദ്ധി)
                ബാധിച്ചവരായാല്‍ നിങ്ങള്‍ (കുളിച്ച്‌) ശുദ്ധിയാകുക. <em class="small">- 5:6</em>
            </p>
            <p class="ref-box ref-hadith mt-0 mb-1">
                അല്ലാഹു വുദൂ ഇല്ലാതെ ആരുടെയും നിസ്‌കാരം സ്വീകരിക്കുകയില്ല. <em class="small">- ബുഖാരി:6954</em>
            </p>

            <h6 class="text-emerald-900 fw-bold m-0 mt-3">
                2. ശരീരവും വസ്ത്രവും നമസ്‌കരിക്കുന്ന സ്ഥലവും മാലിന്യത്തില്‍നിന്ന് ശുദ്ധമായിരിക്കുക.
            </h6>
            <p class="ref-box ref-quran mt-0 mb-1">
                നിന്‍റെ വസ്ത്രങ്ങള്‍ ശുദ്ധിയാക്കുകയും പാപം വെടിയുകയും ചെയ്യുക.
                <em class="small">- 74:4-5</em>
            </p>

            <h6 class="text-emerald-900 fw-bold m-0 mt-3">3. ഔറത്ത് മറയ്ക്കുക.</h6>
            <p class="ref-box ref-quran mt-0 mb-1">
                ആദം സന്തതികളേ, എല്ലാ ആരാധനാലയത്തിങ്കലും (അഥവാ എല്ലാ ആരാധനാവേളകളിലും) നിങ്ങള്‍ക്ക് അലങ്കാരമായിട്ടുള്ള
                വസ്ത്രങ്ങള്‍ ധരിച്ചുകൊള്ളുക <em class="small">- 7:31</em>
            </p>

            <h6 class="text-emerald-900 fw-bold m-0 mt-3">3. നമസ്‌കാരത്തിന് സമയം ആയിട്ടുണ്ടെന്ന് അറിയുക.</h6>
            <p class="ref-box ref-quran mt-0 mb-1">
                തീര്‍ച്ചയായും നമസ്കാരം സത്യവിശ്വാസികള്‍ക്ക് സമയം നിര്‍ണയിക്കപ്പെട്ട ഒരു നിര്‍ബന്ധബാധ്യതയാകുന്നു. <em
                    class="small">- 4:103</em>
            </p>

            <h6 class="text-emerald-900 fw-bold m-0 mt-3">3. ഖിബ്‌ലയെ അഭിമുഖീകരിക്കുക.</h6>
            <p class="ref-box ref-quran mt-0 mb-1">
                ഏതൊരിടത്ത് നിന്ന് നീ പുറപ്പെടുകയാണെങ്കിലും മസ്ജിദുല്‍ ഹറാമിന്റെ നേര്‍ക്ക് (പ്രാര്‍ത്ഥനാവേളയില്‍) നിന്റെ മുഖം
                തിരിക്കേണ്ടതാണ്‌. <em class="small">- 2:144,149-150</em>
            </p>
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
@endsection
