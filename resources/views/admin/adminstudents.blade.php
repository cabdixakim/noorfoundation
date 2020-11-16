@extends('layouts.app')
@section('content')
<!-- component -->
 {{-- Tabs section --}}
 <div class="container mt-6 sm:mt-20  " id="section">
  @if (session('status'))
  <div class="flex justify-center items-center ">
    <div class="alert alert-danger w-full sm:w-4/5 sm:ml-64 mb-0 mt-5" role="alert">
      {{ session('status') }}
  </div>
  @endif
  </div>
  <ul class="nav nav-tabs ml-8 sm:ml-32 sm:mt-16  ">
    <li class="active font-bold sm:text-lg "><a data-toggle="tab" class="hover:text-gray-800" href="#home">active Students</a></li>
    <li class="pl-8 sm:pl-20 sm:pl-64 font-bold sm:text-lg"><a data-toggle="tab" class="hover:text-gray-800" href="#menu1">Banned students</a></li>
    
  </ul>

  <div class="tab-content ml-6 sm:ml-32 sm:mr-32 mt-6">


    <div id="home" class="tab-pane active ">
      <div class="uppercase mb-2 font-bold"> <span class="border-b border-green-400">Active Students</span> </div>
      @foreach ($allStudents as $student)
      @if (!empty($student->profile))

      <div class="flex justify-between border-l border-r border-b border-t border-transparent border-gray-600 p-2 bg-gray-300 ">
          <div> 
        
              <p><span class="text-lg font-bold  font-sarif text-blue-800">Full Name:</span> <a href="{{route('student.show', $student->id)}}"> <span class="text-gray-800 pl-2 font-bold text-lg italic ">{{ $student->profile->firstname.' '.$student->profile->middlename.' '.$student->profile->lastname}}</span> </a></p>     
             
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
      @else 
      <div class="flex justify-between border-l border-r border-b border-t border-transparent border-gray-600 p-2 bg-gray-300 ">
        <div> 
      
            <p><span class="text-lg font-bold  font-sarif text-blue-800">Username:</span> <a href="{{route('student.show', $student->id)}}"> <span class="text-gray-800 pl-2 font-bold text-lg italic ">{{ $student->username ?? ''}}</span> </a></p>     
           
        </div>
        <div class="sm:mr-10 ml-8 border-l border-gray-400 pl-2">
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
      <div class="mb-2 flex  justify-between bg-gray-300 border-l border-r border-b border-t border-transparent border-gray-600 p-2  ">
        <div> 
          @if(!empty($student->profile))
        <p><span class="text-lg font-bold font-mono text-blue-800">Full Name:</span> <a href="{{route('student.show',$student->id)}}"><span class="text-gray-800 font-bold text-lg italic bg-gray-200 border-green-400">{{ $student->profile->firstname.' '.$student->profile->middlename.' '.$student->profile->lastname}}</span></a> </p> 
          @endif
      </div>
        <div class="sm:ml-32 ml-8 border-l border-gray-400 pl-2">
        <a class="font-bold text-lg underline" href="#" onclick="event.preventDefault(); document.getElementById('restoreStudent{{$student->id}}').submit()"> remove ban</a>
        </div>
      </div>
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