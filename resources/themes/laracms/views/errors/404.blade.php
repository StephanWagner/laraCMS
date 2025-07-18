@extends('theme::app')

@section('content')
    <main class="error__wrapper">
        <div class="error__container">
            <div class="error__content -404">
                <div class="error__code">404</div>
                <h1 class="error__title">{!! __('theme::app.errors.error404Title') !!}</h1>
                <h2 class="error__subtitle">{!! __('theme::app.errors.error404Subtitle') !!}</h2>
            </div>
        </div>
    </main>
@endsection
