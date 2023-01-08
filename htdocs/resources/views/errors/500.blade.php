@if (substr(request()->path(), 0, 5) == 'admin')
    @include('backend/header')
@else
    @include('frontend/header', [
        // TODO 'contentTitle' => 'Seite nicht gefunden'
    ])
@endif

<div class="page-error__wrapper -500">
    <div class="page-error__title">Server Fehler</div>
    <div class="page-error__description">Es ist ein interner Server Fehler aufgetreten</div>
    <div class="page-error__try-again-link" onclick="window.location.reload()">Nochmal versuchen</div>
</div>

@if (substr(request()->path(), 0, 5) == 'admin')
    @include('backend/footer')
@else
    @include('frontend/footer')
@endif
