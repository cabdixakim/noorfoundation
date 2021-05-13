<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\RegisterYear;
use Illuminate\Http\Request;

class RegisterYearController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','verified', 'admin']);
 
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
        return view('admin/createRegisterYear');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $data = $request->validate([
             'year'=> 'required',
        ]);
        RegisterYear::updateOrCreate(['id'=>(RegisterYear::first()) ? RegisterYear::first()->id : '1'],[
           'year'=> $data['year'],
           'created_at'=> Carbon::now()->format('Y-m-d H:i:s')
        ]);
        return redirect()->back()->with('status', 'year updated successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\RegisterYear  $registerYear
     * @return \Illuminate\Http\Response
     */
    public function show(RegisterYear $registerYear)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\RegisterYear  $registerYear
     * @return \Illuminate\Http\Response
     */
    public function edit(RegisterYear $registerYear)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\RegisterYear  $registerYear
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RegisterYear $registerYear)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\RegisterYear  $registerYear
     * @return \Illuminate\Http\Response
     */
    public function destroy(RegisterYear $registerYear)
    {
        //
    }
}
