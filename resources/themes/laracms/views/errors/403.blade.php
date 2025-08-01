@extends('theme::app')

@section('content')
    <main class="error-page__wrapper">
        <div class="error-page__container">
            <div class="error-page__content -403">
                <div class="error-page__code">403</div>
                <h1 class="error-page__title">{!! __('theme::app.errors.error403Title') !!}</h1>
                <h2 class="error-page__subtitle">{!! __('theme::app.errors.error403Subtitle') !!}</h2>
            </div>
        </div>
    </main>
@endsection
