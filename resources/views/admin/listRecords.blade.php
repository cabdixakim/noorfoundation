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
   <div class="sm:flex justify-around">
      <div class="sm:w-2/5">
        @if ($records_full->isEmpty())
              <h1 class="mt-5 text-center text-xl font-bold text-gray-400"> There are no records yet!</h1>
        @else
            @foreach ($records_full as $key=>$records)
              <div class="sm:w-full mt-3 text-center">
                <span class="font-bold text-md">Sanadka <span class="font-bold text-lg text-green-500"> {{$key}} </span>  dadka dhameestire </span> 
              </div>

                  @if ($records->isEmpty())
                      <h1 class="mt-5 text-center text-xl font-bold text-gray-400"> There are no records yet!</h1>
                  @else
                    <div class=" table-responsive pt-3 sm:w-full "> 
                        <table class="table table-bordered table-hover">
                          <thead class="bg-green-400">
                            <tr>
                              <th scope="col">magaca</th>
                              <th scope="col">Total</th>
                              <th scope="col">Lacagta dheeradka uu sanadkan dhiibe</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach ($records as $record)
                            <tr>
                              @if (!empty($record->sponsor->profile))
                              <td><a href="{{route('sponsor.show', $record->sponsor->id)}}">{{ucwords($record->sponsor->profile->firstname.' '.$record->sponsor->profile->middlename.' '.$record->sponsor->profile->lastname)}} </a></td>   
                              @else
                              <td class="font-bold"><a href="{{route('sponsor.show', $record->sponsor->id)}}">{{ucwords($record->sponsor->username)}}</a></td>     
                              @endif
                            <td class="pl-5 text-green-500"> +USD {{number_format($record->total,0,',',',')}}</td>
                            <td class="pl-5 text-green-500"> + USD {{number_format($record->total - $record->sponsor->SponsorPlan->amount_required_annually,0,',',',')}}</td>
                            
                            </tr>
                            @endforeach
                          
                          </tbody>
                        </table>
                      </div>
                  @endif
            
                @endforeach
        @endif
      </div>

{{-- for those with balance --}}
      <div class="sm:w-2/5">
            @if ($records_balance->isEmpty())
            <h1 class="mt-5 text-center text-xl font-bold text-gray-400"> There are no records yet!</h1>
          @else
              @foreach ($records_balance as $key=>$records)
                <div class="sm:w-full mt-3 text-center">
                <span class="font-bold text-md">Sanadka <span class="font-bold text-lg text-red-500"> {{$key}} </span>  dadka wax kuhare </span> 
                </div>

                    @if ($records->isEmpty())
                        <h1 class="mt-5 text-center text-xl font-bold text-gray-400"> There are no records yet!</h1>
                    @else
                      <div class=" table-responsive pt-3 sm:w-full "> 
                          <table class="table table-bordered table-hover">
                            <thead class="bg-red-400">
                              <tr>
                                <th scope="col">magaca</th>
                                <th scope="col">lacagta kuharte</th>
                                <th scope="col">lacagta uu bixiye</th>
                              </tr>
                            </thead>
                            <tbody>
                              @foreach ($records as $record)
                              <tr>
                                @if (!empty($record->sponsor->profile))
                                    <td><a href="{{route('sponsor.show', $record->sponsor->id)}}">{{ucwords($record->sponsor->profile->firstname.' '.$record->sponsor->profile->middlename.' '.$record->sponsor->profile->lastname)}} </a></td>   
                                @else
                                    <td class="font-bold"><a href="{{route('sponsor.show', $record->sponsor->id)}}">{{ucwords($record->sponsor->username)}}</a></td>   
                                @endif
                                
                                <td class="pl-5 text-red-500"> - USD {{number_format($record->balance,0,',',',')}} </td>
                                
                                @if (!empty($record->sponsor->deposits))
                                   <td class="pl-5 text-red-500"> - USD {{number_format($record->sponsor->deposits->sum('amount'),0,',',',')}} </td>
                                @else
                                     <small class="italics text-gray-400"> weli waxbo mabixin</small>
                                @endif
                               
                              </tr>
                              @endforeach
                            
                            </tbody>
                          </table>
                    </div>
                @endif
          
              @endforeach
      @endif
      </div>
</div>

@endsection
