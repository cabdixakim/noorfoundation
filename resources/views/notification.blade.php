@extends('layouts.profileMaster')
  
@section('content')    
{{-- start of plan form --}}
<!-- component -->
<div class="flex mt-5">
  <div class="m-auto">
    <h4 class="text-gray-800 font-bold border-b border-gray-500">Notification History</h4>
  </div>
</div>
<div class="w-full  max-w-xs sm:max-w-full sm:flex ">
  <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 ml-16 sm:m-auto sm:w-2/5 " >
   @if($notifications->isNotEmpty())
   
   <div class="flex justify-between mb-3">
     <p></p>
     <a class="mr-0 text-end font-bold" href="" onclick="event.preventDefault();
           document.getElementById('MarkNotification').submit();"> 
       Mark all as read</a>
   </div>
   <form id="MarkNotification" action="{{ route('notifications.destroy', Auth::user()->id) }}" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
   </form>

     @foreach ($notifications as $notification)
         @if ($notification->type ==  'App\Notifications\DepositNotification')
             @if ($notification->data['username'] == Auth::user()->username)
             <div class="flex justify-between">
                   <p><span class="font-bold pr-1 border-b border-gray-300">You</span> have deposited</p>
                <p><span class="text-green-400 font-bold"> + ${{$notification->data['amount']}}</span></p>
             </div>
                 
             @else
             <div class="flex justify-between border-b border-gray-300">
                  <p><span class="font-bold pr-1">{{$notification->data['username']}}</span> has deposited</p>
                  <p><span class="text-green-400 font-bold"> + ${{$notification->data['amount']}}</span></p>
              </div>
        
             @endif
         @else
         @if ($notification->data['username'] == Auth::user()->username)
         <div class="flex justify-between">
               <p><span class="font-bold pr-1 border-b border-gray-300">You</span> have Withdrawn</p>
            <p><span class="text-green-400 font-bold"> + ${{$notification->data['amount']}}</span></p>
         </div>
             
         @else
         <div class="flex justify-between border-b border-gray-300">
              <p><span class="font-bold pr-1">{{$notification->data['username']}}</span> has Withdrawn</p>
              <p><span class="text-green-400 font-bold"> + ${{$notification->data['amount']}}</span></p>
          </div>
         @endif
         @endif
     @endforeach
     @else 
     <h1 class="text-center text-gray-500"> Nothing new to show</h1>
     @endif
     
    </div>
    </div>
 </div>
      {{-- end of plan form --}} 
     
   

@endsection