
@component('mail::message')
# Welcome to Yalla Notlob App

Dear {{$email}},

Your friend adedd you to his friends on our app to have great time sharing food together.

<br>
Check invitation now
@component('mail::button', ['url' => 'http://127.0.0.1:8000/friends'])
Yalla !NotLob 🍔
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
