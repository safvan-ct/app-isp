<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
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

    @yield('content')

    <div class="bottom-nav notranslate">
        <a href="{{ route('quran.index') }}" class="{{ Str::is('quran.*', $routeName) ? 'active' : '' }}">
            <i class="fas fa-book-open"></i>{{ __('app.quran') }}
        </a>

        <a href="{{ route('hadith.index') }}" class="{{ Str::is('hadith.*', $routeName) ? 'active' : '' }}">
            <i class="fas fa-bars"></i>{{ __('app.hadith') }}
        </a>

        <a href="{{ route('home') }}" class="{{ $routeName == 'home' ? 'active' : '' }}">
            <i class="fas fa-home"></i>{{ __('app.home') }}
        </a>

        <a href="{{ route('modules.show', 'life-of-muslim') }}"
            class="{{ Str::is('modules.*', $routeName) || Str::is('questions.*', $routeName) || Str::is('answers.*', $routeName) ? 'active' : '' }}">
            <i class="fas fa-search"></i>{{ __('app.topics') }}
        </a>

        <a href="javascript:void(0);" class="{{ Str::is('likes', $routeName) ? 'active' : '' }}">
            <i class="fas fa-book"></i>{{ __('app.books') }}
        </a>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    @stack('scripts')
</body>

</html>
