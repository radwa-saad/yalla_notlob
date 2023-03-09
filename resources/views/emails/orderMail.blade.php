@component('mail::message')
# Welcome to our dining table

Dear {{$email}},

You have been invited to have a meal with us.
Come on, Don't be shy.
@component('mail::button', ['url' => 'http://127.0.0.1:8000/orders'])
Yalla !NotLob 🍔
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
