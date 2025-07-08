@if (request()->is('admin/*'))
    @includeIf('admin::errors.404')
@else
    @includeIf('theme::errors.404')
@endif
