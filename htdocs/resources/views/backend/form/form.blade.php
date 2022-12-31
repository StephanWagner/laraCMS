<form
    data-form="{{ $form['name'] }}"

    @if (!empty($form['requestUrl']))
        data-request-url="{{ $form['requestUrl'] }}"
    @endif

    @if (!empty($form['keepDisabledOnSuccess']))
        data-keep-disabled-on-success
    @endif
>

    <div class="form__wrapper">
        <div class="form__container">

            @foreach ($form['inputs'] as $input)
                @include('backend/form/input/' . $input['type'])
            @endforeach

            <div class="form__submit-button-container">
                <button
                    type="submit"
                    class="form__submit-button button -block"
                    data-form-submit-button="{{ $form['name'] }}"
                >
                    {{ $form['submitButtonText'] ?? __('backend/app.default-submit-button-text') }}
                </button>
            </div>

        </div>
    </div>

</form>
