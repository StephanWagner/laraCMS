@extends('admin::app')

@section('content')
    <div class="content__content">
        <h1>{{ __('admin::users.list.title') }}</h1>

        @include('admin::components.list', [
            'key' => 'users',
            'listData' => $listData ?? null,
        ])
    </div>
@endsection
