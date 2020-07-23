@extends('layouts.profileMaster')

@section('content')

    
<div class="bg-gray-600 row sm:flex sm:justify-between pb-20 m-0 " >
  <div class="sm:flex  col-md-7 ">
      <div class="  sm:mt-8 sm:ml-16 ml-24 p-8 flex-column  ">
      <img class="sm:h-32 sm:w-32 h-16 w-16 mb-2   object-cover rounded-full" src="{{ $avatar ??  asset('defaultImage\default.png') }}" alt="" />
      @can('show-edit-avatar')
      <a href="{{route('avatar.create')}}" class="ml-3 sm:ml-8 mt-2 "><i class="fa fa-camera fa-2x text-gray-400 hover:text-blue-500" aria-hidden="true"></i></a>
      @endcan
        
      </div>
      <div>
        <div class="md:w-64 sm:w-full rounded-lg shadow-2xl border-transparent bg-gray-700 sm:ml-4  sm:mt-20 sm:p-3   text-center text-gray-400 ">
            <div class="pt-2 pb-2 font-serif text-xl text-gray-200">
              @if (!empty($student->profile))
               <span class="uppercase"> {{($student->profile->firstname.' '.$student->profile->middlename) }}</span> 
                @else 
                <p>No profile to show</p>
               @endif
                  
            </div>
             <div class="font-mono italic text-xs pb-2">
               @if (!empty($student->plan))
               <span class=""> student at  {{$student->plan->university_name}} university </span>
               @else 
               <p>No profile Yet</p>
               @endif
                   
             </div>
        </div>
      </div>
               
               
  </div>
   <div class="flex col-md-5  sm:my-4 mt-4 mb-4 font-sans text-gray-400 ">
    <div class="md:w-64 sm:w-full md:w-1/3 mx-2 rounded-lg shadow-lg bg-gray-700 p-2 text-center">
      <p class="mt-6">Total money received</p>
      @if (!empty($student->payments))
      <p class="mt-16 font-bold text-gray-200 border-b border-green-400"> USD ${{number_format($student->payments->sum('amount'),0,'.',',')}} </p>
      @endif
          
    </div>
    <div class="md:w-64 sm:w-full md:w-1/3 mx-2 rounded-lg shadow-lg bg-gray-700 text-center p-2">
      <p class="mt-6">Total money received for Current semester</p>
      @if (!empty($student->payments))
        <p class="mt-10 font-bold text-gray-200 border-b border-green-400"> USD ${{number_format($student->goal(),0,'.',',')}} </p>
      @endif
          
    </div>
    <div class="md:w-64 sm:w-full md:w-1/3 mx-2 rounded-lg shadow-lg bg-gray-700 text-center p-2">
      <p class="mt-6">Total fees remaining for Current semester</p>
      @if (!empty($student->payments))
      <p class="mt-10 font-bold text-gray-200 border-b border-red-400"> USD ${{number_format($student->CurrentSemesterCredit(),0,'.',',')}} </p>
      @endif
          
    </div>
  </div>
</div>
  {{-- Tabs section --}}
  <div class="container mt-6 sm:mt-16 " id="section">
  <ul class="nav nav-tabs ml-8 sm:ml-64 ">
    <li class="active font-bold sm:text-lg "><a data-toggle="tab" class="hover:text-gray-800" href="#home">Latest Payments</a></li>
    <li class="pl-8 sm:pl-20 sm:pl-64 font-bold sm:text-lg"><a data-toggle="tab" class="hover:text-gray-800" href="#menu1"> Latest Exam Results</a></li>
    
  </ul>

  <div class="tab-content ml-6 sm:ml-64 mt-6">
    <div id="home" class="tab-pane active ">
      <div class="uppercase mb-2 font-bold"> <span class="border-b border-green-400">Payments</span> </div>
      @foreach ($student->payments as $payment)
      <div class="mb-2 flex justify-start bg-gray-300 border-l border-r border-b border-t border-transparent border-gray-600 p-2  ">
        <div> 
        <p><span class="text-lg font-bold font-mono">Date:</span> <span class="text-red-400 font-bold text-lg italic bg-gray-200 border-green-400">{{ \Carbon\Carbon::parse($payment->created_at)->format('l jS \of F Y')}}</span></p> 
        <p> <span class="text-lg font-bold font-mono">Amount: USD$ </span> <span class="text-red-400 border font-bold text-lg italic bg-gray-200 border-green-400">{{number_format($payment->amount,0,',',',')}}</span> </p> 
        </div>
        <div class="sm:ml-32 ml-8 border-l border-gray-400 pl-2">
        <p><span class="text-lg font-bold font-mono">Paid By:</span> <span class="text-red-400 font-bold text-lg italic bg-gray-200 border-green-400">{{$payment->sponsor->username ?? ''}}</span></p> 
        <a class="font-bold text-lg underline" href="{{$payment->receipt->url ?? ''}}"> See receipt</a>
        </div>
      </div>
      @endforeach
   
      
      
    </div>
    <div id="menu1" class="tab-pane fade">

      <div class="uppercase mb-2 font-bold"> <span class="border-b border-green-400">Results</span> </div>
          
      @foreach ($transcripts as $transcript)
        
        <div class="flex justify-start border-l border-r border-b border-t border-transparent border-gray-600 p-2 bg-gray-300 ">
          <div> 
            <p><span class="text-lg font-bold  font-sarif">Date:</span> <span class="text-gray-600 pl-2 font-bold text-lg italic ">2020/09/03</span></p> 
          </div>
          <div class="sm:ml-32 ml-8 border-l border-gray-400 pl-2">
            
            <p class="text-lg font-bold font-mono">{{$transcript->description}} </p> 
            @if (!empty($transcript->getFirstMediaUrl('transcripts')))
                   <a class="font-bold text-lg underline" href="{{$transcript->getFirstMediaUrl('transcripts')}}"> See transcript</a>
               
            @endif
          </div>
        </div>    
      @endforeach

    </div>
  </div>
  </div>
</div>
@endsection
