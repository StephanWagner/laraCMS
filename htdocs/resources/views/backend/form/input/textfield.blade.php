<div
    class="input__wrapper{{ !empty($input['label']) ? ' -has-label' : '' }}"
    data-form-value
    data-form-value-name="{{ $input['name'] }}"
    data-form-value-type="textfield"
>
    @if (!empty($input['label']))
        <div class="input__label">
            {{ $input['label'] }}
        </div>
    @endif

    <div class="input__container textfield__container">
        <input
            class="textfield -block"
            type="{{ $input['inputType'] ?? 'text' }}"
            name="{{ $input['name'] }}"
            placeholder="{{ $input['placeholder'] ?? '' }}"
            autocomplete="{{ $input['autocomplete'] ?? 'false' }}"

            @if (!empty($input['submitOnEnter']))
                data-submit-on-enter
            @endif
        >
    </div>
</div>
