@extends('admin::app')

@section('content')
    <main class="error__wrapper">
        <div class="error__container">
            <div class="error__content -500">
                <div class="error__code">500</div>
                <h1 class="error__title">{!! __('theme::app.errors.error500Title') !!}</h1>
                <h2 class="error__subtitle">{!! __('theme::app.errors.error500Subtitle') !!}</h2>
            </div>
        </div>
    </main>
@endsection
