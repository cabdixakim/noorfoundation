@extends('layouts.profileMaster')
  
@section('content')    
{{-- start of plan form --}}
<!-- component -->
@if (session('status'))
<div class="flex justify-center items-center ">
  <div class="alert alert-success   mb-8 mt-5" role="alert">
    {{ session('status') }}
</div>
</div>
@endif
<div class="mt-16 flex justify-center items-center">
<form class="bg-white shadow-md rounded px-8 pt-6 pb-8  mt-20 " action=" {{route('register-year.store')}}" method="POST">
         
          @csrf
    
          <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="year">
              Sanadka lacag bixintiisa lagu jiro
            </label>
            <div class="flex items-start ">
              <input data-provide="datepicker" data-date-format="yyyy" data-date-min-view-mode="2" class="shadow appearance-none border border-red-500 rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" value="{{old('year')}}" name="year" type="text" placeholder="2020">
              <span class=""><i class="far fa-calendar-alt fa-2x  ml-2 h-full"></i></span>
            </div>
    
           @error('year')
           <p class="text-red-500 text-xs italic">fadlan dooro sanadka lagu jiro</p>
           @enderror
               
          </div>
       
          <div class="flex items-center sm:justify-between">
            <button class="bg-blue-500 hover:bg-blue-700 sm:text-white font-bold py-2 whitespace-no-wrap px-4 rounded focus:outline-none focus:shadow-outline hover:bg-blue-600" type="submit">
                 Register year
            </button>
          </div>
        </form>
      </div>
      {{-- end of plan form --}} 
      


@endsection