<?php

use Illuminate\Support\Facades\Storage;

function uploadFile($file, $path)
{
    Storage::disk('public')->put($path, file_get_contents($file));
}

function getFile($path, $dummy = 'img/logo.png')
{
    return Storage::disk('public')->exists($path) ? Storage::disk('public')->url($path) : asset($dummy);
}

function deleteFile($path)
{
    Storage::disk('public')->delete($path);
}

if (! function_exists('convertAsTitle')) {
    function convertAsTitle($string)
    {
        // Convert to Title Case
        $title = ucwords($string);

        // Very basic pluralization (naive approach)
        if (str_ends_with($title, 'y')) {
            // e.g., "Category" -> "Categories"
            $plural = substr($title, 0, -1) . 'ies';
        } elseif (str_ends_with($title, 's')) {
            // e.g., "Class" -> "Classes"
            $plural = $title . 'es';
        } else {
            // e.g., "Book" -> "Books"
            $plural = $title . 's';
        }

        return $plural;
    }
}

if (! function_exists('truncateHtml')) {
    function truncateHtml($text, $limit = 255, $end = '...')
    {
        $doc = new DOMDocument();
        @$doc->loadHTML('<?xml encoding="utf-8" ?>' . $text);
        $total = 0;

        $traverse = function ($node) use (&$traverse, &$total, $limit, $end) {
            if ($node->nodeType === XML_TEXT_NODE) {
                $len = mb_strlen($node->nodeValue);
                if ($total + $len > $limit) {
                    $node->nodeValue = mb_substr($node->nodeValue, 0, $limit - $total) . $end;
                    while ($node->nextSibling) {
                        $node->parentNode->removeChild($node->nextSibling);
                    }
                    return false;
                }
                $total += $len;
            } else {
                foreach (iterator_to_array($node->childNodes) as $child) {
                    if ($traverse($child) === false) {
                        while ($child->nextSibling) {
                            $child->parentNode->removeChild($child->nextSibling);
                        }
                        return false;
                    }
                }
            }
            return true;
        };

        $traverse($doc->documentElement);
        return preg_replace('~<(?:!DOCTYPE|/?(?:html|body))[^>]*>\s*~i', '', $doc->saveHTML());
    }
}

if (! function_exists('exploreTopics')) {
    function exploreTopics()
    {
        return [
            'islam'   => 'ഇസ്ലാം',
            'purify'  => 'ശുദ്ധി',
            'namaz'   => 'നമസ്കാരം',
            'zakat'   => 'സകാത്',
            'fasting' => 'നോമ്പ്',
            'hajj'    => 'ഹജ്ജ്',
            'death'   => 'മരണം',
            'birth'   => 'ജനനം',
            'milad'   => 'നബിദിനം',
            'dua'     => 'ദുആ',
            // 'വിവാഹം',
            // 'അഖീഖത്',
            // 'ഈദ് (പെരുന്നാൾ)',
            // 'അറിവ് (വിദ്യാഭ്യാസം)',
            // 'ജീവിത ശൈലി',
            // 'സമ്പാദ്യം',
        ];
    }
}

if (! function_exists('getTopicChapters')) {
    function getTopicChapters($key = '')
    {
        $data = [
            "islam"   => [
                "slug"    => "islam",
                "title"   => "ഇസ്ലാം",
                "desc"    => "പ്രപഞ്ച സ്രഷ്ടാവായ ഏകദൈവത്തിന് സമ്പൂർണ്ണമായി കീഴടങ്ങി ജീവിക്കുക എന്നതാണ് ഇസ്‌ലാം എന്നതുകൊണ്ട് ഉദ്ദേശിക്കുന്നത്.",
                "modules" => [
                    "introduction" => [
                        "slug"    => "introduction",
                        "title"   => "മുസ്ലിം ആവാനുള്ള അടിസ്ഥാനം",
                        "lessons" => [],
                    ],
                    "five-pillars" => [
                        "slug"    => "five-pillars",
                        "title"   => "ഇസ്‌ലാമിന്റെ തത്ത്വങ്ങൾ",
                        "lessons" => [],
                    ],
                    "six-beliefs"  => [
                        "slug"    => "six-beliefs",
                        "title"   => "വിശ്വാസത്തിന്റെ അടിസ്ഥാനങ്ങൾ",
                        "lessons" => [],
                    ],
                ],
            ],
            "purify"  => [
                "slug"    => "purify",
                "title"   => "ശുദ്ധി",
                "desc"    => "ശുചിത്വം വിശ്വാസത്തിന്റെ പകുതിയാണ് <em>- മുസ്ലിം:534</em>",
                "modules" => [
                    "ablution"                  => [
                        "slug"    => "ablution",
                        "title"   => "വുദു",
                        "lessons" => [
                            "conditions"      => "നിബന്ധനകൾ (ശർത്ത്)",
                            "obligations"     => "നിർബന്ധ ഘടകങ്ങൾ",
                            "sunnah"          => "സുന്നത്ത് ഘടകങ്ങൾ",
                            "procedure"       => "രൂപം",
                            "nullifiers-acts" => "മുറിയുന്ന കാര്യങ്ങള്‍",
                            "mandatory-acts"  => "നിർബന്ധമാകുന്ന ആരാധനകൾ",
                            "preferable-acts" => "സുന്നത്തായ ആരാധനകൾ",
                        ],
                    ],
                    "ghusl"                     => [
                        "slug"    => "ghusl",
                        "title"   => "കുളി",
                        "desc"    => "ശുചിത്വം വിശ്വാസത്തിന്റെ പകുതിയാണ് <em>- മുസ്ലിം:534</em>",
                        "lessons" => [
                            "obligating-situations" => "നിർബന്ധമാക്കുന്ന സാഹചര്യങ്ങൾ",
                            "procedure"             => "രൂപം (ഗുസ്ൽ)",
                        ],
                    ],
                    "tayammum"                  => [
                        "slug"    => "tayammum",
                        "title"   => "തയ്യമ്മും",
                        "desc"    => "വെള്ളം ലഭ്യമല്ലാത്തതോ ഉപയോഗിക്കാൻ തടസ്സമുള്ളതോ ആയ അവസരങ്ങളിൽ വുളൂഇനും കുളിക്കും പകരമായി ശുദ്ധമായ മണ്ണ് ഉപയോഗിച്ച് മുഖവും കൈകളും തടവുന്ന ശുദ്ധീകരണ രീതിയാണ് തയമ്മും.",
                        "lessons" => [
                            "permissible-situations" => "അനുവദനീയമാകുന്ന സാഹചര്യങ്ങൾ",
                            "procedure"              => "തയ്യമ്മും രൂപം",
                            "nullifiers-acts"        => "തയമ്മും മുറിയുന്ന കാര്യങ്ങൾ",
                        ],
                    ],
                    "impurity"                  => [
                        "slug"    => "impurity",
                        "title"   => "നജസുകൾ",
                        "desc"    => "ശുചിത്വം വിശ്വാസത്തിന്റെ പകുതിയാണ് <em>- മുസ്ലിം:534</em>",
                        "lessons" => [],
                    ],
                    "toileting-etiquettes"      => [
                        "slug"    => "toileting-etiquettes",
                        "title"   => "വിസർജ്ജന മര്യാദകൾ",
                        "desc"    => "ശുചിത്വം വിശ്വാസത്തിന്റെ പകുതിയാണ് <em>- മുസ്ലിം:534</em>",
                        "lessons" => [],
                    ],
                    "recommended-purifications" => [
                        "slug"    => "recommended-purifications",
                        "title"   => "സുന്നത്തായ ശുദ്ധീകരണങ്ങൾ",
                        "desc"    => "ശുചിത്വം വിശ്വാസത്തിന്റെ പകുതിയാണ് <em>- മുസ്ലിം:534</em>",
                        "lessons" => [],
                    ],
                ],
            ],
            "namaz"   => [
                "slug"    => "namaz",
                "title"   => "നമസ്കാരം",
                "desc"    => "തീർച്ചയായും നമസ്കാരം വിശ്വാസികൾക്ക് സമയബന്ധിതമായ ബാധ്യതയായി വിധിക്കപ്പെട്ടിരിക്കുന്നു.",
                "modules" => [
                    "introduction"          => [
                        "title"   => "ആമുഖം",
                        "slug"    => "introduction",
                        "lessons" => [
                            "definition"           => "എന്താണ് നമസ്ക്കാരം?",
                            "ruling-on-neglecting" => "ഉപേക്ഷിച്ചാലുള്ള വിധി",
                        ],
                    ],
                    "times"                 => [
                        "title"   => "നമസ്കാര സമയങ്ങൾ",
                        "slug"    => "times",
                        "lessons" => [],
                    ],
                    "adan-iqama"            => [
                        "title"   => "ബാങ്ക്, ഇഖാമത്ത്",
                        "slug"    => "adan-iqama",
                        "lessons" => [],
                    ],
                    "conditions"            => [
                        "title"   => "ശര്‍ത്തുകള്‍",
                        "slug"    => "conditions",
                        "lessons" => [],
                    ],
                    "obligations"           => [
                        "title"   => "ഫർളുകൾ",
                        "slug"    => "obligations",
                        "lessons" => [],
                    ],
                    "necessary"             => [
                        "title"   => "വാജിബുകൾ",
                        "slug"    => "necessary",
                        "lessons" => [],
                    ],
                    "sunnah"                => [
                        "title"   => "സുന്നത്തുകൾ",
                        "slug"    => "sunnah",
                        "lessons" => [],
                    ],
                    "sujood-of-sahav"       => [
                        "title"   => "സഹ്‌വിന്റെ സുജൂദ്",
                        "slug"    => "sujood-of-sahav",
                        "lessons" => [],
                    ],
                    "procedure"             => [
                        "title"   => "പൂർണ്ണ രൂപം",
                        "slug"    => "procedure",
                        "lessons" => [
                            "introduction" => "മുൻപുള്ള കാര്യങ്ങൾ",
                            "conditions"   => "ഘടന",
                        ],
                    ],
                    "nullifiers-acts"       => [
                        "title"   => "ബാത്വിലാകുന്ന കാര്യങ്ങൾ",
                        "slug"    => "nullifiers-acts",
                        "lessons" => [],
                    ],
                    "congregational-prayer" => [
                        "title"   => "ജമാഅത് നിസ്കാരം",
                        "slug"    => "congregational-prayer",
                        "lessons" => [],
                    ],
                    "friday-prayer"         => [
                        "title"   => "ജുമുഅ",
                        "slug"    => "friday-prayer",
                        "lessons" => [],
                    ],
                    "after-duas"            => [
                        "title"   => "ശേഷമുള്ള ദിക്റുകൾ",
                        "slug"    => "after-duas",
                        "lessons" => [],
                    ],
                    "sunnah-prayers"        => [
                        "title"   => "സുന്നത് നമസ്കാരങ്ങൾ",
                        "slug"    => "sunnah-prayers",
                        "lessons" => [
                            "eid"       => "ഈദ് നമസ്‌കാരം",
                            "taraweeh"  => "തറാവീഹ് നമസ്കാരം",
                            "witr"      => "വിത്ർ നമസ്കാരം",
                            "tahajjud"  => "തഹജ്ജുദ് നമസ്കാരം",
                            "dhuha"     => "ളുഹാ നമസ്കാരം",
                            "thahiyya"  => "തഹിയ്യത്തുൽ മസ്ജിദ്",
                            "isthiqara" => "ഇസ്തിഖാറ നമസ്‌കാരം (മാർഗ്ഗദർശനം തേടൽ)",
                            "thouba"    => "തൗബ നമസ്‌കാരം",
                        ],
                    ],
                ],
            ],
            "zakat"   => [
                "slug"    => "zakat",
                "title"   => "സകാത്ത്",
                "desc"    => "സമ്പന്നരായ മുസ്‌ലിംകൾ അവരുടെ സമ്പാദ്യത്തിൽ നിന്ന് ഒരു നിശ്ചിത ഭാഗം പാവപ്പെട്ടവർക്ക് നിർബന്ധമായും നൽകുന്ന ധനപരമായ ആരാധനയാണ്.",
                "modules" => [
                    "introduction" => [
                        "slug"    => "introduction",
                        "title"   => "സകാത്ത്",
                        "lessons" => [],
                    ],
                    "sadaqa"       => [
                        "slug"    => "sadaqa",
                        "title"   => "സദഖ (ദാനധർമ്മം)",
                        "lessons" => [],
                    ],
                    "intrest"      => [
                        "slug"    => "intrest",
                        "title"   => "പലിശ",
                        "lessons" => [],
                    ],
                ],
            ],
            "fasting" => [
                "slug"    => "fasting",
                "title"   => "നോമ്പ്",
                "desc"    => "റമളാൻ മാസം കാണുകയോ, ശഅ്ബാൻ 30 പൂർത്തിയാക്കുകയോ ചെയ്താൽ നോമ്പ് നിർബന്ധമാകും.",
                "modules" => [
                    "ramadan"         => [
                        "slug"    => "ramadan",
                        "title"   => "റമളാൻ നോമ്പ്",
                        "lessons" => [],
                    ],
                    "nullifiers-acts" => [
                        "slug"    => "nullifiers-acts",
                        "title"   => "മുറിയുന്ന കാര്യങ്ങൾ",
                        "lessons" => [],
                    ],
                    "sunnah"          => [
                        "slug"    => "sunnah",
                        "title"   => "സുന്നത്ത് നോമ്പുകൾ",
                        "lessons" => [],
                    ],
                ],
            ],
            "hajj"    => [
                "slug"    => "hajj",
                "title"   => "ഹജ്ജ്",
                "desc"    => "കഴിവുള്ള മുസ്‌ലിംകൾ ജീവിതത്തിൽ ഒരിക്കലെങ്കിലും മക്കയിലേക്ക് പോയി അനുഷ്ഠിക്കേണ്ട നിർബന്ധിത തീർത്ഥാടനമാണ്.",
                "modules" => [
                    "hajj"     => [
                        "slug"    => "hajj",
                        "title"   => "ഹജ്ജ്",
                        "lessons" => [
                            "rule"       => "ഹജ്ജിന്റെ നിർബന്ധ ഘടകങ്ങൾ",
                            "ihram"      => "ഇഹ്‌റാം: പ്രവേശന ശുദ്ധിയും തൽബിയത്തും",
                            "safa-merva" => "സഅ്‌യ് (സഫാ-മർവാ ഓട്ടം)",
                            "others"     => "മറ്റുള്ള ആചാരങ്ങൾ",
                        ],
                    ],
                    "umrah"    => [
                        "slug"    => "umrah",
                        "title"   => "ഉംറ",
                        "lessons" => [
                            "rule"       => "ഉംറ: ഇഹ്റാമിൽ പ്രവേശിക്കൽ",
                            "tawaf"      => "കഅ്ബയിലെ ത്വവാഫ്",
                            "safa-merva" => "സഅ്‌യ്: സ്വഫാ-മർവ്വക്കിടയിൽ ഓടൽ",
                            "tahallul"   => "തഹല്ലുൽ: ഇഹ്റാമിൽ നിന്ന് ഒഴിവാകൽ",
                        ],
                    ],
                    "siyarath" => [
                        "slug"    => "siyarath",
                        "title"   => "സിയാറത്ത്",
                        "desc"    => "പ്രത്യേക പ്രതിഫലം ലക്ഷ്യമാക്കി യാത്ര ചെയ്യേണ്ടത് മൂന്ന് പള്ളികളിലേക്ക് മാത്രമാണ്:",
                        "lessons" => [],
                    ],
                ],
            ],
            "death"   => [
                "slug"    => "death",
                "title"   => "മരണം",
                "desc"    => "മരണം എല്ലാ സൃഷ്ടികൾക്കും നിശ്ചയിക്കപ്പെട്ടതും ഒഴിച്ചുകൂടാനാവാത്തതുമാണ്.",
                "modules" => [
                    "introduction"       => [
                        "slug"    => "introduction",
                        "title"   => "വിശ്വാസവും തയ്യാറെടുപ്പും",
                        "lessons" => [
                            "definition" => "മരണം: വിശ്വാസവും തയ്യാറെടുപ്പും",
                            "types"      => "മരണങ്ങൾ",
                        ],
                    ],
                    "rituals"            => [
                        "slug"    => "rituals",
                        "title"   => "മരണ വീട്ടിലെ ആചാരങ്ങൾ",
                        "lessons" => [],
                    ],
                    "kafan"              => [
                        "slug"    => "kafan",
                        "title"   => "കുളിപ്പിക്കൽ, കഫൻ ചെയ്യൽ",
                        "lessons" => [],
                    ],
                    "funeral-procession" => [
                        "slug"    => "funeral-procession",
                        "title"   => "വിലാപ യാത്ര, മയ്യിത്ത് നമസ്കാരം",
                        "lessons" => [],
                    ],
                    "grave-visitation"   => [
                        "slug"    => "grave-visitation",
                        "title"   => "മറമാടൽ, ഖബർ സന്ദർശനം",
                        "lessons" => [],
                    ],
                ],
            ],
            "birth"   => [
                "slug"    => "birth",
                "title"   => "ജനനം",
                "desc"    => "കുട്ടി ജനിച്ചാൽ മാതാപിതാക്കൾ ശ്രദ്ധിക്കേണ്ട കാര്യങ്ങൾ",
                "modules" => [
                    "introduction" => [
                        "slug"    => "introduction",
                        "title"   => "കുട്ടി ജനിച്ചാൽ ആചാരങ്ങൾ",
                        "lessons" => [],
                    ],
                ],
            ],
            "milad"   => [
                "slug"    => "milad",
                "title"   => "നബിദിനം",
                "desc"    => "നബിദിനം ആഘോഷിക്കേണ്ടതിന്റെ അടിസ്ഥാനവും ശ്രേഷ്ഠതയും",
                "modules" => [
                    "milad-un-nabi"  => [
                        "slug"    => "milad-un-nabi",
                        "title"   => "റ. അവ്വൽ & നബിദിനം",
                        "lessons" => [],
                    ],
                    "milad-history"  => [
                        "slug"    => "milad-history",
                        "title"   => "നബിദിന ആഘോഷങ്ങളുടെ ചരിത്രം",
                        "lessons" => [],
                    ],
                    "mawlid-history" => [
                        "slug"    => "mawlid-history",
                        "title"   => "മൗലിദ് കൃതികൾ - ചരിത്രം",
                        "lessons" => [],
                    ],
                ],
            ],
            "dua"     => [
                "slug"    => "dua",
                "title"   => "ദുആ",
                "desc"    => "പ്രാർത്ഥനകളും ദുആകളും ഇസ്‌ലാമിൽ വളരെയധികം പ്രാധാന്യമുള്ള കാര്യങ്ങളാണ്.",
                "modules" => [
                    "introduction" => [
                        "slug"    => "introduction",
                        "title"   => "പ്രാർത്ഥനകളും പ്രത്യേക സമയങ്ങളും",
                        "lessons" => [],
                    ],
                    "quran"        => [
                        "slug"    => "quran",
                        "title"   => "ഖുർആൻ ആയത്തുകൾ ",
                        "lessons" => [],
                    ],
                ],
            ],
        ];

        return empty($key) ? $data : $data[$key] ?? [];
    }
}

if (! function_exists('hadithBookName')) {
    function hadithBookName($slug)
    {
        $data = [
            'sahih-bukhari' => 'ബുഖാരി',
            'sahih-muslim'  => 'മുസ്ലിം',
            'al-tirmidhi'   => 'തിർമിധി',
            'abu-dawood'    => 'അബു ദാവൂദ്',
            'ibn-e-majah'   => 'ഇബ്‍ൻ മാജഹ്',
            "sunan-nasai"   => 'നസാഇ',
            "mishkat"       => "മിഷ്‌കാത്",
            "muwatta-malik" => "മുവത്ത മാലിക്",
        ];

        return empty($slug) ? $data : $data[$slug] ?? '';
    }

}

if (! function_exists('getModuleLesson')) {
    function getModuleLesson($folder, $file)
    {
        $data = database_path("topics/{$folder}/{$file}.json");

        return json_decode(file_get_contents($data), true);
    }
}
