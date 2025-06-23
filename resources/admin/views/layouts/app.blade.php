<!DOCTYPE html>
<html lang="{{ explode('_', app()->getLocale())[0] }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('cms.name') }}</title>

    <link rel="stylesheet" href="{{ $assetHelper::versioned('admin-assets/css/main.css') }}">
    <script type="module" src="{{ $assetHelper::versioned('admin-assets/js/app.js') }}"></script>
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

</body>
</html>
