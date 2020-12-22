@extends('layouts.app')
@section('content')
<!-- component -->
 {{-- Tabs section --}}
 <div class="container mt-1 sm:mt-8  " id="section">
 
  <div class="flex justify-end mr-2 sm:mr-32 mb-0">
    <a href=""></a>
    <a href="{{route('create-student.create')}}"  class="mb-1 sm:mb-0   block px-2 py-1 rounded-md text-base font-medium text-gray-300 bg-green-400  hover:text-white  hover:bg-green-700 focus:outline-none focus:text-white focus:bg-green-700 transition duration-150 ease-in-out">
    <i class="fa fa-plus-circle"></i> Add student
   </a>
  </div>
  @if (session('status'))
  <div class=" ">
    <div class="alert alert-danger w-full  mb-0 mt-5" role="alert">
      {{ session('status') }}
  </div>
  @endif
  
  <ul class="nav nav-tabs ml-8 sm:ml-32 sm:mt-3  ">
    <li class="active font-bold sm:text-lg "><a data-toggle="tab" class="hover:text-gray-800" href="#home">active Students</a></li>
    <li class="pl-8 sm:pl-20 sm:pl-64 font-bold sm:text-lg"><a data-toggle="tab" class="hover:text-gray-800" href="#menu1">Banned students</a></li>
    
  </ul>

  <div class="tab-content ml-6 sm:ml-32 sm:mr-32 mt-6">


    <div id="home" class="tab-pane active ">
      <div class="uppercase mb-2 font-bold"> <span class="border-b border-green-400">Active Students</span> </div>
      @foreach ($allStudents as $student)
      @if (!empty($student->profile))

      <div class="flex justify-between border-l border-r  border-t border-transparent border-gray-600 p-2 bg-gray-300 ">
          <div> 
        
              <p><span class="text-lg font-bold  font-sarif text-blue-800">Full Name:</span> <a href="{{route('student.show', $student->id)}}"> <span class="text-gray-800 pl-2 font-bold text-lg italic ">{{ $student->profile->firstname.' '.$student->profile->middlename.' '.$student->profile->lastname}}</span> </a></p>     
             @if (auth()->user()->user_type == 'admin')
                 <small class="text-red-500"> {{$user->username}} </small>
             @endif
              </div>
              <div class="sm:mr-32 ml-8 border-l border-gray-400 pl-2">
              <a class="font-bold text-md underline text-red-600" href="#" onclick="event.preventDefault(); document.getElementById('destroyStudent{{$student->id}}').submit()"> Delete User</a>
           </div>
              
              <a href="{{route('student-settings.edit', $student->id)}}" type="button" class="" data-toggle="tooltip" data-placement="top" title="{{($student->plansetting->status == 'enabled') ? 'disable plan edit for student' : 'enable plan edit for student'}}">
                @if ($student->plansetting->status == 'enabled')
                <span><i class="fa fa-2x fa-toggle-on text-blue-500"></i></span>
                @else  
                <span><i class="fa fa-2x fa-toggle-off"></i></span>
                @endif
              </a>
            </div>
            <div class="flex justify-start mb-2 border-transparent border-gray-600 border-b border-r border-l bg-gray-300"><a class="text-blue-400 underline" href="{{route('update-student-profile.edit', $student->id)}}"> Update profile</a> <a class="ml-4 text-blue-400 underline" href="{{route('update-student-plan.edit', $student->id)}}"> Update Plan</a></div>
      @else 
      <div class="flex justify-between border-l border-r border-t border-transparent border-gray-600 p-2 bg-gray-300 ">
        <div> 
      
            <p><span class="text-lg font-bold  font-sarif text-blue-800">Username:</span> <a href="{{route('student.show', $student->id)}}"> <span class="text-gray-800 pl-2 font-bold text-lg italic ">{{ $student->username ?? ''}}</span> </a></p>     
           
        </div>
        <div class="sm:mr-10 ml-8 border-l border-gray-400 pl-2">
              <a class="font-bold text-md underline text-red-600" href="#" onclick="event.preventDefault(); document.getElementById('destroyStudent{{$student->id}}').submit()"> Delete User</a>
        </div>
      <a href="{{route('student-settings.edit', $student->id)}}" type="button" class="" data-toggle="tooltip" data-placement="top" title="@if($student->plansetting){{($student->plansetting->status == 'enabled') ? 'disable plan edit for student' : 'enable plan edit for student'}}@endif">
            @if ($student->plansetting && $student->plansetting->status == 'enabled')
            <span><i class="fa fa-2x fa-toggle-on text-blue-500"></i></span>
            @else  
            <span><i class="fa fa-2x fa-toggle-off"></i></span>
            @endif
          </a>
      </div>
      <div class="flex justify-start mb-2 border-transparent border-gray-600 border-b border-r border-l bg-gray-300"><a class="text-blue-400 underline" href="{{route('update-student-profile.edit', $student->id)}}"> Update profile</a> <a class="ml-4 text-blue-400 underline" href="{{route('update-student-plan.edit', $student->id)}}"> Update Plan</a></div>
      @endif
      <form id="destroyStudent{{$student->id}}" action="{{route('student.destroy',$student->id)}}" method="POST">
        @csrf
        @method('DELETE')
          <input type="hidden" type="submit">
        </form>
      @endforeach
     
    
    </div>   

    <div id="menu1" class="tab-pane fade">
      <div class="uppercase mb-2 font-bold"> <span class="border-b border-green-400">Banned students</span> </div>
      @foreach ($bannedStudents as $student)
        @if(!empty($student->profile)) 
        <div class="mb-2 flex  justify-between bg-gray-300 border-l border-r border-b border-t border-transparent border-gray-600 p-2  ">
            <div> 
              
            <p><span class="text-lg font-bold font-mono text-blue-800">Full Name:</span> <a href="{{route('student.show',$student->id)}}"><span class="text-gray-800 font-bold text-lg italic bg-gray-200 border-green-400">{{ $student->profile->firstname.' '.$student->profile->middlename.' '.$student->profile->lastname}}</span></a> </p> 
              
          </div>
            <div class="sm:ml-32 ml-8 border-l border-gray-400 pl-2">
            <a class="font-bold text-lg underline" href="#" onclick="event.preventDefault(); document.getElementById('restoreStudent{{$student->id}}').submit()"> remove ban</a>
            </div>
          </div>
      @else
        <div class="mb-2 flex  justify-between bg-gray-300 border-l border-r border-b border-t border-transparent border-gray-600 p-2  ">
          <div> 
            
          <p><span class="text-lg font-bold font-mono text-blue-800">Username:</span> <a href="{{route('student.show',$student->id)}}"><span class="text-gray-800 font-bold text-lg italic bg-gray-200 border-green-400">{{ $student->username}}</span></a> </p> 
            
        </div>
          <div class="sm:ml-32 ml-8 border-l border-gray-400 pl-2">
          <a class="font-bold text-lg underline" href="#" onclick="event.preventDefault(); document.getElementById('restoreStudent{{$student->id}}').submit()"> remove ban</a>
          </div>
        </div>
      @endif
      <form id="restoreStudent{{$student->id}}" action="{{route('student.destroy',$student->id)}}" method="POST">
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