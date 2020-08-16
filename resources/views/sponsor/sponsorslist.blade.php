@extends('layouts.profileMaster')
@section('content')
<!-- component -->
 {{-- Tabs section --}}
 <div class="container mt-6 sm:mt-16 " id="section">
  <ul class="nav nav-tabs ml-8 sm:ml-64 ">
    <li class="active font-bold sm:text-lg "><a data-toggle="tab" class="hover:text-gray-800" href="#home">All sponsors</a></li>    
  </ul>

  <div class="tab-content ml-6 sm:ml-64 mt-6">
    <div id="home" class="tab-pane active ">
      @foreach ($sponsors as $sponsor)
      <div class="mb-2 flex justify-between bg-gray-300 border-l border-r border-b border-t border-transparent border-gray-600 p-2  ">
        <div> 
          @if (!empty($sponsor->profile))
        <p><span class="text-lg font-bold font-mono text-blue-800">Full Name:</span> <span class="text-gray-800 font-bold text-lg italic bg-gray-200 border-green-400">{{ $sponsor->profile->firstname.' '.$sponsor->profile->middlename.' '.$sponsor->profile->lastname}}</span></p> 
        @else 
        <p><span class="text-lg font-bold font-mono text-blue-800">Full Name:</span> <span class="text-gray-800 font-bold text-lg italic bg-gray-200 border-green-400">{{ $sponsor->username}}</span></p> 
        @endif
      </div>
        <div class="sm:ml-32 ml-8 border-l border-gray-400 pl-2">
        <a class="font-bold text-lg underline" href="{{route('sponsor.show',$sponsor->id)}}"> Check Profile</a>
        </div>
      </div>    
      @endforeach
   
      
      
    </div>
  </div>
  </div>
</div>
 
@endsection