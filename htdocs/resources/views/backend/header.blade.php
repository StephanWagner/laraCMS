<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>laraCMS</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <meta name="author" content="Stephan Wagner, mail@stephanwagner.me">
    <link rel="icon" type="image/png" href="/backend/img/favicon-admin.png">
    <link rel="apple-touch-icon" type="image/png" href="/backend/img/favicon-admin-app.png">
    <link rel="manifest" href="/backend/manifest-admin.json">
    <link rel="stylesheet" href="{{ assetSrc('/backend/css/main.min.css') }}">
    <script src="{{ assetSrc('/backend/js/main.min.js') }}"></script>
</head>

<body>

    <div class="page__wrapper">

        @if (Auth::check())

            <div class="page__container">
                <div class="panel__wrapper">
                    <div class="panel__header"></div>
                    <div class="panel__container">

						PANEL

                    </div>
                </div>
                <div class="content__wrapper">
                    <header class="header__wrapper">
                        <div class="header__container">
                            <div class="header__name">{{ Auth::user()->title }}</div>
                            <div class="header__menu-container">

                                <div class="header__menu-button noselect" onClick="toggleUserNav()">
                                    <div class="header__menu-icon header__menu-icon--menu">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" width="24px"
                                            viewBox="0 0 24 24">
                                            <path d="M3 18h18v-2H3v2zm0-5h18v-2H3v2zm0-7v2h18V6H3z" />
                                        </svg>
                                    </div>
                                    <div class="header__menu-icon header__menu-icon--close">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" width="24px"
                                            viewBox="0 0 24 24">
                                            <path
                                                d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12 19 6.41z" />
                                        </svg>
                                    </div>
                                </div>

                                <nav class="user-menu__wrapper">
                                    <ul>
                                        <li
                                            class="user-menu__item{{ request()->is('user') ? ' user-menu__item--active' : '' }}">
                                            <a class="user-menu__link" href="{{ url('/admin/users/edit/' . Auth::user()->id) }}">
                                                <div class="user-menu__label">Account</div>
                                                <div class="user-menu__icon icon-account">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"
                                                        viewBox="0 0 24 24">
                                                        <path
                                                            d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
                                                    </svg>
                                                </div>
                                            </a>
                                        </li>

                                        @if (Auth::user()->isAdmin())
                                            <li
                                                class="user-menu__item{{ request()->is('users') ? ' user-menu__item--active' : '' }}">
                                                <a class="user-menu__link" href="{{ url('/admin/users') }}">
                                                    <div class="user-menu__label">Benutzer</div>
                                                    <div class="user-menu__icon icon-users">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24px"
                                                            height="24px" viewBox="0 0 24 24">
                                                            <path
                                                                d="M10.67,13.02C10.45,13.01,10.23,13,10,13c-2.42,0-4.68,0.67-6.61,1.82C2.51,15.34,2,16.32,2,17.35V20h9.26 C10.47,18.87,10,17.49,10,16C10,14.93,10.25,13.93,10.67,13.02z" />
                                                            <circle cx="10" cy="8" r="4" />
                                                            <path
                                                                d="M20.75,16c0-0.22-0.03-0.42-0.06-0.63l1.14-1.01l-1-1.73l-1.45,0.49c-0.32-0.27-0.68-0.48-1.08-0.63L18,11h-2l-0.3,1.49 c-0.4,0.15-0.76,0.36-1.08,0.63l-1.45-0.49l-1,1.73l1.14,1.01c-0.03,0.21-0.06,0.41-0.06,0.63s0.03,0.42,0.06,0.63l-1.14,1.01 l1,1.73l1.45-0.49c0.32,0.27,0.68,0.48,1.08,0.63L16,21h2l0.3-1.49c0.4-0.15,0.76-0.36,1.08-0.63l1.45,0.49l1-1.73l-1.14-1.01 C20.72,16.42,20.75,16.22,20.75,16z M17,18c-1.1,0-2-0.9-2-2s0.9-2,2-2s2,0.9,2,2S18.1,18,17,18z" />
                                                        </svg>
                                                    </div>
                                                </a>
                                            </li>
                                        @endif

                                        <li class="user-menu__item">
                                            <a class="user-menu__link" href="{{ url('/admin/logout') }}">
                                                <div class="user-menu__label">Ausloggen</div>
                                                <div class="user-menu__icon icon-logout">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"
                                                        viewBox="0 0 24 24">
                                                        <polygon points="5,5 12,5 12,3 3,3 3,21 12,21 12,19 5,19" />
                                                        <polygon points="21,12 17,8 17,11 9,11 9,13 17,13 17,16" />
                                                    </svg>
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </header>

                    <div class="content__container">
        @endif
