<!DOCTYPE html>
<html lang="{{ explode('_', app()->getLocale())[0] }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <link rel="stylesheet" href="{{ $assetHelper::versioned('css/main.css') }}">
    <script type="module" src="{{ $assetHelper::versioned('js/app.js') }}"></script>
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

</body>
</html>
