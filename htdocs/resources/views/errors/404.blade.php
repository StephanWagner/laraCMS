@if (substr(request()->path(), 0, 5) == 'admin')
	@include('backend/header')
@else
	@include('frontend/header', [
		// TODO 'contentTitle' => 'Seite nicht gefunden'
	])
@endif

<div class="page-error__wrapper -404">
	<div class="page-error__title">Seite nicht gefunden</div>
	<div class="page-error__description">Diese Seite scheint es nicht zu geben oder sie wurde gelöscht</div>
</div>

@if (substr(request()->path(), 0, 5) == 'admin')
	@include('backend/footer')
@else
	@include('frontend/footer')
@endif
