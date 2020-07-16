@component('mail::message')
# Hello dear,
### {{$payment->sponsor->profile->firstname}} {{$payment->sponsor->profile->middlename}} {{$payment->sponsor->profile->lastname}}!

@component('mail::panel')
you payment is now confirmed... an admin will give it to **{{$payment->student->profile->firstname}} {{$payment->student->profile->middlename}}**  ,

Please Contact him at <{{$payment->student->email}}> or through his/her phone: <tel:{{$payment->student->profile->phone}}>

Please click the link below to check the receipt
@endcomponent
@component('mail::button', ['url' => $payment->receipt->url])
See receipt
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent