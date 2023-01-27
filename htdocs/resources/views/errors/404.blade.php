@if (substr(request()->path(), 0, 5) == 'admin')
    @include('backend/header')
    @include('backend/errors/404')
    @include('backend/footer')
@else
    @include('frontend/header')
    @include('frontend/errors/404')
    @include('frontend/footer')
@endif
