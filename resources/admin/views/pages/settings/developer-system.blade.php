<div class="tab-content__container -active" data-tab-content="system">
    <div class="settings__wrapper">
        <div class="settings__container">
            <div class="settings__title">{{ __('admin::settings.developer.system.sections.laravel.title') }}</div>
            <div class="settings__items">
                <div class="settings__item">
                    <div class="settings__label">{{ __('admin::settings.developer.system.sections.laravel.items.laravel_version') }}</div>
                    <div class="settings__value monospace">{{ $serverInfo['laravel_version'] }}</div>
                </div>
                <div class="settings__item">
                    <div class="settings__label">{{ __('admin::settings.developer.system.sections.laravel.items.laravel_env') }}</div>
                    <div class="settings__value monospace">{{ $serverInfo['laravel_env'] }}</div>
                </div>
                <div class="settings__item">
                    <div class="settings__label">{{ __('admin::settings.developer.system.sections.laravel.items.laravel_debug') }}</div>
                    <div class="settings__value monospace">{!! $serverInfo['laravel_debug'] ? '<span class="icon -small-text-icon -has-margin">check_circle</span>' . __('admin::app.yes') : '<span class="icon -small-text-icon -has-margin">cancel</span>' . __('admin::app.no') !!}</div>
                    @if (empty(Auth::user()->settings['ignore-system-warnings']['laravel_debug']))
                        @if ($serverInfo['laravel_debug'] && $serverInfo['laravel_env'] === 'production')
                            <div class="settings__description-container" data-warning="laravel_debug">
                                <div class="settings__description -error">
                                    <span class="icon -small-text-icon">warning</span>{!! __('admin::settings.developer.system.sections.laravel.warnings.laravel_debug') !!} <span class="link" data-warning-id="ignore-system-warnings" data-remove-warning="laravel_debug">{{ __('admin::settings.ignoreWarning') }}</span>
                                </div>
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
        <div class="settings__container">
            <div class="settings__title -has-link">
                <span>{{ __('admin::settings.developer.system.sections.php.title') }}</span>
                <a href="/admin/settings/developer/phpinfo" target="_blank" class="-small-text"><span class="icon -small-text-icon">open_in_new</span> {{ __('admin::settings.developer.system.sections.php.phpinfo') }}</a>
            </div>
            <div class="settings__items">
                <div class="settings__item">
                    <div class="settings__label">{{ __('admin::settings.developer.system.sections.php.items.php_version') }}</div>
                    <div class="settings__value monospace">{{ $serverInfo['php_version'] }}</div>
                    @if (empty(Auth::user()->settings['ignore-system-warnings']['php_version']))
                        @if (version_compare(
                            $serverInfo['php_version'],
                            $serverInfo['php_version_suggested'],
                            '<'
                        ))
                            <div class="settings__description-container" data-warning="php_version">
                                <div class="settings__description -error">
                                    <span class="icon -small-text-icon">warning</span>{!! __('admin::settings.developer.system.sections.php.warnings.php_version', ['value' => $serverInfo['php_version_suggested']]) !!} <span class="link" data-warning-id="ignore-system-warnings" data-remove-warning="php_version">{{ __('admin::settings.ignoreWarning') }}</span>
                                </div>
                            </div>
                        @endif
                    @endif
                </div>
                <div class="settings__item">
                    <div class="settings__label">{!! __('admin::settings.developer.system.sections.php.items.memory_limit') !!}</div>
                    <div class="settings__sublabel monospace">memory_limit</div>
                    <div class="settings__value monospace">{{ $serverInfo['memory_limit'] }}</div>
                    @if (empty(Auth::user()->settings['ignore-system-warnings']['memory_limit']))
                        @if (
                            (int) rtrim($serverInfo['memory_limit'], 'KMGT') < (int) rtrim($serverInfo['memory_limit_suggested'], 'KMGT')
                        )
                            <div class="settings__description-container" data-warning="memory_limit">
                                <div class="settings__description -warning">
                                    <span class="icon -small-text-icon">warning</span> {!! __('admin::settings.developer.system.sections.php.warnings.memory_limit', ['value' => $serverInfo['memory_limit_suggested']]) !!} <span class="link" data-warning-id="ignore-system-warnings" data-remove-warning="memory_limit">{{ __('admin::settings.ignoreWarning') }}</span>
                                </div>
                            </div>
                        @endif
                    @endif
                </div>
                <div class="settings__item">
                    <div class="settings__label">{!! __('admin::settings.developer.system.sections.php.items.upload_max_filesize') !!}</div>
                    <div class="settings__sublabel monospace">upload_max_filesize</div>
                    <div class="settings__value monospace">{{ $serverInfo['upload_max_filesize'] }}</div>
                    @if (empty(Auth::user()->settings['ignore-system-warnings']['upload_max_filesize']))
                        @if (
                            (int) rtrim($serverInfo['upload_max_filesize'], 'KMGT') < (int) rtrim($serverInfo['upload_max_filesize_suggested'], 'KMGT')
                        )
                            <div class="settings__description-container" data-warning="upload_max_filesize">
                                <div class="settings__description -warning">
                                    <span class="icon -small-text-icon">warning</span> {!! __('admin::settings.developer.system.sections.php.warnings.upload_max_filesize', ['value' => $serverInfo['upload_max_filesize_suggested']]) !!} <span class="link" data-warning-id="ignore-system-warnings" data-remove-warning="upload_max_filesize">{{ __('admin::settings.ignoreWarning') }}</span>
                                </div>
                            </div>
                        @endif
                    @endif
                </div>
                <div class="settings__item">
                    <div class="settings__label">{!! __('admin::settings.developer.system.sections.php.items.post_max_size') !!}</div>
                    <div class="settings__sublabel monospace">post_max_size</div>
                    <div class="settings__value monospace">{{ $serverInfo['post_max_size'] }}</div>
                    @if (empty(Auth::user()->settings['ignore-system-warnings']['post_max_size']))
                        @if (
                            (int) rtrim($serverInfo['post_max_size'], 'KMGT') < (int) rtrim($serverInfo['post_max_size_suggested'], 'KMGT')
                        )
                            <div class="settings__description-container" data-warning="post_max_size">
                                <div class="settings__description -warning">
                                    <span class="icon -small-text-icon">warning</span> {!! __('admin::settings.developer.system.sections.php.warnings.post_max_size', ['value' => $serverInfo['post_max_size_suggested']]) !!} <span class="link" data-warning-id="ignore-system-warnings" data-remove-warning="post_max_size">{{ __('admin::settings.ignoreWarning') }}</span>
                                </div>
                            </div>
                        @endif
                    @endif
                </div>
                <div class="settings__item">
                    <div class="settings__label">{!! __('admin::settings.developer.system.sections.php.items.max_execution_time') !!}</div>
                    <div class="settings__sublabel monospace">max_execution_time</div>
                    <div class="settings__value monospace">{{ $serverInfo['max_execution_time'] }}</div>
                    @if (empty(Auth::user()->settings['ignore-system-warnings']['max_execution_time']))
                        @if (
                            (int) $serverInfo['max_execution_time'] < (int) $serverInfo['max_execution_time_suggested']
                        )
                        <div class="settings__description-container" data-warning="max_execution_time">
                            <div class="settings__description -warning">
                                <span class="icon -small-text-icon">warning</span> {!! __('admin::settings.developer.system.sections.php.warnings.max_execution_time', ['value' => $serverInfo['max_execution_time_suggested']]) !!} <span class="link" data-warning-id="ignore-system-warnings" data-remove-warning="max_execution_time">{{ __('admin::settings.ignoreWarning') }}</span>
                            </div>
                        </div>
                        @endif
                    @endif
                </div>
                <div class="settings__item">
                    <div class="settings__label">{!! __('admin::settings.developer.system.sections.php.items.gd') !!}</div>
                    <div class="settings__value monospace">{!! $serverInfo['gd'] ? '<span class="icon -small-text-icon -has-margin">check_circle</span>' . __('admin::app.yes') : '<span class="icon -small-text-icon -has-margin">cancel</span>' . __('admin::app.no') !!}</div>
                    @if (empty(Auth::user()->settings['ignore-system-warnings']['gd']))
                        @if (
                            $serverInfo['gd'] === 0 &&
                            $serverInfo['imagick'] === 0
                        )
                        <div class="settings__description-container" data-warning="gd">
                            <div class="settings__description -error">
                                <span class="icon -small-text-icon">warning</span> {!! __('admin::settings.developer.system.sections.php.warnings.gd') !!} <span class="link" data-remove-warning="gd">{{ __('admin::settings.ignoreWarning') }}</span>
                            </div>
                        </div>
                        @endif
                    @endif
                </div>
                <div class="settings__item">
                    <div class="settings__label">{!! __('admin::settings.developer.system.sections.php.items.imagick') !!}</div>
                    <div class="settings__value monospace">{!! $serverInfo['imagick'] ? '<span class="icon -small-text-icon -has-margin">check_circle</span>' . __('admin::app.yes') : '<span class="icon -small-text-icon -has-margin">cancel</span>' . __('admin::app.no') !!}</div>
                    @if (empty(Auth::user()->settings['ignore-system-warnings']['imagick']))
                        @if (
                            $serverInfo['imagick'] === 0
                        )
                        <div class="settings__description-container" data-warning="imagick">
                            <div class="settings__description -warning">
                                <span class="icon -small-text-icon">warning</span> {!! __('admin::settings.developer.system.sections.php.warnings.imagick') !!} <span class="link" data-warning-id="ignore-system-warnings" data-remove-warning="imagick">{{ __('admin::settings.ignoreWarning') }}</span>
                            </div>
                        </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
        <div class="settings__container">
            <div class="settings__title">{{ __('admin::settings.developer.system.sections.disk.title') }}</div>
            <div class="settings__items">
                <div class="settings__item">
                    <div class="settings__label">{{ __('admin::settings.developer.system.sections.disk.items.disk_free') }}</div>
                    <div class="settings__value monospace">{{ $serverInfo['disk_free'] }}</div>
                </div>
                <div class="settings__item">
                    <div class="settings__label">{{ __('admin::settings.developer.system.sections.disk.items.disk_total') }}</div>
                    <div class="settings__value monospace">{{ $serverInfo['disk_total'] }}</div>
                </div>
            </div>
        </div>
        <div class="settings__container">
            <div class="settings__title">{{ __('admin::settings.developer.system.sections.time.title') }}</div>
            <div class="settings__items">
                <div class="settings__item">
                    <div class="settings__label">{{ __('admin::settings.developer.system.sections.time.items.timezone') }}</div>
                    <div class="settings__value monospace">{{ $serverInfo['timezone'] }}</div>
                </div>
            </div>
        </div>
    </div>

    @if (!empty(Auth::user()->settings['ignore-system-warnings']))
    <div class="settings__links-container">
        <div class="settings__links">
            <span class="settings__link link" data-reset-warnings="ignore-system-warnings">{{ __('admin::settings.resetIgnoreWarnings') }}</span>
        </div>
    </div>
    @endif
</div>