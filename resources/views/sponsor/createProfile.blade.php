@extends('layouts.profileMaster')
@section('content')
<!-- component -->
<div class="flex mt-4 "><p class="text-lg font-bold text-gray-800 m-auto border-b border-green-400"> Profile Information</p> </div>

<div class="w-full max-w-xs sm:max-w-full sm:flex sm:mt-5">
  @if(empty($sponsor->profile))
    <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 ml-16 sm:m-auto sm:w-2/5 " action="{{action('SponsorController@store' )}}" method="post">
    
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
        <label class="block text-gray-700 text-sm font-bold mb-2" for="country">
          country               

        </label>
        <select name="country" id="CountrySelect" class="shadow appearance-none border border-red-500 rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline">
          <option value="">choose a country </option>
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
        <input class="shadow appearance-none border border-red-500 rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"value="{{old('phone')}}"   name="phone" type="tel" placeholder="+252615430925">
         @error('phone')
          <p class="text-red-500 text-xs italic">{{$message}}</p>
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
        <a href="{{route('sponsor.edit', $sponsor->username)}}" class="bg-green-400 text-gray-100 hover:text-gray-100 font-bold py-2 whitespace-no-wrap px-4 rounded focus:outline-none focus:shadow-outline hover:bg-green-600" >
            Update Profile
          </a>
        </div>
         <div class="mb-6 sm:flex sm:justify-between sm:items-center shadow appearance-none border-b border-green-500 rounded">
          <label class="pl-6 block text-gray-700 text-sm font-bold tracking-widest mb-2" for="firstname">
            firstname :
            </label>
          <li class=" w-2/3 font-bold py-2 pl-4 sm:pl-auto uppercase mb-2 text-gray-700 tracking-widest leading-tight  ">
            {{$sponsor->profile->firstname}}
          </li>
          </div>
          <div class="mb-6 sm:flex sm:justify-between sm:items-center shadow appearance-none border-b border-green-500 rounded">
            <label class="pl-6 block text-gray-700 text-sm font-bold tracking-widest mb-2" for="firstname">
              middlename :
              </label>
            <li class=" w-2/3 font-bold py-2 pl-4 sm:pl-auto uppercase mb-2 text-gray-700 tracking-widest leading-tight  ">
              {{$sponsor->profile->middlename}}
            </li>
            </div>
            <div class="mb-6 sm:flex sm:justify-between sm:items-center shadow appearance-none border-b border-green-500 rounded">
              <label class="pl-6 block text-gray-700 text-sm font-bold tracking-widest mb-2" for="firstname">
                lastname :
                </label>
              <li class=" w-2/3 font-bold py-2 pl-4 sm:pl-auto uppercase mb-2 text-gray-700 tracking-widest leading-tight  ">
                {{$sponsor->profile->lastname}}
              </li>
              </div>
              <div class="mb-6 sm:flex sm:justify-between sm:items-center shadow appearance-none border-b border-green-500 rounded">
                <label class="pl-6 block text-gray-700 text-sm font- tracking-widest mb-2" for="firstname">
                  nationality :
                  </label>
                <li class=" w-2/3 font-bold font-monospace py-2 pl-4 sm:pl-auto uppercase mb-2 text-gray-700 tracking-widest leading-tight  ">
                  {{$sponsor->profile->country}}
                </li>
                </div>
                <div class="mb-0 sm:flex sm:justify-between sm:items-center shadow appearance-none border-b border-green-500 rounded">
                  <label class="pl-6 block text-gray-700 text-sm font- tracking-widest mb-2" for="firstname">
                    phone number :
                    </label>
                  <li class=" w-2/3 font-bold font-monospace py-2 pl-4 sm:pl-auto uppercase mb-2 text-gray-700 tracking-widest leading-tight  ">
                    {{$sponsor->profile->phone}}
                  </li>
                  </div>
          </ul>
            
    @endif
  </div>
 
@endsection