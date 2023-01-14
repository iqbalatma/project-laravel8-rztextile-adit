@component('mail::message')
Request Reset Password

Hello,

We've received a request to reset the password for RZ Textile account associated with {{ $email }}. No changes have been made to your account yet.

You can reset your password by clicking the button or the link bellow
{{ $url }}


@component('mail::button', ['url' => $url])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent