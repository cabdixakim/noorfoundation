@extends('layouts.app')

@section('content')
@push('styles')
    <style>
        
    </style>
@endpush

<ul id="orders" class=" sm:w-3/5 sm:ml-64 ">
	
      @foreach ($payments  as $key=>$payment)
      
      <li data-id="{{$payment->id}}" class="mb-3 sm:p-4 flex justify-center  list-none mt-8 border bg-gray-200 ">
        <!-- <p class="get-company"> </p> -->
      <span class=" hidden sm:block mr-20">{{$key}} .</span>
         <span class="read-status mr-1 sm:pr-16  border-r sm:border-none border-gray-500 font-lg font-mono font-bold">{{$payment->status}}</span>
      <a href="{{$payment->receipt->url ?? '#'}}" id="the_order " class="sm:pr-16  border-gray-500 border-r text-blue-800 sm:border-none font-bold sm:text-lg sm:track-widest">{{'payment details'}}<i class=" hidden sm:block fa fa-eye" aria-hidden="true"></i></a>
      
      <select required class="name delivery_selector sm:mr-8  sm:p-2 border-gray-500 border-r sm:border-none">
          <option value="" disabled selected hidden >select status </option>
          <option value="confirmed " >confirmed </option>
         <option value="delivered" >delivered  </option>

      </select>
      {{-- <!--<input type="hidden" name="co" class="name" value="{{delivery_company}} "> --> --}}
      <button type="submit" value="assign delivery company" class="saveEdit outline-none text-sm border-blue rounded-lg px-2 shadow transparent bg-blue-500 hover:bg-blue-700 pl-2 text-gray-100"> <p>update</p> </a>
       
      </li>
      @endforeach
		   
           
		    
            </ul>
     @push('scripts')
         <script>
                $(document).ready(function(){
                    $('.saveEdit').on('click',function(e){
                        e.preventDefault();
                        var $li = $(this).closest('li');
                        var $id = $li.attr('data-id');
                        var $val = $li.find('select.name').val();
                        //var $co = $li.find('input.name').val();
                        var $updated = {
                    
                                     "status":  $val
                            };

                        $final_status = $li.find('span.read-status').html();
                        if($final_status != 'delivered'){
                        
                            $.ajax({
                            type:"PUT",
                            url:"/Admin/adminpayments/"+$id,
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: $updated,
                            success: function(data){
                                console.log(data.sponsor.profile);
                                $li.find('span.read-status').html(data.status);
                                if(data.status == 'delivered'){
                                   $(this).html('delivered');
                                    
                                 }
                                
                                            
                            },
                            error: function(error){
                                console.log('error occured'+ error)
                            }
                            });
                        } else if($final_status == 'delivered'){
                            $(this).html('delivered');
                            
                        }
                });
                });
        </script>
     @endpush

@endsection
