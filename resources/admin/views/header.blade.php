<header class="header__wrapper">
    <div class="header__container">
        <div class="header__content"></div>
        <div class="header__user-menu-container">
            <div class="header__user-menu-toggler{{ request()->routeIs('admin.users.profile') ? ' -active' : '' }}" data-toggle-menu="user">
                <div class="header__user-menu-icon icon">account_circle</div>
            </div>

            <div data-menu="user" class="header__user-menu menu-overlay__wrapper -user">
                <div class="menu-overlay__links">
                    <a href="{{ route('admin.users.profile') }}" class="menu-overlay__link{{ request()->routeIs('admin.users.profile') ? ' -active' : '' }}">
                        <div class="menu-overlay__icon icon">account_circle</div>
                        <div class="menu-overlay__link-text">
                            {{ __('admin::users.profile.navTitle') }}
                        </div>
                    </a>
                    <a href="{{ route('admin.logout') }}" class="menu-overlay__link">
                        <div class="menu-overlay__icon icon">logout</div>
                        <div class="menu-overlay__link-text">
                            {{ __('admin::auth.logout.navTitle') }}
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</header>
