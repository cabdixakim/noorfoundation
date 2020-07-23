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
<form action="{{route('avatar.store')}}" enctype="multipart/form-data" method="post">
    @csrf
    <div class="py-10 sm:ml-2 ml-24 sm:mt-auto mt-16 sm:w-auto w-1/2">	
      <div >
        <div class="mb-5 text-center">
          <div class="mx-auto w-32 h-32 mb-2 border rounded-full relative bg-gray-100 mb-4 shadow-inset">
            <img id="image" class="object-cover w-full h-32 rounded-full"  src="{{ $avatar ??  asset('defaultImage\default.png') }}"/>
          </div>
          
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
            Browse Photo
          </label>
    
          <div class="mx-auto w-48 text-gray-500 text-xs text-center mt-1">Click to add profile picture</div>
    
        <input name="photo" id="fileInput"  class="hidden" type="file" onchange="DisplayAvatar(event)" >
        <div class="flex items-center justify-between">
          <button class="bg-blue-400 hover:bg-blue-500 text-gray-100 sm:text-gray-100 font-bold py-2 whitespace-no-wrap mx-auto mt-8 px-4 rounded focus:outline-none focus:shadow-outline hover:bg-blue-600" type="submit">
           Add profile picture
          </button>
        </div>
        </div>
  </form>
  
      @push('scripts')
          <script>
            function DisplayAvatar(e){
                 var image = document.getElementById('image');
                 image.src = URL.createObjectURL(e.target.files[0]);
              }
          </script>
      @endpush
@endsection