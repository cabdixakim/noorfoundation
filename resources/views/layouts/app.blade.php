<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
   
    
    

     @stack('scripts')
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
  
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/mainTail.css') }}" rel="stylesheet">
      {{-- bootstrap datepicker css --}}
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
    @stack('styles')
</head>
<body>
    <div id="app"></div>
    <div id="firstEl">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-20">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                   <img class="w-6 h-6" src="{{asset('logos\NorAli Logo1.jpg')}}" alt="Noor Ali">
                </a>
               
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        @if (Auth::check() && Auth::user()->user_type == 'admin')
                             
                        
                        <a class="navbar-link mt-2 sm:mt-0 sm:ml-6 hover:text-blue-400   text-gray-100" href="{{ route('deposit.index') }}">
                            <i class="fa  fa-plus-circle text-green-400"></i>
                            <span class="nav-link-text">deposits</span>
                        </a>
                        <a class="navbar-link mt-2 sm:mt-0  sm:ml-6 hover:text-blue-400   text-gray-100" href="{{ route('withdraw.index') }}">
                            <i class="fa fa-minus-circle text-red-400 "></i>
                            <span class="nav-link-text">withdrawals</span>
                       
                        </a>
                   
                        <a class="navbar-link mt-2 sm:mt-0 sm:ml-6  hover:text-blue-400 text-gray-100" href="{{route('sponsored-students.index')}}">
                            <i class="fa fa-fw fa-users"></i>
                            <span class="nav-link-text">students</span>
                        </a>
                        <a class="navbar-link mt-2 sm:mt-0 sm:ml-6  hover:text-blue-400 text-gray-100" href="{{route('graduated-students.index')}}">
                            <span class="nav-link-text">Graduated students</span>
                        </a>
                        <a class="navbar-link mt-2 sm:mt-0 sm:ml-6  hover:text-blue-400 text-gray-100" href="{{route('sponsors.index')}}">
                            <span class="nav-link-text">sponsors</span>
                        </a>
                        <a class="navbar-link mt-2 sm:mt-0 sm:ml-6  hover:text-blue-400 text-gray-100" href="{{route('register-year.create')}}">
                            <span class="nav-link-text">Register Year</span>
                        </a>
                        
                        <a class="navbar-link mt-2 sm:mt-0 sm:ml-16 hover:text-blue-400   text-red-400" href="{{ route('show-records.index') }}">
                            <i class=" fa fa-history "></i>
                            <span class="nav-link-text text-md">History</span>
                        </a>
                        @endif
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else 
                         
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->username ?? '' }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="/password/reset">
                                        {{ __('Reset Password') }}
                                    </a>
                                    
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                            
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

    </div>
           
      @yield('content')
            
 {{-- scripts --}}
 <script src="{{ asset('js/app.js') }}" defer></script>
 <!--  jQuery -->
 <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
 <!-- Bootstrap Date-Picker Plugin -->
 <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<script>
    $(function () {
    $('[data-toggle="tooltip"]').tooltip()
    })
</script>
</body>
</html>
