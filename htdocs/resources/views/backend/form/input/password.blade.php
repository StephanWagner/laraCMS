<div
    class="input__wrapper{{ !empty($input['label']) ? ' -has-label' : '' }}"
    data-form-value
    data-form-value-name="{{ $input['name'] }}"
    data-form-value-type="password"
>
    @if (!empty($input['label']))
        <div class="input__label">
            {{ $input['label'] }}
        </div>
    @endif

    <div
        class="input__container textfield__container -password -trigger-hover{{ !empty($input['showPasswordButton']) ? ' -has-icon' : '' }}"

        @if (!empty($input['showPasswordButton']))
            data-show-password-container
        @endif
    >
        <input
            class="textfield -block"
            type="password"
            name="{{ $input['name'] }}"
            placeholder="{{ $input['placeholder'] ?? '' }}"
            autocomplete="{{ $input['autocomplete'] ?? 'false' }}"
            data-error-element
            data-error-trigger

            @if (!empty($input['submitOnEnter']))
                data-submit-on-enter
            @endif

            @if (!empty($input['showPasswordButton']))
                data-show-password-input
            @endif
        >
        @if (!empty($input['showPasswordButton']))
            <div class="textfield__icon-container" data-show-password-trigger>
                <svg class="textfield__icon" xmlns="http://www.w3.org/2000/svg" height="24" width="24" viewBox="0 0 24 24">
                    <path class="view-password__icon-path -show" d="M12 15.575q1.7 0 2.887-1.188 1.188-1.187 1.188-2.887t-1.188-2.887Q13.7 7.425 12 7.425T9.113 8.613Q7.925 9.8 7.925 11.5t1.188 2.887Q10.3 15.575 12 15.575Zm0-1.375q-1.125 0-1.912-.788Q9.3 12.625 9.3 11.5t.788-1.913Q10.875 8.8 12 8.8t1.913.787q.787.788.787 1.913t-.787 1.912q-.788.788-1.913.788Zm0 4.3q-3.275 0-6.013-1.725Q3.25 15.05 1.8 12.1q-.05-.1-.075-.263-.025-.162-.025-.337 0-.175.025-.338Q1.75 11 1.8 10.9q1.45-2.95 4.187-4.675Q8.725 4.5 12 4.5t6.012 1.725Q20.75 7.95 22.2 10.9q.05.1.075.262.025.163.025.338 0 .175-.025.337-.025.163-.075.263-1.45 2.95-4.188 4.675Q15.275 18.5 12 18.5Zm0-7Zm0 5.5q2.825 0 5.188-1.488Q19.55 14.025 20.8 11.5q-1.25-2.525-3.612-4.013Q14.825 6 12 6 9.175 6 6.812 7.487 4.45 8.975 3.2 11.5q1.25 2.525 3.612 4.012Q9.175 17 12 17Z" />
                    <path class="view-password__icon-path -hide" d="M15.775 12.975 14.65 11.85q.225-1.25-.712-2.237Q13 8.625 11.65 8.85l-1.125-1.125q.35-.15.7-.225.35-.075.775-.075 1.7 0 2.887 1.188Q16.075 9.8 16.075 11.5q0 .425-.075.787-.075.363-.225.688Zm3.175 3.1-1.1-1.025q.95-.725 1.688-1.588.737-.862 1.262-1.962-1.25-2.525-3.588-4.013Q14.875 6 12 6q-.725 0-1.425.1-.7.1-1.375.3L8.025 5.225q.95-.375 1.938-.55Q10.95 4.5 12 4.5q3.325 0 6.062 1.762Q20.8 8.025 22.2 10.9q.05.1.075.262.025.163.025.338 0 .175-.025.337-.025.163-.075.263-.575 1.175-1.388 2.175-.812 1-1.862 1.8Zm.275 5.275-3.5-3.5q-.775.3-1.712.475-.938.175-2.013.175-3.35 0-6.075-1.762Q3.2 14.975 1.8 12.1q-.05-.1-.075-.263-.025-.162-.025-.337 0-.175.025-.325.025-.15.075-.275.575-1.15 1.375-2.125.8-.975 1.725-1.725L2.65 4.775q-.225-.225-.225-.525 0-.3.225-.55.225-.2.538-.2.312 0 .512.2l16.6 16.6q.2.2.213.5.012.3-.213.55-.225.2-.537.2-.313 0-.538-.2ZM5.95 8.1q-.8.625-1.537 1.513Q3.675 10.5 3.2 11.5q1.25 2.525 3.587 4.012Q9.125 17 12 17q.675 0 1.35-.113.675-.112 1.15-.237l-1.25-1.3q-.275.1-.6.162-.325.063-.65.063-1.7 0-2.887-1.188Q7.925 13.2 7.925 11.5q0-.3.063-.638.062-.337.162-.612Zm7.575 2.625Zm-3.3 1.65Z" />
                </svg>
            </div>
        @endif
    </div>
</div>
