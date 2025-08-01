@extends('theme::app')

@section('content')
    <main class="error-page__wrapper">
        <div class="error-page__container">
            <div class="error-page__content -404">
                <div class="error-page__code">404</div>
                <h1 class="error-page__title">{!! __('theme::app.errors.error404Title') !!}</h1>
                <h2 class="error-page__subtitle">{!! __('theme::app.errors.error404Subtitle') !!}</h2>
            </div>
        </div>
    </main>
@endsection
