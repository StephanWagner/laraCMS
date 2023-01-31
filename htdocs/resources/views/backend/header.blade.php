<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>laraCMS</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <meta name="author" content="Stephan Wagner, mail@stephanwagner.me">
    <link rel="icon" type="image/png" href="/backend/img/favicon.png">
    <link rel="apple-touch-icon" type="image/png" href="/backend/img/favicon-app.png">
    <link rel="manifest" href="/backend/manifest.json">
    <link rel="stylesheet" href="{{ assetSrc('/backend/css/main.min.css') }}">
    <script src="{{ assetSrc('/backend/js/main.min.js') }}"></script>
</head>

<body>

    <div class="scaffold__wrapper">

        @if (Auth::check())
            <header class="header__wrapper">
                <div class="header__container">
                    <div class="header__profile-name">
                        <a class="header__profile-link" href="{{ url('/admin/users/edit/' . Auth::user()->id) }}">
                            {{ Auth::user()->name }}
                        </a>
                    </div>
                    <a class="header__logout-button" href="{{ url('/admin/logout') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24">
                            <polygon points="5,5 12,5 12,3 3,3 3,21 12,21 12,19 5,19" />
                            <polygon points="21,12 17,8 17,11 9,11 9,13 17,13 17,16" />
                        </svg>
                    </a>
                </div>
            </header>
            <div class="scaffold__container">

                @include('backend/panel')

                <div class="content__wrapper">

                    <div class="content__container">
        @endif
