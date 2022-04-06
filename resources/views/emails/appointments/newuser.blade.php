@component('mail::message')

Dear {{ $user->name }}<br>
You have successfully registerd in our system.<br>
<br>
Your email: {{ $user->email }}<br>
Your passowrd: {{ $password }}<br>

@component('mail::button', ['url' => url('/')])
Log in
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
