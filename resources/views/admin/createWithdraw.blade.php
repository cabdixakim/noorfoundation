@extends('layouts.app')
@section('content')
<!-- component -->
@if (session('status'))
<div class="flex justify-center items-center ">
  <div class="alert alert-success sm:w-1/5 mb-0 mt-5" role="alert">
    {{ session('status') }}
</div>
@endif
</div>

<div class="w-full max-w-xs mt-16 sm:max-w-full sm:flex sm:mt-5">
<form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 ml-16 sm:m-auto sm:w-1/5 " action="{{route('withdraw.store')}}" method="POST">
        
          @csrf
    
        
          <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="student">
              student
            </label>
            <select onchange="SelectSemester(this)" class="shadow appearance-none border border-red-500 rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"   name="student_id">
              <option value="">choose a student</option>
              @foreach ($students as $student)
              @if (!empty($student->plan))
                @if ($student->HasNotReachedGoal() && $student->HasNotGraduated())
                  <option id="Student" data-semester="{{$student->plan->semester}}" value="{{$student->id}}"  type="text" placeholder="Abdihakim" {{old('student_id') == $student->id ? 'selected' : ''}} >{{$student->username}}</option>
                 @endif
                    
              @endif
                  
              @endforeach
            </select>
            @error('student_id')
            <p class="text-red-500 text-xs italic">Please choose a student.</p>
            @enderror
                
          </div>
        
          <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="amount">
              amount
            </label>
            <input class="shadow appearance-none border border-red-500 rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"value="{{old('amount')}}"   name="amount" type="number" placeholder="400">
             @error('amount')
              <p class="text-red-500 text-xs italic">{{$message}}</p>
              @enderror   
          </div>
          <input id="StudentSemester" type="hidden" value="{{old('semester')}}" name="semester" >
          
          <div class="flex items-center justify-between">
            <button class="bg-red-400  sm:text-gray-100 font-bold py-2 whitespace-no-wrap px-4 rounded focus:outline-none focus:shadow-outline hover:bg-red-600" type="submit">
              Withdraw
            </button>
          </div>
        </form>
      </div>
     @push('scripts')
         <script >
            function SelectSemester(e) {
              // var semester = $(this).hide();
              var semester = e.querySelector('#Student').getAttribute("data-semester");
              var studentsem = document.getElementById("StudentSemester");
              studentsem.value = semester;

            }
         </script>
     @endpush
 
@endsection