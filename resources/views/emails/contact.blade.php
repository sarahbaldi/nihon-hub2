@component('mail::message')

# Nuovo messaggio dal form contact
**Nome:**{{ $name }}

**Email:**{{ $email }}

**Messaggio:
**{{ $message }}
    
@endcomponent