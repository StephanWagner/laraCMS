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
                <div class="panel__wrapper">
                    <div class="panel__container">

                        <div class="panel__label">
                            <?= __('backend/panel.label-content') ?>
                        </div>

                        <div class="panel__link-container">
                            <a href="/" class="panel__link">
                                <div class="panel__link-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" width="24px" viewBox="0 0 24 24">
                                        <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12 19 6.41z" />
                                    </svg>
                                </div>
                                <div class="panel__link-text">
                                    <?= __('backend/panel.link-pages') ?>
                                </div>
                            </a>
                        </div>

                        <div class="panel__link-container">
                            <a href="/" class="panel__link">
                                <div class="panel__link-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" width="24px" viewBox="0 0 24 24">
                                        <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12 19 6.41z" />
                                    </svg>
                                </div>
                                <div class="panel__link-text">
                                    <?= __('backend/panel.link-media') ?>
                                </div>
                            </a>
                        </div>

                        @if (Auth::user()->role == 'admin')
                            <div class="panel__label">
                                <?= __('backend/panel.label-admin') ?>
                            </div>

                            <div class="panel__link-container">
                                <a href="/" class="panel__link">
                                    <div class="panel__link-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" width="24px" viewBox="0 0 24 24">
                                            <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12 19 6.41z" />
                                        </svg>
                                    </div>
                                    <div class="panel__link-text">
                                        <?= __('backend/panel.link-settings') ?>
                                    </div>
                                </a>
                            </div>

                            <div class="panel__link-container">
                                <a href="/" class="panel__link">
                                    <div class="panel__link-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" width="24px" viewBox="0 0 24 24">
                                            <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12 19 6.41z" />
                                        </svg>
                                    </div>
                                    <div class="panel__link-text">
                                        <?= __('backend/panel.link-users') ?>
                                    </div>
                                </a>
                            </div>

                            <div class="panel__link-container">
                                <a href="/" class="panel__link">
                                    <div class="panel__link-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" width="24px" viewBox="0 0 24 24">
                                            <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12 19 6.41z" />
                                        </svg>
                                    </div>
                                    <div class="panel__link-text">
                                        <?= __('backend/panel.link-menus') ?>
                                    </div>
                                </a>
                            </div>

                            <div class="panel__label">
                                <?= __('backend/panel.label-developer') ?>
                            </div>

                            <div class="panel__link-container">
                                <a href="/" class="panel__link">
                                    <div class="panel__link-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" width="24px" viewBox="0 0 24 24">
                                            <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12 19 6.41z" />
                                        </svg>
                                    </div>
                                    <div class="panel__link-text">
                                        <?= __('backend/panel.link-variables') ?>
                                    </div>
                                </a>
                            </div>

                            <div class="panel__link-container">
                                <a href="/" class="panel__link">
                                    <div class="panel__link-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" width="24px" viewBox="0 0 24 24">
                                            <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12 19 6.41z" />
                                        </svg>
                                    </div>
                                    <div class="panel__link-text">
                                        <?= __('backend/panel.link-post-types') ?>
                                    </div>
                                </a>
                            </div>

                            <div class="panel__link-container">
                                <a href="/" class="panel__link">
                                    <div class="panel__link-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" width="24px" viewBox="0 0 24 24">
                                            <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12 19 6.41z" />
                                        </svg>
                                    </div>
                                    <div class="panel__link-text">
                                        <?= __('backend/panel.link-blocks') ?>
                                    </div>
                                </a>
                            </div>
                        @endif

                    </div>
                </div>
                <div class="content__wrapper">

                    <div class="content__container">
        @endif
