</div>
</div>
</div>
</div>

@if (!empty($i18n))
<script>
    var i18n = {!! json_encode($i18n) !!};
</script>
@endif

<input type="hidden" id="csrf-token" value="{{ csrf_token() }}">

</body>

</html>
