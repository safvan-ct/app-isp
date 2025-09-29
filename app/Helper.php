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
            'purify' => 'ശുദ്ധി',
            'namaz'  => 'നിസ്കാരം',
            'meelad' => 'നബിദിനം',
            // 'നോമ്പ്',
            // 'സകാത്',
            // 'ഹജ്ജ്',
            // 'വിശ്വാസം',
            // 'വിവാഹം',
            // 'അഖീഖത്',
            // 'ഈദ് (പെരുന്നാൾ)',
            // 'അറിവ് (വിദ്യാഭ്യാസം)',
            // 'മരണം & ചടങ്ങുകൾ ',
            // 'ജീവിത ശൈലി',
            // 'സമ്പാദ്യം',
        ];
    }
}

if (! function_exists('getTopicChapters')) {
    function getTopicChapters($key = '')
    {
        $data = [
            "purify" => [
                "slug"    => "purify",
                "title"   => "ശുദ്ധി",
                "desc"    => "ശുചിത്വം വിശ്വാസത്തിന്റെ പകുതിയാണ് <em>- മുസ്ലിം:534</em>",
                "modules" => [
                    [
                        "title"   => "വുദു",
                        "desc"    => "ശുചിത്വം വിശ്വാസത്തിന്റെ പകുതിയാണ് <em>- മുസ്ലിം:534</em>",
                        "lessons" => [
                            "വുളൂഅ് നിർബന്ധമാകുന്ന കാര്യങ്ങൾ",
                            "വുളൂഇന്റെ നിബന്ധനകൾ (ശർത്ത്)",
                            "വുളൂഇന്റെ ഫർദുകൾ (നിർബന്ധ ഘടകങ്ങൾ)",
                            "വുളൂഇന്റെ സുന്നത്ത് (ഐച്ഛിക) കാര്യങ്ങൾ",
                            "വുളൂഇന്റെ രൂപം",
                            "വുളൂഅ് മുറിയുന്ന കാര്യങ്ങള്‍",
                            "വുദു ഉത്തമമായ കാര്യങ്ങൾ",
                        ],
                    ],
                    [
                        "title"   => "കുളി",
                        "desc"    => "ശുചിത്വം വിശ്വാസത്തിന്റെ പകുതിയാണ് <em>- മുസ്ലിം:534</em>",
                        "lessons" => [
                            "കുളി നിർബന്ധമാക്കുന്ന കാര്യങ്ങൾ",
                            "കുളിയുടെ രൂപം (ഗുസ്ൽ)",
                        ],
                    ],
                    [
                        "title"   => "തയ്യമ്മും",
                        "desc"    => "വെള്ളം ലഭ്യമല്ലാത്തതോ ഉപയോഗിക്കാൻ തടസ്സമുള്ളതോ ആയ അവസരങ്ങളിൽ വുളൂഇനും കുളിക്കും പകരമായി ശുദ്ധമായ മണ്ണ് ഉപയോഗിച്ച് മുഖവും കൈകളും തടവുന്ന ശുദ്ധീകരണ രീതിയാണ് തയമ്മും.",
                        "lessons" => [
                            "എന്താണ് തയമ്മും?",
                            "തയമ്മും അനുവദനീയമാകുന്ന സാഹചര്യങ്ങൾ",
                            "തയമ്മുമിന്റെ രൂപം",
                            "തയമ്മും മുറിയുന്ന കാര്യങ്ങൾ",
                        ],
                    ],
                    [
                        "title"   => "നജസുകൾ",
                        "desc"    => "ശുചിത്വം വിശ്വാസത്തിന്റെ പകുതിയാണ് <em>- മുസ്ലിം:534</em>",
                        "lessons" => [
                            "നജസ് (അശുദ്ധി)",
                            "നജസ് ശുദ്ധീകരിക്കുന്ന രീതി",
                        ],
                    ],
                    [
                        "title"   => "ആർത്തവം & പ്രസവരക്തം",
                        "desc"    => "ശുചിത്വം വിശ്വാസത്തിന്റെ പകുതിയാണ് <em>- മുസ്ലിം:534</em>",
                        "lessons" => [
                            "ഹയ്ദ് & നിഫാസ്: അടിസ്ഥാന വിവരങ്ങൾ",
                            "ആർത്തവ സംബന്ധമായ വിധി വിലക്കുകൾ",
                        ],
                    ],
                    [
                        "title"   => "സുന്നത്തായ ശുദ്ധീകരണങ്ങൾ",
                        "desc"    => "ശുചിത്വം വിശ്വാസത്തിന്റെ പകുതിയാണ് <em>- മുസ്ലിം:534</em>",
                        "lessons" => [
                            "നബിമാരുടെ ചര്യകൾ (ശുദ്ധപ്രകൃതി ചര്യകള്‍)",
                            "വിസർജ്ജന മര്യാദകൾ",
                            "നഖം വെട്ടൽ",
                        ],
                    ],
                ],
            ],
            "namaz"  => [
                "slug"    => "namaz",
                "title"   => "സ്വലാത് (നമസ്കാരം)",
                "desc"    => "തീർച്ചയായും നമസ്കാരം വിശ്വാസികൾക്ക് സമയബന്ധിതമായ ബാധ്യതയായി വിധിക്കപ്പെട്ടിരിക്കുന്നു.",
                "modules" => [
                    [
                        "title"   => "5 നിർബന്ധിത നമസ്കാരങ്ങൾ",
                        "desc"    => "തീർച്ചയായും നമസ്കാരം വിശ്വാസികൾക്ക് സമയബന്ധിതമായ ബാധ്യതയായി വിധിക്കപ്പെട്ടിരിക്കുന്നു.",
                        "lessons" => [],
                    ],
                    [
                        "title"   => "അദാൻ & ഇഖാമത്ത്",
                        "desc"    => "തീർച്ചയായും നമസ്കാരം വിശ്വാസികൾക്ക് സമയബന്ധിതമായ ബാധ്യതയായി വിധിക്കപ്പെട്ടിരിക്കുന്നു.",
                        "lessons" => [],
                    ],
                    [
                        "title"   => "നമസ്‌കാരത്തിന്റെ ശര്‍ത്തുകള്‍",
                        "desc"    => "തീർച്ചയായും നമസ്കാരം വിശ്വാസികൾക്ക് സമയബന്ധിതമായ ബാധ്യതയായി വിധിക്കപ്പെട്ടിരിക്കുന്നു.",
                        "lessons" => [],
                    ],
                    [
                        "title"   => "നമസ്കാരത്തിന്റെ ഫർളുകൾ",
                        "desc"    => "തീർച്ചയായും നമസ്കാരം വിശ്വാസികൾക്ക് സമയബന്ധിതമായ ബാധ്യതയായി വിധിക്കപ്പെട്ടിരിക്കുന്നു.",
                        "lessons" => [],
                    ],
                    [
                        "title"   => "ജമാഅത് (സംഘം) ചേർന്ന് നമസ്കരിക്കൽ",
                        "desc"    => "തീർച്ചയായും നമസ്കാരം വിശ്വാസികൾക്ക് സമയബന്ധിതമായ ബാധ്യതയായി വിധിക്കപ്പെട്ടിരിക്കുന്നു.",
                        "lessons" => [],
                    ],
                    [
                        "title"   => "നമസ്കാരത്തിന് ശേഷമുള്ള ദുആ",
                        "desc"    => "തീർച്ചയായും നമസ്കാരം വിശ്വാസികൾക്ക് സമയബന്ധിതമായ ബാധ്യതയായി വിധിക്കപ്പെട്ടിരിക്കുന്നു.",
                        "lessons" => [],
                    ],
                    [
                        "title"   => "ജുമുഅ നമസ്കാരം",
                        "desc"    => "തീർച്ചയായും നമസ്കാരം വിശ്വാസികൾക്ക് സമയബന്ധിതമായ ബാധ്യതയായി വിധിക്കപ്പെട്ടിരിക്കുന്നു.",
                        "lessons" => [],
                    ],
                    // "തറാവീഹ് നമസ്കാരം",
                    // "വിത്ർ നമസ്കാരം",
                    // "തഹജ്ജുദ് നമസ്കാരം",
                    // "ളുഹാ നമസ്കാരം",
                ],
            ],
            "meelad" => [
                "slug"    => "meelad",
                "title"   => "നബിദിനം",
                "desc"    => "നബിദിനം ആഘോഷിക്കേണ്ടതിന്റെ അടിസ്ഥാനവും ശ്രേഷ്ഠതയും",
                "modules" => [
                    [
                        "title"   => "റബീഉൽ അവ്വൽ മാസവും നബിദിനവും",
                        "desc"    => "നബിദിനം ആഘോഷിക്കേണ്ടതിന്റെ അടിസ്ഥാനവും ശ്രേഷ്ഠതയും",
                        "lessons" => [
                            "റബീഉൽ അവ്വൽ മാസവും പ്രത്യേക ഇബാദത്തുകളും",
                            "റ. അവ്വൽ 12",
                            "പ്രവാചക സ്നേഹം: അതിരുകളും ആഘോഷവും",
                            "അനാചാരങ്ങളെക്കുറിച്ചുള്ള മുന്നറിയിപ്പ്",
                        ],
                    ],
                    [
                        "title"   => "നബിദിന ആഘോഷങ്ങളുടെ ചരിത്രം",
                        "desc"    => "കാലഘട്ടങ്ങളിലൂടെ നബിദിന (മൗലിദ്) ആഘോഷങ്ങളുടെ വികാസം",
                        "lessons" => [],
                    ],
                    [
                        "title"   => "മൗലിദ് കൃതികൾ - ചരിത്രം",
                        "desc"    => "പ്രധാനപ്പെട്ട മൗലിദ് കൃതികളും ആരംഭവും",
                        "lessons" => [],
                    ],
                ],
            ],
        ];

        return empty($key) ? $data : $data[$key];
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
        ];

        return empty($slug) ? $data : $data[$slug];
    }

}

if (! function_exists('getChapterNotes')) {
    function getChapterNotes($topic, $module)
    {
        $file = database_path("json/{$topic}/{$module}.json");
        $data = json_decode(file_get_contents($file), true);

        return $data;
    }
}
