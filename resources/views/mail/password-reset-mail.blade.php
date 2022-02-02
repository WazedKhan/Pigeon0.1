@component('mail::message')
# Hi

Follow the link below to reset your password in Pigeon.
'http://127.0.0.1:8000/password/reset/{{ $token }}/{{ $mail }}'

@component('mail::button', ['url' => 'http://127.0.0.1:8000/password/reset/{{ $token }}/{{ $mail }}'])
Rest Password
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
