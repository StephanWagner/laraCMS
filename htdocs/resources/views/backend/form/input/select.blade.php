<div
    class="input__wrapper{{ !empty($input['label']) ? ' -has-label' : '' }}"
    data-form-value
    data-form-value-name="{{ $input['name'] }}"
    data-form-value-type="select"
>

    @include('backend/form/input/partials/input-label')

    <div class="input__container select__container">
        <select
            class="select-field -block"
            data-select-field
            name="{{ $input['name'] }}"
            data-error-element
            data-error-trigger

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
