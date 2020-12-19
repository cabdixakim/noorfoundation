@extends('layouts.app')
@section('content')
<!-- component -->
 {{-- Tabs section --}}
 <div class="container mt-1 sm:mt-8  " id="section">
  
  
  <div class="flex justify-end mr-2 sm:mr-32 mb-0">
    <a href=""></a>
    <a href="{{route('create-sponsor.create')}}"  class="mb-1 sm:mb-0   block px-2 py-1 rounded-md text-base font-medium text-gray-300 bg-green-400  hover:text-white  hover:bg-green-700 focus:outline-none focus:text-white focus:bg-green-700 transition duration-150 ease-in-out">
    <i class="fa fa-plus-circle"></i> Add sponsor
   </a>
  </div>
  @if (session('status'))
  <div class=" ">
    <div class="alert alert-danger w-full  mb-0 mt-5" role="alert">
      {{ session('status') }}
  </div>
  @endif
  
  <ul class="nav nav-tabs ml-8 sm:ml-32 sm:mt-3  ">
    <li class="active font-bold sm:text-lg "><a data-toggle="tab" class="hover:text-gray-800" href="#home">active sponsors</a></li>
    <li class="pl-8 sm:pl-20 sm:pl-64 font-bold sm:text-lg"><a data-toggle="tab" class="hover:text-gray-800" href="#menu1">Banned sponsors</a></li>
    
  </ul>

  <div class="tab-content ml-6 sm:ml-32 sm:mr-32 mt-6">


    <div id="home" class="tab-pane active ">
      @foreach ($allSponsors as $sponsor)
      @if (!empty($sponsor->profile))

      <div class="flex justify-between border-l border-r  border-t border-transparent border-gray-600 p-2 bg-gray-300 ">
          <div> 
        
              <p><span class="text-lg font-bold  font-sarif text-blue-800">Full Name:</span> <a href="{{route('sponsor.show', $sponsor->id)}}"> <span class="text-gray-800 pl-2 font-bold text-lg italic ">{{ $sponsor->profile->firstname.' '.$sponsor->profile->middlename.' '.$sponsor->profile->lastname}}</span> </a></p>     
             
              </div>
              <div class="sm:mr-32 ml-8 border-l border-gray-400 pl-2">
              <a class="font-bold text-md underline text-red-600" href="#" onclick="event.preventDefault(); document.getElementById('destroysponsor{{$sponsor->id}}').submit()"> Delete User</a>
           </div>
              
              
            </div>
            <div class="flex justify-start mb-2 border-transparent border-gray-600 border-b border-r border-l bg-gray-300"><a class="text-blue-400 underline" href="{{route('update-sponsor-profile.edit', $sponsor->id)}}"> Update profile</a> </div>
      @else 
      <div class="flex justify-between border-l border-r border-t border-transparent border-gray-600 p-2 bg-gray-300 ">
        <div> 
      
            <p><span class="text-lg font-bold  font-sarif text-blue-800">Username:</span> <a href="{{route('sponsor.show', $sponsor->id)}}"> <span class="text-gray-800 pl-2 font-bold text-lg italic ">{{ $sponsor->username ?? ''}}</span> </a></p>     
           
        </div>
        <div class="sm:mr-10 ml-8 border-l border-gray-400 pl-2">
              <a class="font-bold text-md underline text-red-600" href="#" onclick="event.preventDefault(); document.getElementById('destroysponsor{{$sponsor->id}}').submit()"> Delete User</a>
        </div>
      
      </div>
      <div class="flex justify-start mb-2 border-transparent border-gray-600 border-b border-r border-l bg-gray-300"><a class="text-blue-400 underline" href="{{route('update-sponsor-profile.edit', $sponsor->id)}}"> Update profile</a> </div>
      @endif
      <form id="destroysponsor{{$sponsor->id}}" action="{{route('sponsors.destroy',$sponsor->id)}}" method="POST">
        @csrf
        @method('DELETE')
          <input type="hidden" type="submit">
        </form>
      @endforeach
     
    
    </div>   

    <div id="menu1" class="tab-pane fade">
      @foreach ($bannedSponsors as $sponsor)
     @if(!empty($sponsor->profile))
      
      @else 
      <div class="mb-2 flex  justify-between bg-gray-300 border-l border-r border-b border-t border-transparent border-gray-600 p-2  ">
        <div> 
          
        <p><span class="text-lg font-bold font-mono text-blue-800">Username:</span> <a href="{{route('sponsor.show',$sponsor->id)}}"><span class="text-gray-800 font-bold text-lg italic bg-gray-200 border-green-400">{{ $sponsor->username}}</span></a> </p> 
         
      </div>
        <div class="sm:ml-32 ml-8 border-l border-gray-400 pl-2">
        <a class="font-bold text-lg underline" href="#" onclick="event.preventDefault(); document.getElementById('restoresponsor{{$sponsor->id}}').submit()"> remove ban</a>
        </div>
      </div>
       @endif
      <form id="restoresponsor{{$sponsor->id}}" action="{{route('sponsors.destroy',$sponsor->id)}}" method="POST">
        @csrf
        @method('DELETE')
          <input type="hidden" type="submit">
        </form>
      @endforeach 

    </div>
  </div>
  </div>
</div>
 
@endsection