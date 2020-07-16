@component('mail::message')
# Hello dear,
### {{$receipt->payment->sponsor->profile->firstname}} {{$receipt->payment->sponsor->profile->middlename}} {{$receipt->payment->sponsor->profile->lastname}}!

@component('mail::panel')
you have made a successful payment  of {{number_format($receipt->payment->amount,0,',',',')}}  dollars to **{{$receipt->payment->student->profile->firstname}} {{$receipt->payment->student->profile->middlename}}**  ,

Please click the link below to check the receipt
@endcomponent
@component('mail::button', ['url' => $receipt->url])
See receipt
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
