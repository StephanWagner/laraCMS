@extends('admin::app')

@section('content')
    <main class="error__wrapper">
        <div class="error__container">
            <div class="error__content -403">
                <div class="error__code -gradient-text">403</div>
                <h1 class="error__title">{!! __('admin::app.errors.error403Title') !!}</h1>
                <h2 class="error__subtitle">{!! __('admin::app.errors.error403Subtitle') !!}</h2>
            </div>
        </div>
    </main>
@endsection
