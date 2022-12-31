@if (!empty($input['label']))
    <div class="input__label-container">
        <div class="input__label-text">
            {{ $input['label'] }}
        </div>

        @if (!empty($input['description']))
            <div class="input__description" data-input-description-trigger="{{ $input['name'] }}">
                <svg class="input__description-icon" xmlns="http://www.w3.org/2000/svg" height="20" width="20" viewbox="0 0 20 20">
                    <path d="M10 14.167q.354 0 .615-.261.26-.26.26-.614v-3.271q0-.354-.26-.604-.261-.25-.615-.25t-.615.26q-.26.261-.26.615v3.27q0 .355.26.605.261.25.615.25Zm0-6.688q.354 0 .615-.26.26-.261.26-.615t-.26-.614q-.261-.261-.615-.261t-.615.261q-.26.26-.26.614t.26.615q.261.26.615.26Zm0 10.854q-1.729 0-3.25-.656t-2.646-1.781q-1.125-1.125-1.781-2.646-.656-1.521-.656-3.25t.656-3.25q.656-1.521 1.781-2.646T6.75 2.323q1.521-.656 3.25-.656t3.25.656q1.521.656 2.646 1.781t1.781 2.646q.656 1.521.656 3.25t-.656 3.25q-.656 1.521-1.781 2.646t-2.646 1.781q-1.521.656-3.25.656ZM10 10Zm0 6.583q2.729 0 4.656-1.927 1.927-1.927 1.927-4.656 0-2.729-1.927-4.656Q12.729 3.417 10 3.417q-2.729 0-4.656 1.927Q3.417 7.271 3.417 10q0 2.729 1.927 4.656Q7.271 16.583 10 16.583Z"/>
                </svg>
            </div>
            <div class="input__description-content" data-input-description-content="{{ $input['name'] }}">
                {!! $input['description'] !!}
            </div>
        @endif
    </div>
@endif

