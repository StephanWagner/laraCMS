@extends('admin::app')

@section('content')
    <div class="content__content">

        @include('admin::components.list', [
            'key' => 'users',
        ])
    </div>
@endsection
