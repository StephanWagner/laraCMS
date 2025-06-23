@extends('admin::app')

@section('content')

    <div class="auth__wrapper">

        <h1 class="auth__form-title">
            {{ __('auth.login.form.title') }}
        </h1>

        <form class="auth__form -signup" data-signup-form onsubmit="return false">

            <div class="form-message auth__form-message"></div>

            <input
                class="textfield -h"
                name="csrf"
                data-signin-form-input="csrf"
                type="text"
            >

            <div class="auth__textfields">

                <div class="textfield__container auth__textfield-container">
                    <input
                        class="textfield auth__textfield -block"
                        name="email"
                        data-submit-on-enter
                        data-clear-error-on-input
                        data-signin-form-input="email"
                        type="text"
                        placeholder="{{ __('auth.login.form.placeholderEmail') }}"
                        autocomplete="email"
                        spellcheck="false"
                    >
                </div>

                <div class="textfield__container auth__textfield-container">
                    <input
                        class="textfield auth__textfield -block"
                        name="password"
                        data-submit-on-enter
                        data-clear-error-on-input
                        data-signin-form-input="password"
                        type="password"
                        placeholder="{{ __('auth.login.form.placeholderPassword') }}"
                        maxlength="50"
                        autocomplete="password"
                    >
                </div>
            </div>

            <div class="button-container auth__button-container">
                <button
                    type="button"
                    class="button auth__button -block"
                    data-submit-button
                    data-signin-form-submit-button
                >
                    <span>{{ __('auth.login.form.submitButtonText') }}</span>
                    <em></em>
                    <u></u>
                </button>
            </div>
        </form>

        <div class="auth__form-links">
            <a class="auth__form-link" href="{{ route('admin.reset-password') }}">{{ __('auth.login.form.linkForgotPassword') }}</a>
        </div>

    </div>

@endsection
