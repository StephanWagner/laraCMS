@include('backend/header')

<div class="logged-out__wrapper">
    <div class="logged-out__container">

        <div class="logged-out__logo-container">
            <svg class="logged-out__logo" xmlns="http://www.w3.org/2000/svg" width="200px" height="35.884px" viewBox="0 0 200 35.884">
                <path fill="#222" d="M0,35.201V0h6.075v35.201H0z M37.98,11.137v24.064h-5.816v-4.144c-0.769,1.35-1.931,2.476-3.485,3.379c-1.554,0.902-3.32,1.354-5.298,1.354c-2.323,0-4.419-0.565-6.286-1.695c-1.868-1.13-3.313-2.652-4.333-4.568c-1.02-1.915-1.53-4.026-1.53-6.334c0-2.307,0.51-4.422,1.53-6.346c1.02-1.922,2.464-3.453,4.333-4.591c1.868-1.138,3.963-1.707,6.286-1.707c2.04,0,3.842,0.452,5.404,1.354c1.562,0.903,2.657,2.029,3.285,3.379v-4.144H37.98z M19.332,17.777c-1.35,1.476-2.025,3.281-2.025,5.416c0,2.135,0.671,3.932,2.013,5.392c1.342,1.46,3.08,2.19,5.215,2.19c2.088,0,3.838-0.699,5.251-2.096c1.413-1.397,2.119-3.226,2.119-5.486c0-2.26-0.71-4.097-2.131-5.51c-1.421-1.413-3.167-2.119-5.239-2.119C22.416,15.564,20.682,16.302,19.332,17.777z M59.148,16.788h-1.319c-2.402,0-4.191,0.652-5.368,1.954c-1.178,1.303-1.766,3.187-1.766,5.651v10.807H44.62V11.137h5.887v5.109c0.439-1.837,1.444-3.21,3.014-4.12c1.569-0.91,3.445-1.366,5.628-1.366V16.788z M88.109,11.137v24.064h-5.816v-4.144c-0.769,1.35-1.931,2.476-3.485,3.379c-1.554,0.902-3.32,1.354-5.298,1.354c-2.323,0-4.419-0.565-6.286-1.695c-1.868-1.13-3.313-2.652-4.333-4.568c-1.02-1.915-1.53-4.026-1.53-6.334c0-2.307,0.51-4.422,1.53-6.346c1.02-1.922,2.464-3.453,4.333-4.591c1.868-1.138,3.963-1.707,6.286-1.707c2.04,0,3.842,0.452,5.404,1.354c1.562,0.903,2.657,2.029,3.285,3.379v-4.144H88.109z M69.461,17.777c-1.35,1.476-2.025,3.281-2.025,5.416c0,2.135,0.671,3.932,2.013,5.392c1.342,1.46,3.08,2.19,5.215,2.19c2.088,0,3.838-0.699,5.251-2.096c1.413-1.397,2.119-3.226,2.119-5.486c0-2.26-0.71-4.097-2.131-5.51c-1.421-1.413-3.167-2.119-5.239-2.119C72.545,15.564,70.811,16.302,69.461,17.777z M111.538,0.777c2.747,0,5.282,0.534,7.605,1.601c2.323,1.068,4.234,2.464,5.734,4.191c1.498,1.727,2.601,3.681,3.307,5.863h-6.24c-0.926-1.931-2.268-3.442-4.026-4.533c-1.757-1.091-3.9-1.637-6.428-1.637c-3.547,0-6.381,1.142-8.5,3.426c-2.119,2.284-3.179,5.161-3.179,8.629c0,3.47,1.06,6.346,3.179,8.63c2.119,2.284,4.953,3.426,8.5,3.426c2.527,0,4.67-0.545,6.428-1.637c1.758-1.091,3.1-2.602,4.026-4.533h6.24c-0.518,1.617-1.279,3.128-2.284,4.533c-1.004,1.405-2.206,2.641-3.602,3.709c-1.398,1.068-3.022,1.907-4.874,2.519c-1.853,0.612-3.815,0.918-5.887,0.918c-2.653,0-5.109-0.459-7.37-1.378c-2.261-0.918-4.164-2.166-5.711-3.744c-1.546-1.577-2.751-3.441-3.614-5.592c-0.863-2.15-1.295-4.434-1.295-6.852c0-2.417,0.432-4.697,1.295-6.84s2.068-4.003,3.614-5.58c1.546-1.578,3.45-2.826,5.711-3.744C106.429,1.236,108.885,0.777,111.538,0.777z M151.942,35.672L139.981,15.14v20.061h-5.934V1.436h4.38l13.515,23.923l13.492-23.923h4.379v33.765h-5.91V15.14L151.942,35.672z M181.776,25.312c0.283,1.695,0.95,3.03,2.001,4.003c1.052,0.974,2.503,1.46,4.356,1.46c1.773,0,3.175-0.436,4.203-1.307c1.027-0.871,1.542-2.076,1.542-3.615c0-2.449-1.476-4.074-4.427-4.874l-4.356-1.201c-2.763-0.738-4.881-1.833-6.357-3.285c-1.476-1.452-2.213-3.41-2.213-5.875c0-2.009,0.498-3.767,1.495-5.274c0.997-1.507,2.335-2.645,4.014-3.414c1.68-0.769,3.571-1.154,5.674-1.154c3.171,0,5.75,0.946,7.735,2.837c1.986,1.892,3.042,4.274,3.168,7.147h-5.746c-0.125-1.444-0.636-2.618-1.53-3.52c-0.894-0.902-2.119-1.354-3.672-1.354c-1.555,0-2.771,0.377-3.65,1.13c-0.879,0.753-1.318,1.774-1.318,3.061c0,1.209,0.384,2.131,1.153,2.766c0.769,0.636,1.931,1.174,3.485,1.613l4.191,1.224c5.65,1.57,8.476,4.796,8.476,9.678c0,2.088-0.565,3.944-1.695,5.568c-1.13,1.625-2.605,2.857-4.427,3.697c-1.82,0.839-3.798,1.26-5.933,1.26c-3.501,0-6.303-0.954-8.407-2.861c-2.103-1.907-3.351-4.478-3.744-7.711H181.776z" />
            </svg>
        </div>

        <form data-install-form>

            <div class="logged-out__form">

                <div class="textfield__label">
                    {{ __('backend/page-install.textfield-language-label') }}
                </div>

                <div class="input__container select__container">
                    <select
                        class="select-field -block -select2"
                        data-select-field
                        data-select-language
                    >
                        @foreach ($languages as $language)
                            <option value="{{ $language['id'] }}"{!! app()->getLocale() == $language['id'] ? ' selected="selected"' : ''!!}>{{ $language['name'] }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="textfield__label">
                    {{ __('backend/page-install.textfield-site-title-label') }}
                </div>

                <div class="input__container textfield__container">
                    <input
                        class="textfield -block"
                        type="text"
                        name="site-title"
                        autocomplete="false"
                        data-submit-on-enter
                    >
                </div>

                <div class="textfield__label">
                    {{ __('backend/page-install.textfields-admin-user-label') }}
                </div>

                <div class="input__container textfield__container">
                    <input
                        class="textfield -block"
                        type="text"
                        name="email"
                        placeholder="E-Mail Adresse"
                        autocomplete="email"
                        data-submit-on-enter
                    >
                </div>

                <div class="input__container textfield__container -has-icon -password -trigger-hover" data-show-password-container>
                    <input
                        class="textfield -block"
                        type="password"
                        name="password"
                        placeholder="{{ __('backend/page-install.textfields-admin-user-password-placeholder') }}"
                        autocomplete="current-password"
                        data-submit-on-enter
                        data-show-password-input
                    >
                    <div class="textfield__icon-container " data-show-password-trigger>
                        <svg class="textfield__icon" xmlns="http://www.w3.org/2000/svg" height="24" width="24" viewBox="0 0 24 24">
                            <path class="view-password__icon-path -show" d="M12 15.575q1.7 0 2.887-1.188 1.188-1.187 1.188-2.887t-1.188-2.887Q13.7 7.425 12 7.425T9.113 8.613Q7.925 9.8 7.925 11.5t1.188 2.887Q10.3 15.575 12 15.575Zm0-1.375q-1.125 0-1.912-.788Q9.3 12.625 9.3 11.5t.788-1.913Q10.875 8.8 12 8.8t1.913.787q.787.788.787 1.913t-.787 1.912q-.788.788-1.913.788Zm0 4.3q-3.275 0-6.013-1.725Q3.25 15.05 1.8 12.1q-.05-.1-.075-.263-.025-.162-.025-.337 0-.175.025-.338Q1.75 11 1.8 10.9q1.45-2.95 4.187-4.675Q8.725 4.5 12 4.5t6.012 1.725Q20.75 7.95 22.2 10.9q.05.1.075.262.025.163.025.338 0 .175-.025.337-.025.163-.075.263-1.45 2.95-4.188 4.675Q15.275 18.5 12 18.5Zm0-7Zm0 5.5q2.825 0 5.188-1.488Q19.55 14.025 20.8 11.5q-1.25-2.525-3.612-4.013Q14.825 6 12 6 9.175 6 6.812 7.487 4.45 8.975 3.2 11.5q1.25 2.525 3.612 4.012Q9.175 17 12 17Z" />
                            <path class="view-password__icon-path -hide" d="M15.775 12.975 14.65 11.85q.225-1.25-.712-2.237Q13 8.625 11.65 8.85l-1.125-1.125q.35-.15.7-.225.35-.075.775-.075 1.7 0 2.887 1.188Q16.075 9.8 16.075 11.5q0 .425-.075.787-.075.363-.225.688Zm3.175 3.1-1.1-1.025q.95-.725 1.688-1.588.737-.862 1.262-1.962-1.25-2.525-3.588-4.013Q14.875 6 12 6q-.725 0-1.425.1-.7.1-1.375.3L8.025 5.225q.95-.375 1.938-.55Q10.95 4.5 12 4.5q3.325 0 6.062 1.762Q20.8 8.025 22.2 10.9q.05.1.075.262.025.163.025.338 0 .175-.025.337-.025.163-.075.263-.575 1.175-1.388 2.175-.812 1-1.862 1.8Zm.275 5.275-3.5-3.5q-.775.3-1.712.475-.938.175-2.013.175-3.35 0-6.075-1.762Q3.2 14.975 1.8 12.1q-.05-.1-.075-.263-.025-.162-.025-.337 0-.175.025-.325.025-.15.075-.275.575-1.15 1.375-2.125.8-.975 1.725-1.725L2.65 4.775q-.225-.225-.225-.525 0-.3.225-.55.225-.2.538-.2.312 0 .512.2l16.6 16.6q.2.2.213.5.012.3-.213.55-.225.2-.537.2-.313 0-.538-.2ZM5.95 8.1q-.8.625-1.537 1.513Q3.675 10.5 3.2 11.5q1.25 2.525 3.587 4.012Q9.125 17 12 17q.675 0 1.35-.113.675-.112 1.15-.237l-1.25-1.3q-.275.1-.6.162-.325.063-.65.063-1.7 0-2.887-1.188Q7.925 13.2 7.925 11.5q0-.3.063-.638.062-.337.162-.612Zm7.575 2.625Zm-3.3 1.65Z" />
                        </svg>
                    </div>
                </div>

                <div class="button__container">
                    <button type="submit" class="install_submit-button button -block">
                        {{ __('backend/page-install.submit-button-text') }}
                    </button>
                </div>

            </div>

        </form>

    </div>
</div>

@include('backend/footer')
