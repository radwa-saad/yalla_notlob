@component('mail::message')
# Welcome to our dining table

Dear {{$email}},

You have been invited to have a meal with us.
Come on, Don't be shy.
{{$url}}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
