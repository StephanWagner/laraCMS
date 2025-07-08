@if (request()->is('admin/*'))
    @includeIf('admin::errors.500')
@else
    @includeIf('theme::errors.500')
@endif
