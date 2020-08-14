@extends('layouts.profileMaster')

@section('content')
@push('styles')
    <style>
        
    </style>
@endpush
<div class="container mt-20">
  
    <div class="flex border-b border-gray-300 ">
      <div class=" flex justify-between m-auto  ">
        <div class=" ml-48 ">
          <p class="text-md text-gray-800 font-bold">Total Balance</p>
         <p class="text-lg text-green-400 font-bold "> + $ {{number_format($balance,0,',',',')}}</p>
         
       

        </div>

      </div>
    </div>
   
    @if ($groupedData->isEmpty())
        <h1 class="mt-5 text-center text-xl font-bold text-gray-400"> There are no withdrawals yet!</h1>
    @else
        @foreach ($groupedData as $key=>$withdrawals)
          <div class="sm:w-2/5 mt-3 text-center">
          <span class="font-bold text-md"> {{\Carbon\Carbon::parse($key)->format('F , Y')}} </span> <span class="pl-2 italic">Total:</span> <span class="font-bold text-red-400 font-mono pl-2"> - ${{$withdrawals->sum('amount')}}</span> 
          </div>
        <div class="container table-responsive pt-3 sm:w-3/5"> 
            <table class="table table-bordered table-hover">
              <thead class="thead-light">
                <tr>
                  <th scope="col">Date </th>
                  <th scope="col">withdrawaled by</th>
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
            @endforeach
     @endif
   

</div>

@endsection
