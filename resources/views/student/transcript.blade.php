@extends('layouts.profileMaster')
@section('content')
<!-- component -->

<div class="max-w-full flex justify-center mt-8">
  @if (session('status'))
  <div class="alert alert-success sm:w-2/5 mb-0 mt-5" role="alert">
    {{ session('status') }}
</div>
@endif
</div>
<div class="w-full mt-5 max-w-xs sm:max-w-full sm:flex sm:mt-5">

<form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 ml-16 sm:m-auto sm:w-2/5 " action="{{route('transcript.store')}}" enctype="multipart/form-data" method="post">
    @csrf
      <div class="mb-6">
        <div class="mb-6">
          <label class="block text-gray-700 text-sm font-bold mb-2" for="description">
            Add small details about the exam
          </label>
          <textarea class="shadow appearance-none border border-red-500 rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"  name="description" type="text" placeholder="like the date of exam...and type">{{Request::old('description')}}</textarea>
         @error('description')
           <p class="text-red-500 text-center text-xs italic">{{$message}}</p>
          @enderror
        </div>
        <div class="mb-2 text-center">
           
          <label 
            for="fileInput"
            type="button"
            class=" sm:mr-0 cursor-pointer inine-flex justify-between items-center focus:outline-none border py-2 px-4 rounded-lg shadow-sm text-left text-gray-600 bg-white hover:bg-gray-100 font-medium"
          >
            <svg xmlns="http://www.w3.org/2000/svg" class="inline-flex flex-shrink-0 w-6 h-6 -mt-1 mr-1" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
              <rect x="0" y="0" width="24" height="24" stroke="none"></rect>
              <path d="M5 7h1a2 2 0 0 0 2 -2a1 1 0 0 1 1 -1h6a1 1 0 0 1 1 1a2 2 0 0 0 2 2h1a2 2 0 0 1 2 2v9a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-9a2 2 0 0 1 2 -2" />
              <circle cx="12" cy="13" r="3" />
            </svg>						
            Browse for files
          </label>
    
          <div class="mx-auto w-48 text-gray-500 text-xs text-center mt-1">Add Result File</div>
          @error('photo')
           <p class="text-red-500 text-xs italic">{{$message}}</p>
          @enderror
    
        <input name="photo" id="fileInput"  class="hidden" type="file" onchange="" >
        <div class="flex items-center justify-between mt-0">
          <button class="bg-blue-400 hover:bg-blue-500 text-gray-100 sm:text-gray-100 font-bold py-2 whitespace-no-wrap mx-auto mt-8 px-4 rounded focus:outline-none focus:shadow-outline hover:bg-blue-600" type="submit">
           Add Result 
          </button>
        </div>
        </div>
      
 
  </form>
</div>
  
      @push('scripts')
          <script>
            function DisplayAvatar(e){
                 var image = document.getElementById('image');
                 image.src = URL.createObjectURL(e.target.files[0]);
              }
          </script>
      @endpush
@endsection