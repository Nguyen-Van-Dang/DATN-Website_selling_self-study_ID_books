@component('mail::message')
# Bạn có một thông báo mới !!!

Tên: {{$contactData['name']}}  
Email: {{$contactData['email']}}  
Nội dung: {{$contactData['message']}}

Thanks,<br>

{{ config('app.name') }}
@endcomponent