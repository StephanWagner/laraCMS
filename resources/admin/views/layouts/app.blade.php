<!DOCTYPE html>
<html lang="{{ explode('_', app()->getLocale())[0] }}">
<head>
    <title>{{ config('cms.name') }}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#528bff">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="robots" content="noindex, nofollow">
    <link rel="icon" type="image/png" href="/admin-assets/img/favicon.png">
    <link rel="apple-touch-icon" type="image/png" href="/admin-assets/img/apple-touch-icon.png">
    <link rel="manifest" href="/admin-assets/site.webmanifest">
    <link rel="stylesheet" href="{{ $assetHelper::versioned('admin-assets/css/main.css') }}">
</head>

<body class="admin">

    <header class="header__wrapper">
        <div class="container">
            <h1>{{ config('cms.name') }}</h1>
            <nav>
                <a href="{{ route('admin.dashboard') }}">Dashboard</a>

            </nav>
        </div>
    </header>

    <main class="admin-content">
        <div class="container">
            @yield('content')
        </div>
    </main>

    <script type="module" src="{{ $assetHelper::versioned('admin-assets/js/app.js') }}"></script>
</body>
</html>
