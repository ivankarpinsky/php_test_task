@component('mail::message')
    # Email Confirmation

    Please refer to the following link:
@component('mail::button', ['url' => route('register.verify', ['token' => $user->verify_token])])
        Verify Email
@endcomponent

@endcomponent

{{--    Thanks,<br>--}}
{{--    {{ config('app.name') }}--}}
