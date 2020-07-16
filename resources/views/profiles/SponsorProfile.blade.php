@extends('layouts.profileMaster')

@section('content')
    
<div class="bg-gray-600 row sm:flex sm:justify-between pb-20 m-0 " >
  <div class="sm:flex  col-md-7 ">
      <div class="  sm:mt-8 sm:ml-16 ml-24 p-8  ">
      <img class="sm:h-32 sm:w-32 h-16 w-16  mb-2   object-cover rounded-full" src="{{ $avatar ??  asset('defaultImage\brooks-leibee-27QcqVqgVg4-unsplash.jpg') }}" alt="" />
      
      @can('show-edit-avatar')
      <a href="{{route('avatar.create')}}" class="ml-3 sm:ml-8 mt-2"><i class="fa fa-camera fa-2x text-gray-400 hover:text-blue-500" aria-hidden="true"></i></a>
      @endcan
     
    </div>
      <div>
        <div class="md:w-64 sm:w-full rounded-lg shadow-2xl border-transparent bg-gray-700 sm:ml-4  sm:mt-20 sm:p-3   text-center text-gray-400 ">
            <div class="pt-2 pb-2 font-serif text-base  tracking wider text-gray-200">
              @if (!empty($sponsor->profile))
               <span class="uppercase"> {{($sponsor->profile->firstname.' '.$sponsor->profile->middlename.' '.$sponsor->profile->lastname) }}</span> 
                @else 
                <p>No profile to show</p>
               @endif
                  
            </div>
            
        </div>
      </div>
               
               
  </div>
   <div class="flex col-md-5  sm:my-4 mt-4 mb-4 font-sans text-gray-400 ">
    <div class="md:w-64 sm:w-full md:w-1/3 mx-2 rounded-lg shadow-lg bg-gray-700 p-2 text-center">
      <p class="mt-6">Total money Donated since joinng</p>
      @if (!empty($sponsor->payments))
      <p class="mt-20 sm:mt-16 font-bold text-gray-200 border-b border-green-400"> USD ${{number_format($sponsor->payments->sum('amount'),0,'.',',')}} </p>
      @endif
          
    </div>
    <div class="md:w-64 sm:w-full md:w-1/3 mx-2 rounded-lg shadow-lg bg-gray-700 text-center p-2">
      <p class="mt-6">Total money Donated in the last 4 months</p>
      @if (!empty($sponsor->payments))
        <p class="mt-32 sm:mt-16 font-bold text-gray-200 border-b border-green-400"> USD ${{number_format($sponsor->LastFourMonths(),0,'.',',')}} </p>
      @endif
          
    </div>
    <div class="md:w-64 sm:w-full md:w-1/3 mx-2 rounded-lg shadow-lg bg-gray-700 text-center p-2">
      <p class="mt-6">Number of students sponsored since joining</p>
      @if (!empty($sponsor->payments))
      <p class="mt-32 sm:mt-16 font-bold text-gray-200 border-b border-red-400"> {{number_format($sponsor->SponsoredStudents(),0,'.',',')}} </p>
      @endif
          
    </div>
  </div>
</div>
  {{-- Tabs section --}}
  <div class="container mt-6 sm:mt-16  " id="section">
  <ul class="nav nav-tabs ml-8 sm:ml-64 ">
    <li class="active font-bold sm:text-lg "><a data-toggle="tab" class="hover:text-gray-800" href="#home">Latest Payments</a></li>
    
  </ul>

  <div class="tab-content ml-6 sm:ml-20 mt-6">
    <div id="home" class="tab-pane active ">
      @foreach ($sponsor->payments as $payment)
      <div class="mb-2 flex justify-start bg-gray-300 border-l border-r border-b border-t border-transparent border-gray-600 p-2  ">
        <div> 
        <p><span class="text-lg font-bold font-mono">Date:</span> <span class="text-red-400 font-bold text-lg italic bg-gray-200 border-green-400">{{ \Carbon\Carbon::parse($payment->created_at)->format('l jS \of F Y')}}</span></p> 
        <p> <span class="text-lg font-bold font-mono">Amount: USD$ </span> <span class="text-red-400 border font-bold text-lg italic bg-gray-200 border-green-400">{{number_format($payment->amount,0,',',',')}}</span> </p> 
        </div>
        <div class="sm:ml-32 ml-8 border-l border-gray-400 pl-2">
        <p><span class="text-lg font-bold font-mono">Given To:</span> <span class="text-red-400 font-bold text-lg italic bg-gray-200 border-green-400">{{$payment->student->username ?? ''}}</span></p> 
        <a class="font-bold text-lg underline" href="{{$payment->receipt->url ?? ''}}"> See receipt</a>
        </div>
      </div>
      @endforeach
   
      
      
    </div>

  </div>
  </div>
</div>
@endsection
