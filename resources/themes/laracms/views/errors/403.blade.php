@extends('theme::app')

@section('content')
    <main class="error__wrapper">
        <div class="error__container">
            <div class="error__content -403">
                <div class="error__code">403</div>
                <h1 class="error__title">{!! __('theme::app.errors.error403Title') !!}</h1>
                <h2 class="error__subtitle">{!! __('theme::app.errors.error403Subtitle') !!}</h2>
            </div>
        </div>
    </main>
@endsection
