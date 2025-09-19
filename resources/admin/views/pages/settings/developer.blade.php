@extends('admin::app')

@section('content')

<div class="content__content">

    <div class="tab-navigation__wrapper" data-tabs>
        <div class="tab-navigation__container">
            <div class="tab-navigation__item -active" data-tab="system">{{ __('admin::settings.developer.system.title') }}</div>
            <div class="tab-navigation__item" data-tab="media">{{ __('admin::settings.developer.media.title') }}</div>
            <div class="tab-navigation__item" data-tab="mail">{{ __('admin::settings.developer.mail.title') }}</div>
            <div class="tab-navigation__item" data-tab="localization">{{ __('admin::settings.developer.localization.title') }}</div>
        </div>

        @include('admin::pages.settings.developer-system')

        @include('admin::pages.settings.developer-media')

        <div class="tab-content__container" data-tab-content="mail">
            Mail
        </div>

        <div class="tab-content__container" data-tab-content="localization">
            Localization
        </div>
    </div>

</div>

@endsection