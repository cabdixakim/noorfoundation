@extends('layouts.app')

@section('content')
@push('styles')
    <style>
        
    </style>
@endpush
<div class="container mt-20">
  
    <div class="flex border-b border-gray-300 ">
      <div class=" flex justify-between m-auto  ">
        <div class=" sm:-ml-48 mr-4  ">
          <p class="text-md text-gray-800 font-bold">Total Balance</p>
         <p class="text-lg text-green-400 font-bold "> + $ {{number_format($balance,0,',',',')}}</p>
         
       </div>
      <a href="{{route('deposit.create')}}"  class="mt-2 sm:-mr-64 sm:mt-1  mb-2 block px-3 py-2 rounded-md text-base font-medium text-gray-300 bg-green-400  hover:text-white  hover:bg-green-700 focus:outline-none focus:text-white focus:bg-green-700 transition duration-150 ease-in-out">
         <i class="fa fa-plus-circle"></i> Deposit
        </a>

      </div>
    </div>
   
    @if ($groupedData->isEmpty())
    <h1 class="mt-5 text-center text-xl font-bold text-gray-400"> There are no deposits yet!</h1>
@else
    @foreach ($groupedData as $key=>$deposits)
      <div class="sm:w-2/5 mt-3 text-center">
      <span class="font-bold text-md"> {{\Carbon\Carbon::parse($key)->format('F , Y')}} </span> <span class="pl-2 italic">Total:</span> <span class="font-bold text-green-400 font-mono pl-2"> + ${{$deposits->sum('amount')}}</span> 
      </div>

      @if ($deposits->isEmpty())
          <h1 class="mt-5 text-center text-xl font-bold text-gray-400"> There are no deposits yet!</h1>
      @else
        <div class="container table-responsive pt-3 sm:w-3/5"> 
            <table class="table table-bordered table-hover">
              <thead class="thead-light">
                <tr>
                  <th scope="col">Date </th>
                  <th scope="col">Deposited by</th>
                  <th scope="col">Amount</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($deposits as $deposit)
                <tr>
                <td>{{$deposit->created_at}}</td>
                  @if (!empty($deposit->sponsor->profile))
                  <td>{{ucwords($deposit->sponsor->profile->firstname.' '.$deposit->sponsor->profile->middlename.' '.$deposit->sponsor->profile->lastname)}}</td>   
                  @else
                  <td>{{ucwords($deposit->sponsor->username)}}</td>   
                  @endif
                <td class="pl-5 text-green-400"> + ${{$deposit->amount}}</td>
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
