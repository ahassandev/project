<x-mail::message>
# New Callback Request

A new callback has been requested with the following details:

**Name:** {{ $data['name'] }}  
**Email:** {{ $data['email'] }}  
**Phone:** {{ $data['phone'] }}  

**Message:**  
{{ $data['message'] }}

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
