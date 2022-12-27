@include('backend/header')

<main>

    <div class="login__wrapper">

        <div class="login__container">
            <form>
                <div class="login__error">&nbsp;</div>

                <div class="login__textfield login__textfield--email">
                    <input class="textfield login__email-input" type="text" name="email" placeholder="E-Mail Adresse"
                        autocomplete="email" data-submit-on-enter>
                </div>
                <div class="login__textfield login__textfield--password">
                    <input class="textfield login__password-input" type="password" name="password" placeholder="Passwort"
                        autocomplete="current-password" data-submit-on-enter>
                </div>

                <div class="login__button">
                    <button type="submit" class="button button--block login__submit-button">Einloggen</button>
                </div>
            </form>
        </div>
    </div>

</main>

@include('backend/footer')
