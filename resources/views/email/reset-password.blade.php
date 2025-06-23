@include('email.email-header')

<div style="font-size: 23px; font-weight: bold; margin: 0 0 24px; text-align: center; color: #fff">
    {!! __('mail.resetPassword.title', ['name' => $mailData['data']['user']['name']]) !!}
</div>

<div style="margin: 0 0 32px; text-align: center">
    {!! __('mail.resetPassword.textAboveButton') !!}
</div>

<div style="margin: 0 0 32px; text-align: center">
    <a
        class="laracms-mail-button"
        style="color: #fff; text-decoration: none"
        href="{{ $mailData['data']['buttonLink'] }}"
    >
        {{ __('mail.resetPassword.buttonText') }}
    </a>
</div>

<div style="text-align: center">
    {!! __('mail.resetPassword.textBelowButton') !!}
</div>

@include('email.email-footer', [
    'footerText' => __('mail.resetPassword.footer', ['app-name' => config('cms.name')])
])
