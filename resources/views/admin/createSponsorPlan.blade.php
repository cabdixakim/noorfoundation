@extends('layouts.app')
@section('content')
<!-- component -->
@if (session('status'))
<div class="flex justify-center items-center ">
  <div class="alert alert-success sm:w-1/5  " role="alert">
    {{ session('status') }} 
</div>
@endif
</div>

<div class="w-full max-w-xs mt-18 sm:max-w-full sm:flex ">
<form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 ml-16 sm:m-auto sm:w-1/5 " action="{{route('sponsor-plan.store')}}" method="POST">
        
          @csrf

          <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="sponsor">
              sponsor
            </label>
            <select  class="shadow appearance-none border border-red-500 rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"   name="sponsor_id">
              <option value="">choose a sponsor</option>
              @foreach ($sponsors as $sponsor)
              
                  <option id="sponsor"  value="{{$sponsor->id}}"  type="text" placeholder="Abdihakim" {{old('sponsor_id') == $sponsor->id ? 'selected' : ''}} >{{$sponsor->username}}</option>                  
              @endforeach
            </select>
            @error('sponsor_id')
            <p class="text-red-500 text-xs italic">Dooro qofka bixinayo</p>
            @enderror
                
          </div>
         
   
          <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="amount_required">
              lacagta laga rabo inuu bixiyo
            </label>
            <input class="shadow appearance-none border border-red-500 rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"value="{{old('amount_required')}}"   name="amount_required" type="number" placeholder="">
             @error('amount_required')
              <p class="text-red-500 text-xs italic">lacagta aa bixin laheyd geli</p>
              @enderror   
          </div>
          
          <div class="flex items-center justify-between">
            <button class="bg-green-400  sm:text-gray-100 font-bold py-2 whitespace-no-wrap px-4 rounded focus:outline-none focus:shadow-outline hover:bg-green-600" type="submit">
              Save
            </button>
          </div>
        </form>
      </div>
   
 
@endsection