<div
    class="input__wrapper{{ !empty($input['label']) ? ' -has-label' : '' }}"
    data-form-value
    data-form-value-name="{{ $input['name'] }}"
    data-form-value-type="textfield"
>

    @include('backend/form/input/partials/input-label')

    <div class="input__container textfield__container">
        <input
            class="textfield -block"
            type="{{ $input['inputType'] ?? 'text' }}"
            name="{{ $input['name'] }}"
            placeholder="{{ $input['placeholder'] ?? '' }}"
            autocomplete="{{ $input['autocomplete'] ?? 'false' }}"

            @if (isset($input['spellcheck']))
                spellcheck="{{ !empty($input['spellcheck']) ? 'true' : 'false' }}"
            @endif

            @if (!empty($input['maxlength']))
                maxlength="{{ $input['maxlength'] }}"
            @endif

            data-error-element
            data-error-trigger

            @if (!empty($input['submitOnEnter']))
                data-submit-on-enter
            @endif
        >
    </div>
</div>
