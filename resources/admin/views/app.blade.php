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
@if (app()->environment('local'))
    @vite('admin/css/main')
@else
    <link rel="stylesheet" href="{{ $assetHelper::versioned('admin-assets/css/main.css') }}">
@endif
</head>

<body>

    <div class="admin__scaffold">

        @include('admin::panel')

        <div class="admin__container">

            @include('admin::header')

            <main class="admin__main">
                @yield('main')
            </main>

        </div>
    </div>

    <script type="module" src="{{ $assetHelper::versioned('admin-assets/js/app.js') }}"></script>
</body>
</html>
