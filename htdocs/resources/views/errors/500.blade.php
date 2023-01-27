@if (substr(request()->path(), 0, 5) == 'admin')
    @include('backend/header')
    @include('backend/errors/500')
    @include('backend/footer')
@else
    @include('frontend/header')
    @include('frontend/errors/500')
    @include('frontend/footer')
@endif
