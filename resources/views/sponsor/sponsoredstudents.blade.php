@extends('layouts.app')
@section('content')
<!-- component -->
 {{-- Tabs section --}}
 <div class="container mt-6 sm:mt-16 " id="section">
  <ul class="nav nav-tabs ml-8 sm:ml-64 ">
    {{-- <li class="active font-bold sm:text-lg "><a data-toggle="tab" class="hover:text-gray-800" href="#home">Sponsored Students</a></li> --}}
    <li class="pl-8 sm:pl-20 sm:pl-64 font-bold sm:text-lg"><a data-toggle="tab" class="hover:text-gray-800" href="#menu1">All students</a></li>
    
  </ul>

  <div class="tab-content ml-6 sm:ml-64 mt-6">
    {{-- @if (Auth::user()->user_type == 'sponsor')
    <div id="home" class="tab-pane active ">
      <div class="uppercase mb-2 font-bold"> <span class="border-b border-green-400">Sponsored Students</span> </div>
      @foreach ($sponsoredstudents as $student)
      <div class="mb-2 flex  justify-between bg-gray-300 border-l border-r border-b border-t border-transparent border-gray-600 p-2  ">
        <div> 
        <p><span class="text-lg font-bold font-mono text-blue-800">Full Name:</span> <span class="text-gray-800 font-bold text-lg italic bg-gray-200 border-green-400">{{ $student->profile->firstname.' '.$student->profile->middlename.' '.$student->profile->lastname}}</span></p> 
        </div>
        <div class="sm:ml-32 ml-8 border-l border-gray-400 pl-2">
        <a class="font-bold text-lg underline" href="{{route('student.show',$student->id)}}"> Check Profile</a>
        </div>
      </div>
      @endforeach 
    </div>    
    @endif --}}
    <div id="menu1" class="tab-pane active">
      <div class="uppercase mb-2 font-bold"> <span class="border-b border-green-400">All students</span> </div>
      @foreach ($allStudents as $student)
         
          <div class="flex justify-between border-l border-r border-b border-t border-transparent border-gray-600 p-2 bg-gray-300 ">
              <div> 
              @if (!empty($student->profile))
              <p><span class="text-lg font-bold  font-sarif text-blue-800">Full Name:</span> <span class="text-gray-800 pl-2 font-bold text-lg italic ">{{ $student->profile->firstname.' '.$student->profile->middlename.' '.$student->profile->lastname}}</span></p>     
              @else
              <p><span class="text-lg font-bold  font-sarif text-blue-800">Username:</span> <span class="text-gray-800 pl-2 font-bold text-lg italic ">{{ $student->username}}</span></p>     
              @endif
              </div>
              <div class="sm:ml-32 ml-8 border-l border-gray-400 pl-2">
              <a class="font-bold text-lg underline" href="{{route('student.show',$student->id)}}"> Check Profile</a>
              </div>
           </div>
      @endforeach
      

    </div>
  </div>
  </div>
</div>
 
@endsection