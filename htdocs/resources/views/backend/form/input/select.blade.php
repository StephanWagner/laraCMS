<div
    class="input__wrapper{{ !empty($input['label']) ? ' -has-label' : '' }}"
    data-form-value
    data-form-value-name="{{ $input['name'] }}"
    data-form-value-type="select"
>
    @if (!empty($input['label']))
        <div class="input__label">
            {{ $input['label'] }}
        </div>
    @endif

    <div class="input__container select__container">
        <select
            class="select-field -block"
            data-select-field
            name="{{ $input['name'] }}"

            @if (!empty($input['html']))
                data-html
            @endif
        >
            @foreach ($input['options'] as $option)
                <option value="{{ $option['value'] }}"{!! $option['selected'] ? ' selected="selected"' : ''!!}>{{ $option['text'] }}</option>
            @endforeach
        </select>
    </div>
</div>
