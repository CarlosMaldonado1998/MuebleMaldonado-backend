@component('mail::message')

## Ha recibido una nueva consulta.

@component('mail::panel')

**Nombre:** {{$contact->name}} <br>
**Email:** {{$contact->email}} <br>
**Celular:** {{$contact->phone}} <br>
**Mensaje:**  <br>
{{$contact->description}}
@endcomponent

@endcomponent