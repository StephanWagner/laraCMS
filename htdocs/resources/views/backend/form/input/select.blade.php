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

            @if (!empty($input['multiple']))
                multiple
            @endif

            @if (!empty($input['rows']))
                data-rows={{ $input['rows'] }}
            @endif

            @if (!empty($input['search']))
                data-search
                data-minimun-options-for-search="{{ $input['minimumOptionsForSearch'] ?? 10 }}"
                data-select-field-search-placeholder="{{ $input['searchPlaceholder'] ?? __('backend/form.select-html-search-placeholder') }}"
            @endif
        >
            @foreach ($input['options'] as $option)
                <option value="{{ $option['value'] }}"{!! $option['selected'] ? ' selected="selected"' : '' !!}>{{ $option['text'] }}</option>
            @endforeach
        </select>
    </div>
</div>
