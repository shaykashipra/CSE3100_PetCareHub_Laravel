{{-- template ,using the name,address how email will be sent --}}

@component('mail::message')
Name: {{ $details['name'] }}<br>
Email: {{ $details['email'] }}<br>
Message: {{ $details['message'] }}

Thanks,<br>
{{ config('app.name') }}
@endcomponent