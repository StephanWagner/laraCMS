@include('backend/header')

<div class="login__wrapper">

    <div class="login__container">
        <form>

            <div class="login__logo-container">
                <svg class="login__logo" xmlns="http://www.w3.org/2000/svg" width="200px" height="35.884px" viewBox="0 0 200 35.884">
                    <path fill="#222" d="M0,35.201V0h6.075v35.201H0z M37.98,11.137v24.064h-5.816v-4.144c-0.769,1.35-1.931,2.476-3.485,3.379c-1.554,0.902-3.32,1.354-5.298,1.354c-2.323,0-4.419-0.565-6.286-1.695c-1.868-1.13-3.313-2.652-4.333-4.568c-1.02-1.915-1.53-4.026-1.53-6.334c0-2.307,0.51-4.422,1.53-6.346c1.02-1.922,2.464-3.453,4.333-4.591c1.868-1.138,3.963-1.707,6.286-1.707c2.04,0,3.842,0.452,5.404,1.354c1.562,0.903,2.657,2.029,3.285,3.379v-4.144H37.98z M19.332,17.777c-1.35,1.476-2.025,3.281-2.025,5.416c0,2.135,0.671,3.932,2.013,5.392c1.342,1.46,3.08,2.19,5.215,2.19c2.088,0,3.838-0.699,5.251-2.096c1.413-1.397,2.119-3.226,2.119-5.486c0-2.26-0.71-4.097-2.131-5.51c-1.421-1.413-3.167-2.119-5.239-2.119C22.416,15.564,20.682,16.302,19.332,17.777z M59.148,16.788h-1.319c-2.402,0-4.191,0.652-5.368,1.954c-1.178,1.303-1.766,3.187-1.766,5.651v10.807H44.62V11.137h5.887v5.109c0.439-1.837,1.444-3.21,3.014-4.12c1.569-0.91,3.445-1.366,5.628-1.366V16.788z M88.109,11.137v24.064h-5.816v-4.144c-0.769,1.35-1.931,2.476-3.485,3.379c-1.554,0.902-3.32,1.354-5.298,1.354c-2.323,0-4.419-0.565-6.286-1.695c-1.868-1.13-3.313-2.652-4.333-4.568c-1.02-1.915-1.53-4.026-1.53-6.334c0-2.307,0.51-4.422,1.53-6.346c1.02-1.922,2.464-3.453,4.333-4.591c1.868-1.138,3.963-1.707,6.286-1.707c2.04,0,3.842,0.452,5.404,1.354c1.562,0.903,2.657,2.029,3.285,3.379v-4.144H88.109z M69.461,17.777c-1.35,1.476-2.025,3.281-2.025,5.416c0,2.135,0.671,3.932,2.013,5.392c1.342,1.46,3.08,2.19,5.215,2.19c2.088,0,3.838-0.699,5.251-2.096c1.413-1.397,2.119-3.226,2.119-5.486c0-2.26-0.71-4.097-2.131-5.51c-1.421-1.413-3.167-2.119-5.239-2.119C72.545,15.564,70.811,16.302,69.461,17.777z M111.538,0.777c2.747,0,5.282,0.534,7.605,1.601c2.323,1.068,4.234,2.464,5.734,4.191c1.498,1.727,2.601,3.681,3.307,5.863h-6.24c-0.926-1.931-2.268-3.442-4.026-4.533c-1.757-1.091-3.9-1.637-6.428-1.637c-3.547,0-6.381,1.142-8.5,3.426c-2.119,2.284-3.179,5.161-3.179,8.629c0,3.47,1.06,6.346,3.179,8.63c2.119,2.284,4.953,3.426,8.5,3.426c2.527,0,4.67-0.545,6.428-1.637c1.758-1.091,3.1-2.602,4.026-4.533h6.24c-0.518,1.617-1.279,3.128-2.284,4.533c-1.004,1.405-2.206,2.641-3.602,3.709c-1.398,1.068-3.022,1.907-4.874,2.519c-1.853,0.612-3.815,0.918-5.887,0.918c-2.653,0-5.109-0.459-7.37-1.378c-2.261-0.918-4.164-2.166-5.711-3.744c-1.546-1.577-2.751-3.441-3.614-5.592c-0.863-2.15-1.295-4.434-1.295-6.852c0-2.417,0.432-4.697,1.295-6.84s2.068-4.003,3.614-5.58c1.546-1.578,3.45-2.826,5.711-3.744C106.429,1.236,108.885,0.777,111.538,0.777z M151.942,35.672L139.981,15.14v20.061h-5.934V1.436h4.38l13.515,23.923l13.492-23.923h4.379v33.765h-5.91V15.14L151.942,35.672z M181.776,25.312c0.283,1.695,0.95,3.03,2.001,4.003c1.052,0.974,2.503,1.46,4.356,1.46c1.773,0,3.175-0.436,4.203-1.307c1.027-0.871,1.542-2.076,1.542-3.615c0-2.449-1.476-4.074-4.427-4.874l-4.356-1.201c-2.763-0.738-4.881-1.833-6.357-3.285c-1.476-1.452-2.213-3.41-2.213-5.875c0-2.009,0.498-3.767,1.495-5.274c0.997-1.507,2.335-2.645,4.014-3.414c1.68-0.769,3.571-1.154,5.674-1.154c3.171,0,5.75,0.946,7.735,2.837c1.986,1.892,3.042,4.274,3.168,7.147h-5.746c-0.125-1.444-0.636-2.618-1.53-3.52c-0.894-0.902-2.119-1.354-3.672-1.354c-1.555,0-2.771,0.377-3.65,1.13c-0.879,0.753-1.318,1.774-1.318,3.061c0,1.209,0.384,2.131,1.153,2.766c0.769,0.636,1.931,1.174,3.485,1.613l4.191,1.224c5.65,1.57,8.476,4.796,8.476,9.678c0,2.088-0.565,3.944-1.695,5.568c-1.13,1.625-2.605,2.857-4.427,3.697c-1.82,0.839-3.798,1.26-5.933,1.26c-3.501,0-6.303-0.954-8.407-2.861c-2.103-1.907-3.351-4.478-3.744-7.711H181.776z" />
                </svg>
            </div>

            <div>
                Language
            </div>

            <div class="login__textfield -email">
                TODO
            </div>

            <div>
                Site title
            </div>

            <div class="login__textfield -email">
                <input class="textfield -block login__textfield -email" type="text" name="site-title"
                    autocomplete="false" data-submit-on-enter>
            </div>

            <div>
                Admin user
            </div>

            <div class="login__textfield -password">
                <input class="textfield -block login__textfield -password" type="text" name="email"
                    placeholder="E-Mail Adresse" autocomplete="current-password" data-submit-on-enter>
            </div>

            <div class="login__textfield -password">
                <input class="textfield -block login__textfield -password" type="password" name="password"
                    placeholder="Passwort" autocomplete="current-password" data-submit-on-enter>
            </div>

            <div class="login__button-container">
                <button type="submit" class="button -block login__button">laraCMS installieren</button>
            </div>

        </form>
    </div>
</div>

@include('backend/footer')
