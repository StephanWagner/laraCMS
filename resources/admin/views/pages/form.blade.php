@extends('admin::app')

@section('content')
    <div class="content__content">
        <h1>{{ __('admin::users.form.title' . (!empty($formData['item']) ? 'Edit' : 'New')) }}</h1>

        @include('admin::components.form', [
            'key' => 'users',
            'formData' => $formData ?? null,
        ])
    </div>
@endsection
