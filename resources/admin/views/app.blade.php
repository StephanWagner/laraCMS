<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <title>{!! !empty($pageTitle) ? $pageTitle . ' · ' : '' !!}{!! config('cms.name') !!}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#528bff">
    <meta name="color-scheme" content="dark">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="robots" content="noindex, nofollow">
    <link rel="icon" type="image/png" href="/admin-assets/img/favicon.png">
    <link rel="apple-touch-icon" type="image/png" href="/admin-assets/img/apple-touch-icon.png">
    <link rel="manifest" href="/admin-assets/site.webmanifest">
    <link rel="stylesheet" href="{{ $assetHelper::versioned('admin-assets/css/main.css') }}">
    <script>window.app = @json(['locale' => app()->getLocale()])</script>
</head>

<body class="{{ Auth::check() ? '-logged-in' : ''}}">

    <div class="admin__scaffold">

        @if (Auth::check())
            @include('admin::panel')
        @endif

        <div class="content__wrapper">

            @if (Auth::check())
                @include('admin::header')
            @endif

            <main class="content__container">
                @yield('content')
            </main>

        </div>
    </div>

    <script type="module" src="{{ $assetHelper::versioned('admin-assets/js/app.js') }}"></script>
</body>
</html>
