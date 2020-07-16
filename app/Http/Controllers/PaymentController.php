<?php

namespace App\Http\Controllers;

use App\Payment;
use App\Sponsor;
use App\Student;
use Illuminate\Http\Request;
use App\Http\Requests\CreatePaymentRequest;
use App\Jobs\GenerateReceipt;

class PaymentController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth','sponsor','verified']);

 
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $students = Student::all();
        return view('sponsor.payment',compact('students'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePaymentRequest $request)
    {
        //
        $user = auth()->user();
        if ($user->user_type == 'sponsor') {
             $sponsor = Sponsor::findOrFail($user->id);
            $payment = $sponsor->payments()->create($request->all());
            if($payment){
              GenerateReceipt::dispatch($payment);
              return redirect()->back()->with('status', 'payment was successful');
            }
              
        } else {
            return redirect()->route('student.index');
        }
       
      
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
