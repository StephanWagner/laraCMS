@if (request()->is('admin/*'))
    @includeIf('admin::errors.403')
@else
    @includeIf('theme::errors.403')
@endif
