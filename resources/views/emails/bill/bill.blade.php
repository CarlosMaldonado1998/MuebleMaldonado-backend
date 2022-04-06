@component('mail::message')

## Un usuario ha creado una nueva orden.

@component('mail::panel')

**User-ID:** {{$bill->user_id}} <br>
**Fecha:** {{$bill->date}} <br>
**Total:** {{$bill->total}} <br>
@endcomponent

@endcomponent