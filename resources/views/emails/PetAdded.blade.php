@component('mail::message')
# New Pet Added

**Name:** {{ $pet->pet_name }}<br>
**Age:** {{ $pet->age }}<br>
**Gender:** {{ $pet->gender }}<br>
**Type:** {{ $pet->animal_type }}<br>
**Color:** {{ $pet->color }}<br>
**Coat Length:** {{ $pet->coat_length }}<br>
**Description:** {{ $pet->description }}

@component('mail::button', ['url' => url('./pets/' . $pet->id)])
View Pet
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
