<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
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

    <header>
        HEADER
    </header>

    <div class="container">
        @yield('content')
    </div>

    <footer>
        FOOTER
    </footer>

    <script type="module" src="{{ $assetHelper::versioned('themes/' . $theme . '/js/app.js') }}"></script>
</body>
</html>
