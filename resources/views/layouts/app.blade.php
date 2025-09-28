<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title class="notranslate">@yield('title', __('app.islamic_study_portal'))</title>

    <!-- Favicon for most browsers -->
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('img/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('img/favicon-16x16.png') }}">
    <link rel="shortcut icon" href="{{ asset('img/favicon.ico') }}" type="image/x-icon">

    <!-- Android Chrome -->
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('img/android-chrome-192x192.png') }}">
    <link rel="icon" type="image/png" sizes="512x512" href="{{ asset('img/android-chrome-512x512.png') }}">

    <!-- Apple Touch Icon -->
    <link rel="apple-touch-icon" href="{{ asset('img/apple-touch-icon.png') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Playfair+Display:wght@600;700&family=Amiri:wght@400;700&family=Lateef&family=Scheherazade+New:wght@400;700&family=Tajawal:wght@400;500;700&family=Cairo:wght@400;600;700&family=Markazi+Text:wght@400;600;700&family=Noto+Naskh+Arabic:wght@400;700&family=Noto+Kufi+Arabic:wght@400;700&display=swap&family=Noto+Sans+Malayalam&display=swap"
        rel="stylesheet">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">

    @if (App::getLocale() == 'ml')
        <link href="{{ asset('assets/css/style-ml.css') }}" rel="stylesheet">
    @endif

    @stack('styles')
</head>

<body>
    @php
        $routeName = Route::currentRouteName();
        $menu_slug = isset($menuSlug) ? $menuSlug : null;
        $menus = isset($menus) ? $menus : [];
    @endphp

    <nav class="navbar navbar-expand-lg navbar-dark bg-emerald sticky-top shadow-lg notranslate">
        <div class="container">
            <a class="navbar-brand m-0" href="@yield('navbar_url', route('home'))">
                <img src="{{ asset('img/apple-touch-icon.png') }}"class="me-1 rounded-circle shadow-sm"
                    style="height:30px; width:30px;">
                <span class="navbar-brand fw-bold text-accent m-0">@yield('navbar_title', __('app.islamic_study_portal'))</span>
            </a>

            <button class="btn btn-sm btn-outline-emerald text-accent d-lg-none ms-auto" data-bs-toggle="offcanvas"
                data-bs-target="#curriculumOffcanvas">
                <i class="fas fa-list fs-4"></i>
            </button>

            <div class="collapse navbar-collapse d-none d-lg-flex ms-3" id="navbarText">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 gap-2">
                    <li class="nav-item {{ Str::is('quran.*', $routeName) ? 'active' : '' }}">
                        <a href="{{ route('quran.index') }}" class="text-accent text-decoration-none">
                            {{ __('app.quran') }}
                        </a>
                    </li>
                    <li class="nav-item {{ Str::is('hadith.*', $routeName) ? 'active' : '' }}">
                        <a href="{{ route('hadith.index') }}" class="text-accent text-decoration-none">
                            {{ __('app.hadith') }}
                        </a>
                    </li>
                    <li class="nav-item {{ $routeName == 'home' ? 'active' : '' }}">
                        <a href="{{ route('home') }}" class="text-accent text-decoration-none">
                            {{ __('app.home') }}
                        </a>
                    </li>

                    <li
                        class="nav-item {{ Str::is('modules.*', $routeName) || Str::is('questions.*', $routeName) || Str::is('answers.*', $routeName) ? 'active' : '' }}">
                        <a href="{{ route('modules.show', 'topics') }}" class="text-accent text-decoration-none">
                            {{ __('app.topics') }}
                        </a>
                    </li>

                    <li class="nav-item {{ Str::is('likes', $routeName) ? 'active' : '' }}">
                        <a href="javascript:void(0);" class="text-accent text-decoration-none">
                            {{ __('app.books') }}
                        </a>
                    </li>
                </ul>

                <span class="navbar-text">
                    <button class="btn btn-sm btn-outline-emerald text-accent" data-bs-toggle="offcanvas"
                        data-bs-target="#curriculumOffcanvas"><i class="fas fa-list fs-4"></i></button>
                </span>
            </div>
        </div>
    </nav>

    @yield('content')

    <button type="button" class="btn emerald btn-lg rounded-circle shadow border-0" id="btn-back-to-top">
        <i class="fas fa-arrow-up"></i>
    </button>

    <div class="bottom-nav notranslate d-lg-none">
        <a href="{{ route('quran.index') }}" class="{{ Str::is('quran.*', $routeName) ? 'active' : '' }}">
            <i class="fas fa-book-open"></i>{{ __('app.quran') }}
        </a>

        <a href="{{ route('hadith.index') }}" class="{{ Str::is('hadith.*', $routeName) ? 'active' : '' }}">
            <i class="fas fa-bars"></i>{{ __('app.hadith') }}
        </a>

        <a href="{{ route('home') }}" class="{{ $routeName == 'home' ? 'active' : '' }}">
            <i class="fas fa-home"></i>{{ __('app.home') }}
        </a>

        <a href="{{ route('modules.show', 'topics') }}"
            class="{{ Str::is('modules.*', $routeName) || Str::is('questions.*', $routeName) || Str::is('answers.*', $routeName) ? 'active' : '' }}">
            <i class="fas fa-search"></i>{{ __('app.topics') }}
        </a>

        <a href="javascript:void(0);" class="{{ Str::is('likes', $routeName) ? 'active' : '' }}">
            <i class="fas fa-book"></i>{{ __('app.books') }}
        </a>
    </div>

    <div class="offcanvas offcanvas-start notranslate" tabindex="-1" id="menuPanel">
        <!-- Header with logo -->
        <div class="offcanvas-header border-bottom">
            <div class="d-flex align-items-center">
                <img src="{{ asset('img/apple-touch-icon.png') }}" alt="{{ __('app.islamic_study_portal') }}"
                    class="me-2 rounded-circle shadow-sm" style="height:40px;width:40px;">
                <div class="m-0 align-self-center">
                    <h6 class="mb-0 fw-bold">{{ __('app.islamic_study_portal') }}</h6>
                    <small class="text-muted">അറിവ് തേടൂ, വിശ്വാസം വളർത്തൂ.</small>
                </div>
            </div>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"></button>
        </div>

        <div class="offcanvas-body px-0 d-flex flex-column">
            <!-- Main navigation -->
            <nav class="flex-grow-1">
                <ul class="list-unstyled mb-0">
                    <li>
                        <a href="{{ route('home') }}" class="menu-item">
                            <i class="fa-solid fa-house me-2"></i>{{ __('app.home') }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('modules.show', 'topics') }}" class="menu-item">
                            <i class="fa-solid fa-search me-2"></i>{{ __('app.topics') }}
                        </a>
                    </li>
                    <li>
                        <a href="#" class="menu-item">
                            <i class="fa-solid fa-bell me-2"></i>{{ __('app.notifications') }}
                        </a>
                    </li>
                    <li>
                        <a href="#" class="menu-item">
                            <i class="fa-solid fa-gear me-2"></i>{{ __('app.settings') }}
                        </a>
                    </li>
                    <li>
                        <a href="#" class="menu-item">
                            <i class="fa-solid fa-circle-info me-2"></i>{{ __('app.about') }}
                        </a>
                    </li>
                    <li>
                        <a href="#" class="menu-item">
                            <i class="fa-solid fa-lock me-2"></i>{{ __('app.privacy') }}
                        </a>
                    </li>
                </ul>
            </nav>

            <!-- Divider -->
            <hr class="my-2">

            <!-- Account / Logout -->
            <div class="text-center">
                All Rights Reserved &copy; {{ date('Y') }}
                {{-- <a href="#" class="menu-item text-danger fw-semibold border-0">
                    <i class="fa-solid fa-right-from-bracket me-3"></i>{{ __('app.logout') }}
                </a> --}}
            </div>
        </div>
    </div>

    <div class="modal fade" id="addOnModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header notranslate"
                    style="position: sticky; top: 0; z-index: 5; background-color: #f8f9fa;">
                    <h5 class="modal-title me-3" id="addOnModalLabel">Reference — Adhan Start</h5>
                    <div id="google_translate_element" class="mt-2 mb-2 text-center d-none"></div>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body" id="addOnModalBody"></div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <script type="text/javascript">
        function googleTranslateElementInit() {
            new google.translate.TranslateElement({
                pageLanguage: 'en',
                includedLanguages: 'en,ml,hi',
                layout: google.translate.TranslateElement.InlineLayout.SIMPLE
            }, 'google_translate_element');
        }
    </script>
    <script type="text/javascript" src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit">
    </script>

    <script>
        function toArabicNumber(number) {
            const arabicDigits = ["٠", "١", "٢", "٣", "٤", "٥", "٦", "٧", "٨", "٩"];
            return String(number)
                .split("")
                .map((d) => arabicDigits[d] || d)
                .join("");
        }

        document.addEventListener("DOMContentLoaded", () => {
            document.querySelectorAll(".ar-number").forEach((span) => {
                const number = span.textContent.trim();
                span.textContent = toArabicNumber(number);
            });
        });
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

        function searchHadithByNumber() {
            const number = parseInt($('#search').val(), 10);
            const bookId = $('#search').data('book');

            if (isNaN(number) || number < 1) {
                alert("Please enter a valid Hadith number.");
                return;
            }

            window.location.href = "{{ route('hadith.book.verse', [':book', ':verse']) }}"
                .replace(':book', bookId).replace(':verse', number);
        }
    </script>

    <script>
        function openTab(id) {
            const tabEl = document.querySelector('#' + id + '-tab') || document.querySelector('#' + id + '');
            if (tabEl) {
                const tab = new bootstrap.Tab(tabEl);
                tab.show();
            }
        }

        $(document).on('click', '.authentic', function() {
            var $modal = $('#addOnModal');
            var $modalLabel = $('#addOnModalLabel');
            var $modalBody = $('#addOnModalBody');
            var $googleTrans = $('#google_translate_element');

            const slug = $(this).data('slug');
            const number = $(this).data('number');
            const type = $(this).data('type');

            if (type === 'quran') {
                addOnModalLabel = "{{ __('app.quran') }}";
                url = "{{ route('fetch.quran.reference', [':slug', ':number']) }}".replace(':slug', slug).replace(
                    ':number', number);
                $googleTrans.addClass('d-none');
            } else if (type === 'hadith') {
                addOnModalLabel = "{{ __('app.hadith') }}";
                url = "{{ route('fetch.hadith.reference', [':slug', ':number']) }}".replace(':slug', slug).replace(
                    ':number', number);
                $googleTrans.removeClass('d-none');
            } else {
                return;
            }

            $modalLabel.html(addOnModalLabel);
            $modalBody.html(`<div class="text-center text-muted py-3">{{ __('app.loading') }}...</div>`);
            $modal.modal('show');

            $.get(url, function(result) {
                if (!result.html) {
                    $modalBody.html(
                        `<div class="text-danger text-center py-3">{{ __('app.not_found') }}</div>`);
                    return;
                }
                $modalBody.html(result.html);

                $('.ar-number').each(function() {
                    var number = $(this).text().trim();
                    $(this).text(toArabicNumber(number));
                });
            }).fail(function() {
                $modalBody.html(
                    `<div class="text-danger text-center py-3">{{ __('app.not_found') }}</div>`);
            });
        });
    </script>

    @stack('scripts')
</body>

</html>
