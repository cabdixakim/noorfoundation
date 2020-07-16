@extends('layouts.profileMaster')
@section('content')
<!-- component -->
<div class="w-full max-w-xs sm:max-w-full sm:flex sm:mt-5">

    <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 ml-16 sm:m-auto sm:w-2/5 " action="{{route('sponsor.update', $sponsor->username)}}" method="POST">
      @method('PATCH')
      @csrf
      
     
      <div class="mb-6">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="firstname">
          firstname
        </label>
        <input class="shadow appearance-none border border-red-500 rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" value="{{old('firstname', $sponsor->profile->firstname)}}" name="firstname" type="text" placeholder="abdihakim">
       @error('firstname')
         <p class="text-red-500 text-xs italic">Please choose first name.</p>
        @enderror
      </div>
      <div class="mb-6">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="middlename">
          middlename
        </label>
        <input class="shadow appearance-none border border-red-500 rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"value="{{old('middlename', $sponsor->profile->middlename)}}"  name="middlename" type="text" placeholder="salan">
        @error('middlename')
        <p class="text-red-500 text-xs italic">Please choose a middle name.</p>
        @enderror
            
      </div>
      <div class="mb-6">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="lastname">
          lastname
        </label>
        <input class="shadow appearance-none border border-red-500 rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" value="{{old('lastname',$sponsor->profile->lastname)}}" name="lastname" type="text" placeholder="noor">
       @error('lastname')
       <p class="text-red-500 text-xs italic">Please choose last name.</p>
       @enderror
           
      </div>
      <div class="mb-6">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="country">
          country               

        </label>
        <select name="country" id="CountrySelect" class="shadow appearance-none border border-red-500 rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline">
          <option value="">Please choose a country </option>
             @foreach ($allCountries as $countryName=>$countryCode)
              <option class="shadow appearance-none border border-red-500 rounded w-1/2 py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" value="{{$countryName.'|'.$countryCode}}" {{old('country') == $countryName.'|'.$countryCode ? 'selected' : ''}}  type="text" placeholder="somalia" > {{$countryName}} </option>
              @endforeach
        </select>
        
        @error('country')
        <p class="text-red-500 text-xs italic">Please choose a country.</p>
         @enderror    
      </div>
      <div class="mb-6">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="phone">
          phone
        </label>
        <input class="shadow appearance-none border border-red-500 rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"value="{{old('phone',$sponsor->profile->phone)}}"   name="phone" type="tel" placeholder="+252615430925">
         @error('phone')
          <p class="text-red-500 text-xs italic">{{$message}}</p>
          @enderror
            
      </div>
      <div class="flex items-center justify-between">
        <button class="bg-blue-500 hover:bg-blue-700 sm:text-white font-bold py-2 whitespace-no-wrap px-4 rounded focus:outline-none focus:shadow-outline hover:bg-blue-600" type="submit">
         Update
        </button>
      </div>
    </form>
  </div>
 
@endsection