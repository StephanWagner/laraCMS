<div
	class="input__wrapper"
	data-form-input="{{ $name }}"
	data-input-type="select"
	{{ !empty($required) ? 'data-required' : '' }}
	{{ !empty($value) || !empty($forceSelection) ? 'data-has-value' : '' }}
>

    @if ($label)
        <div class="input__label">{{ $label }}</div>
    @endif

    <div class="input__container input__container--required">

		<select data-form-value data-check-unload-event{{ !empty($multiple) ? ' multiple' : '' }}>
			{!! empty($required) ? '<option></option>' : '' !!}
			@foreach ($options as $optionValue => $optionLabel)
				<option value="{{ $optionValue }}"{{
				(empty($multiple) && !empty($value) && $optionValue == $value) ||
				(empty($multiple) && empty($value) && !empty($defaultSelection) && $optionValue == $defaultSelection) ||
				(!empty($multiple) && !empty($value) && in_array($optionValue, $value)) ||
				(!empty($multiple) && empty($value) && !empty($defaultSelection) && in_array($optionValue, $defaultSelection)) ? ' selected="selected"' : ''
				}}>{{ $optionLabel }}</option>
			@endforeach
		</select>

    </div>

	<div class="input__error"></div>

    @if (!empty($description))
        @include('backend/partials/input/input-description', [
			'description' => $description
		])
    @endif

	<script>
		$('.input__wrapper[data-form-input="{{ $name }}"] select').select2({
			placeholder: '{!! !empty($placeholder) ? $placeholder : '' !!}',
			allowClear: {{ !empty($multiple) || !empty($required) ? 'false' : 'true' }},
			minimumResultsForSearch: {{ !empty($search) || !empty($multiple) ? 7 : -1 }},
			width: '100%',
			closeOnSelect: {{ !empty($multiple) ? 'false' : 'true' }},
			multiple: {{ !empty($multiple) ? 'true' : 'false' }}
		});
	</script>
</div>
