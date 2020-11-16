<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

     <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

       <!--  jQuery -->
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
    <!-- Bootstrap Date-Picker Plugin -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
    
    @stack('scripts')

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    {{-- tailwind css --}}
    <link href="{{ asset('css/mainTail.css') }}" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    {{-- bootstrap datepicker css --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
    @stack('styles')
</head>
<body class=" bg-gray-300">

    @php
        if(Auth::check()){
            $user = Auth::user();
        }
        if ($user->user_type != 'admin') {
            # code...
            if(!empty($user->getFirstMediaUrl('avatar'))){
                if ($user->getMedia('avatar')[0]->hasGeneratedConversion('thumb')){
                  $avatar = $user->getFirstMediaUrl('avatar', 'thumb');
                }
            }else {
                $avatar = asset('defaultImage\default.jpg');
            }
        } else {
            $avatar = asset('defaultImage\admin.jpg');
        }
        if ($user->user_type == 'student') {
            $ProfileCreateRoute = route('student.create');
            $ProfileIndexRoute = route('student.index');
        }elseif ($user->user_type == 'sponsor') {
            $ProfileCreateRoute = route('sponsor.create');
            $ProfileIndexRoute = route('sponsor.index');
        } else {
            $ProfileCreateRoute ='';
            $ProfileIndexRoute = '/';
        }
        if (\Route::current()->getName() != 'sponsor.index' && \Route::current()->getName() != 'student.index')  {
          $paymentRoute = '/';
        } else {
          $paymentRoute = '#section';
        }
         
        
     @endphp
    <div id="app">
    <nav-component :user ="{{ $user }}" 
     create-plan-route="{{ route('plan.create')}}"
     create-profile-route="{{$ProfileCreateRoute}}"
     logout-route="{{route( 'logout')}}" 
    payment-route="{{route('payment.create')}}"
    transcript-route="{{route('transcript.create')}}"
    receipt-route="{{route('receipt.create')}}"
     show-profile="{{$ProfileIndexRoute}}"
     avatar="{{ $avatar ?? '' }}"
     students-route="{{route('sponsored-students.index')}}"
     graduated-route="{{route('graduated-students.index')}}"
     sponsors-route="{{route('sponsors-list.index')}}"
    paymentlist-route="{{$paymentRoute}}"
    notification = {{Auth::user()->unReadNotifications->count('id')}}
    notification-route = {{route('notifications.index')}}
    deposits-route = {{route('deposit.index')}}
    withdrawals-route = {{route('withdraw.index')}}
     >
    </nav-component>
    </div>
     {{-- display blade view content --}}
        @yield('content')



    
  
</body>
</html>
