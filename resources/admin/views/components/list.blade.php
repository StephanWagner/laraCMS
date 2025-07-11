<h1>{{ __('admin::contentTypes.list.title') }}</h1>

<script>
    window.listData = @json($listData ?? []);
</script>

<div class="list__wrapper" data-list="{{ $key }}"></div>
