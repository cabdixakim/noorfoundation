@extends('layouts.profileMaster')
@section('content')
<!-- component -->
<div class="flex mt-4 "><p class="text-lg font-bold text-gray-800 m-auto border-b border-green-400"> Graduated Student Information</p> </div>

<div class="w-full max-w-xs sm:max-w-full sm:flex sm:mt-5">
  @if(empty($student->profile))

    <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 ml-16 sm:m-auto sm:w-2/5 " action="{{route('graduated-students.store')}}" method="POST">
    
      @csrf

     
      <div class="mb-6">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="firstname">
          firstname
        </label>
        <input class="shadow appearance-none border border-red-500 rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" value="{{old('firstname')}}" name="firstname" type="text" placeholder="abdihakim">
       @error('firstname')
         <p class="text-red-500 text-xs italic">Please choose first name.</p>
        @enderror
      </div>
      <div class="mb-6">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="middlename">
          middlename
        </label>
        <input class="shadow appearance-none border border-red-500 rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"value="{{old('middlename')}}"  name="middlename" type="text" placeholder="salan">
        @error('middlename')
        <p class="text-red-500 text-xs italic">Please choose a middle name.</p>
        @enderror
            
      </div>
      <div class="mb-6">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="lastname">
          lastname
        </label>
        <input class="shadow appearance-none border border-red-500 rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" value="{{old('lastname')}}" name="lastname" type="text" placeholder="noor">
       @error('lastname')
       <p class="text-red-500 text-xs italic">Please choose last name.</p>
       @enderror
           
      </div>
      <div class="mb-6">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="university">
          university
        </label>
        <input class="shadow appearance-none border border-red-500 rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" value="{{old('university')}}" name="university" type="text" placeholder="noor">
       @error('university')
       <p class="text-red-500 text-xs italic">Please choose a university.</p>
       @enderror
           
      </div>
      <div class="mb-6">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="faculty">
          faculty
        </label>
        <input class="shadow appearance-none border border-red-500 rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" value="{{old('faculty')}}" name="faculty" type="text" placeholder="noor">
       @error('faculty')
       <p class="text-red-500 text-xs italic">Please choose a faculty.</p>
       @enderror
           
      </div>
      
      <div class="mb-6">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="start_date">
          Joined Nourfoundation on?
        </label>
        <div class="flex items-start ">
          <input data-provide="datepicker" data-date-format="yyyy/mm" data-date-min-view-mode="months" class="shadow appearance-none border border-red-500 rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" value="{{old('start_date')}}" name="start_date" type="text" placeholder="2020/2/19">
          <span class=""><i class="far fa-calendar-alt fa-2x  ml-2 h-full"></i></span>
        </div>

       @error('start_date')
       <p class="text-red-500 text-xs italic">Please choose start date</p>
       @enderror
           
      </div>
      <div class="mb-6">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="graduation_date">
           Graduated on?
        </label>
        <div class="flex items-start ">
          <input data-provide="datepicker" data-date-format="yyyy/mm" data-date-min-view-mode="months" class="shadow appearance-none border border-red-500 rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" value="{{old('graduation_date')}}" name="graduation_date" type="text" placeholder="2020/2/19">
          <span class=""><i class="far fa-calendar-alt fa-2x  ml-2 h-full"></i></span>
        </div>

       @error('graduation_date')
       <p class="text-red-500 text-xs italic">Please choose graduation date</p>
       @enderror
           
      </div>
      <div class="flex items-center justify-between">
        <button class="bg-blue-500 hover:bg-blue-700 sm:text-white font-bold py-2 whitespace-no-wrap px-4 rounded focus:outline-none focus:shadow-outline hover:bg-blue-600" type="submit">
         save
        </button>
      </div>
    </form>
    @else 

    
   
       <ul class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 ml-16 mt-16 sm:mx-auto sm:w-2/5 ">
        <div class="sm:flex sm:items-center justify-end mb-5">
        <a href="{{route('student.edit', $student->username)}}" class="bg-green-400 text-gray-100 hover:text-gray-100 font-bold py-2 whitespace-no-wrap px-4 rounded focus:outline-none focus:shadow-outline hover:bg-green-600" >
            Update Profile
          </a>
        </div>
         <div class="mb-6 sm:flex sm:justify-between sm:items-center shadow appearance-none border-b border-green-500 rounded">
          <label class="pl-6 block text-gray-700 text-sm font-bold tracking-widest mb-2" for="firstname">
            firstname :
            </label>
          <li class=" w-2/3 font-bold py-2 pl-4 sm:pl-auto uppercase mb-2 text-gray-700 tracking-widest leading-tight  ">
            {{$student->profile->firstname}}
          </li>
          </div>
          <div class="mb-6 sm:flex sm:justify-between sm:items-center shadow appearance-none border-b border-green-500 rounded">
            <label class="pl-6 block text-gray-700 text-sm font-bold tracking-widest mb-2" for="firstname">
              middlename :
              </label>
            <li class=" w-2/3 font-bold py-2 pl-4 sm:pl-auto uppercase mb-2 text-gray-700 tracking-widest leading-tight  ">
              {{$student->profile->middlename}}
            </li>
            </div>
            <div class="mb-6 sm:flex sm:justify-between sm:items-center shadow appearance-none border-b border-green-500 rounded">
              <label class="pl-6 block text-gray-700 text-sm font-bold tracking-widest mb-2" for="firstname">
                lastname :
                </label>
              <li class=" w-2/3 font-bold py-2 pl-4 sm:pl-auto uppercase mb-2 text-gray-700 tracking-widest leading-tight  ">
                {{$student->profile->lastname}}
              </li>
              </div>
              <div class="mb-6 sm:flex sm:justify-between sm:items-center shadow appearance-none border-b border-green-500 rounded">
                <label class="pl-6 block text-gray-700 text-sm font- tracking-widest mb-2" for="firstname">
                  nationality :
                  </label>
                <li class=" w-2/3 font-bold font-monospace py-2 pl-4 sm:pl-auto uppercase mb-2 text-gray-700 tracking-widest leading-tight  ">
                  {{$student->profile->country}}
                </li>
                </div>
                <div class="mb-0 sm:flex sm:justify-between sm:items-center shadow appearance-none border-b border-green-500 rounded">
                  <label class="pl-6 block text-gray-700 text-sm font- tracking-widest mb-2" for="firstname">
                    phone number :
                    </label>
                  <li class=" w-2/3 font-bold font-monospace py-2 pl-4 sm:pl-auto uppercase mb-2 text-gray-700 tracking-widest leading-tight  ">
                    {{$student->profile->phone}}
                  </li>
                  </div>
          </ul>
            
    @endif
  </div>
 
@endsection