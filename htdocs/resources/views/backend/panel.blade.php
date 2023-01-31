<div class="panel__wrapper">
    <div class="panel__container">

        <div class="panel__label">
            <?= __('backend/panel.label-cms') ?>
        </div>

        <div class="panel__link-container">
            <a href="/admin" class="panel__link{{ 'BackendDashboardController' == 'XXX' ? ' -active' : '' }}">
                <div class="panel__link-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" width="24px" viewBox="0 0 24 24">
                        <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12 19 6.41z" />
                    </svg>
                </div>
                <div class="panel__link-text">
                    <?= __('backend/panel.link-dashboard') ?>
                </div>
            </a>
        </div>

        <div class="panel__label">
            <?= __('backend/panel.label-content') ?>
        </div>

        <div class="panel__link-container">
            <a href="/" class="panel__link">
                <div class="panel__link-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" width="24px" viewBox="0 0 24 24">
                        <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12 19 6.41z" />
                    </svg>
                </div>
                <div class="panel__link-text">
                    <?= __('backend/panel.link-pages') ?>
                </div>
            </a>
        </div>

        <div class="panel__link-container">
            <a href="/" class="panel__link">
                <div class="panel__link-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" width="24px" viewBox="0 0 24 24">
                        <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12 19 6.41z" />
                    </svg>
                </div>
                <div class="panel__link-text">
                    <?= __('backend/panel.link-media') ?>
                </div>
            </a>
        </div>

        @if (Auth::user()->role == 'admin')
            <div class="panel__label">
                <?= __('backend/panel.label-admin') ?>
            </div>

            <div class="panel__link-container">
                <a href="/" class="panel__link">
                    <div class="panel__link-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" width="24px" viewBox="0 0 24 24">
                            <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12 19 6.41z" />
                        </svg>
                    </div>
                    <div class="panel__link-text">
                        <?= __('backend/panel.link-settings') ?>
                    </div>
                </a>
            </div>

            <div class="panel__link-container">
                <a href="/" class="panel__link">
                    <div class="panel__link-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" width="24px" viewBox="0 0 24 24">
                            <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12 19 6.41z" />
                        </svg>
                    </div>
                    <div class="panel__link-text">
                        <?= __('backend/panel.link-users') ?>
                    </div>
                </a>
            </div>

            <div class="panel__link-container">
                <a href="/" class="panel__link">
                    <div class="panel__link-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" width="24px" viewBox="0 0 24 24">
                            <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12 19 6.41z" />
                        </svg>
                    </div>
                    <div class="panel__link-text">
                        <?= __('backend/panel.link-menus') ?>
                    </div>
                </a>
            </div>

            <div class="panel__label">
                <?= __('backend/panel.label-developer') ?>
            </div>

            <div class="panel__link-container">
                <a href="/" class="panel__link">
                    <div class="panel__link-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" width="24px" viewBox="0 0 24 24">
                            <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12 19 6.41z" />
                        </svg>
                    </div>
                    <div class="panel__link-text">
                        <?= __('backend/panel.link-variables') ?>
                    </div>
                </a>
            </div>

            <div class="panel__link-container">
                <a href="/" class="panel__link">
                    <div class="panel__link-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" width="24px" viewBox="0 0 24 24">
                            <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12 19 6.41z" />
                        </svg>
                    </div>
                    <div class="panel__link-text">
                        <?= __('backend/panel.link-post-types') ?>
                    </div>
                </a>
            </div>

            <div class="panel__link-container">
                <a href="/" class="panel__link">
                    <div class="panel__link-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" width="24px" viewBox="0 0 24 24">
                            <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12 19 6.41z" />
                        </svg>
                    </div>
                    <div class="panel__link-text">
                        <?= __('backend/panel.link-blocks') ?>
                    </div>
                </a>
            </div>
        @endif

    </div>
</div>
