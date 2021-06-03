@extends('layouts.app')

@section('content')
@push('styles')
    <style>
        
    </style>
@endpush
<div class="container mt-20">
   
      @if (App\RegisterYear::first() && App\RegisterYear::first()->year < Carbon\Carbon::now()->format('Y'))
          <div id="alert" class=" mb-20 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">sanadka waa dhamade!</strong>
            <span class="block sm:inline">  fadlan sanadka lagu jiro dooro </span> <a href="{{route('register-year.create')}}"><span class="ml-5 text-blue-400"> Click here</span> </a>
            <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
              <svg class="fill-current h-6 w-6 text-red-500" role="button" onclick="document.getElementById('alert').style.display='none'; " xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
            </span>
          </div>
        @endif  
        {{-- alert box --}}
    <div class="flex border-b border-gray-300 ">
      <div class=" flex justify-between m-auto  ">
        <div class=" sm:-ml-48 mr-4 ">
          <p class="text-md text-gray-800 font-bold">Total Balance</p>
         <p class="text-lg text-green-400 font-bold "> + $ {{number_format($balance,0,',',',')}}</p>
         
       </div>
      <a href="{{route('withdraw.create')}}"  class="mt-2 sm:-mr-64 sm:mt-1  mb-2 block px-3 py-2 rounded-md text-base font-medium text-gray-300 bg-red-400  hover:text-white  hover:bg-red-700 focus:outline-none focus:text-white focus:bg-red-500 transition duration-150 ease-in-out">
         <i class="fa fa-minus-circle"></i> withdraw
        </a>

      </div>
    </div>
   
    @if ($groupedData->isEmpty())
        <h1 class="mt-5 text-center text-xl font-bold text-gray-400"> There are no withdrawals yet!</h1>
    @else
        @foreach ($groupedData as $key=>$withdrawals)
          <div class="sm:w-2/5 mt-3 text-center">
          <span class="font-bold text-md"> {{\Carbon\Carbon::parse($key)->format('F , Y')}} </span> <span class="pl-2 italic">Total:</span> <span class="font-bold text-red-400 font-mono pl-2"> - ${{$withdrawals->sum('amount')}}</span> 
          </div>
          @if ($withdrawals->isEmpty())
          <h1 class="mt-5 text-center text-xl font-bold text-gray-400"> There are no withdrawals yet!</h1>
          @else
          <div class="container table-responsive pt-3 sm:w-3/5"> 
              <table class="table table-bordered table-hover">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">Date </th>
                    <th scope="col">withdrawn by</th>
                    <th scope="col">Amount</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($withdrawals as $withdrawal)
                  <tr>
                  <td>{{$withdrawal->created_at}}</td>
                  @if (!empty($withdrawal->student->profile))
                  <td>{{ucwords($withdrawal->student->profile->firstname.' '.$withdrawal->student->profile->middlename.' '.$withdrawal->student->profile->lastname)}}</td>   
                  @else
                  <td>{{ucwords($withdrawal->student->username)}}</td>   
                  @endif
                  <td class="pl-5 text-red-400"> - ${{$withdrawal->amount}}</td>
                  </tr>
                  @endforeach
                
                </tbody>
              </table>
            </div>
          @endif
       
            @endforeach
     @endif
   

</div>

@endsection
