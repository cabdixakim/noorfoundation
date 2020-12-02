@extends('layouts.profileMaster')
@section('content')
<!-- component -->
 {{-- Tabs section --}}

 <div class="container mt-6 sm:mt-16 " id="section">
  <ul class="nav nav-tabs ml-8 sm:ml-64 ">
    <li class="active font-bold sm:text-lg "><a data-toggle="tab" class="hover:text-gray-800" href="#home">Graduated students</a></li>    
  </ul>
  @if (Auth::check() && Auth::user()->user_type == 'admin')
    <div class="flex justify-end">
      <a href="{{route('graduated-students.create')}}"  class="mt-2 sm:mt-1 text-center  mb-2 block px-3 py-2 rounded-md text-base font-medium text-gray-300 bg-green-400  hover:text-white  hover:bg-green-700 focus:outline-none focus:text-white focus:bg-green-700 transition duration-150 ease-in-out">
        <i class="fa fa-plus-circle"></i> Add graduated student
      </a>
  </div>
   @endif
  <div class="tab-content ml-6 sm:ml-32 mt-6">
    <div id="home" class="tab-pane active ">
      
      @foreach ($graduated as $student)
      
      <div class="mb-2 flex justify-between bg-gray-300 border-l border-r border-b border-t border-transparent border-gray-600 p-2  ">
        <div>
          @if ($student->relationLoaded('profile'))
          <div> 
            @if ($student->profile)   
            <p><span class="text-lg font-bold font-mono text-blue-800">Full Name:</span> <span class="text-gray-800 font-bold text-lg italic bg-gray-200 border-green-400">
             
             {{ $student->profile->firstname.' '.$student->profile->middlename.' '.$student->profile->lastname  }}</span></p> 
              @else 
              <p><span class="text-lg font-bold font-mono text-blue-800">Full Name:</span> <span class="text-gray-800 font-bold text-lg italic bg-gray-200 border-green-400">{{  $student->username}}</span></p> 
             @endif
          </div>
          @else 
          <div> 
            <p><span class="text-lg font-bold font-mono text-blue-800">Full Name:</span> <span class="text-gray-800 font-bold text-lg italic bg-gray-200 border-green-400">{{ $student->firstname.' '.$student->middlename.' '.$student->lastname}}</span></p> 
            </div>
          @endif
          @if ($student->plan)
          <div> 
          <p><span class="text-lg font-bold font-mono text-blue-800">University:</span> <span class="text-gray-800 font-bold text-lg italic bg-gray-200 border-green-400">{{ $student->plan->university_name}}</span></p> 
          </div>
              @else 
              <div> 
                <p><span class="text-lg font-bold font-mono text-blue-800">University:</span> <span class="text-gray-800 font-bold text-lg italic bg-gray-200 border-green-400">{{ $student->university}}</span></p> 
                </div>
          @endif
          @if ($student->plan)
          <div> 
            <p><span class="text-lg font-bold font-mono text-blue-800">Faculty:</span> <span class="text-gray-800 font-bold text-lg italic bg-gray-200 border-green-400">{{ $student->plan->faculty ?? ''}}</span></p> 
            </div>
          @else
          <div> 
            <p><span class="text-lg font-bold font-mono text-blue-800">Faculty:</span> <span class="text-gray-800 font-bold text-lg italic bg-gray-200 border-green-400">{{ $student->faculty ?? ''}}</span></p> 
            </div>
          @endif
          @if ($student->plan)
          <div> 
            <p><span class="text-lg font-bold font-mono text-blue-800">Graduated On:</span> <span class="text-gray-800 font-bold text-lg italic bg-gray-200 border-green-400">{{ $student->plan->graduation_date ?? ''}}</span></p> 
            </div>
          @else
          <div> 
            <p><span class="text-lg font-bold font-mono text-blue-800">Graduated On:</span> <span class="text-gray-800 font-bold text-lg italic bg-gray-200 border-green-400">{{ $student->graduation_date ?? ''}}</span></p> 
            </div>
          @endif
        </div>
        
        <div class="sm:ml-32 ml-8 border-l border-gray-400 pl-2">
          @if ($student->profile)
            <a class="font-bold text-lg underline" href="{{route('student.show',$student->id)}}"> Check Profile</a>
              
          @else
            <p>No profiile to show</p>
          @endif
        </div>
      </div>  
      
               
    
      @endforeach
   
      
      
    </div>
  </div>
  </div>
</div>
 
@endsection