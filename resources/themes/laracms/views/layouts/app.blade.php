<!DOCTYPE html>
<html lang="{{ explode('_', app()->getLocale())[0] }}">
<head>
    <title>{{ config('app.name') }}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#528bff">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="/themes/{{ $theme }}/img/favicon.png">
    <link rel="apple-touch-icon" type="image/png" href="/themes/{{ $theme }}/img/apple-touch-icon.png">
    <link rel="manifest" href="/themes/{{ $theme }}/site.webmanifest">
    <link rel="stylesheet" href="{{ $assetHelper::versioned('themes/' . $theme . '/css/main.css') }}">
</head>

<body>

    <header class="site-header">
        <div class="container">
            <h1>{{ config('app.name') }}</h1>
            <nav>
                @includeIf("theme::partials.nav")
            </nav>
        </div>
    </header>

    <main class="site-content">
        <div class="container">
            @yield('content')
        </div>
    </main>

    <footer class="site-footer">
        @includeIf("theme::partials.footer")
    </footer>

    <script type="module" src="{{ $assetHelper::versioned('themes/' . $theme . '/js/app.js') }}"></script>
</body>
</html>
