<?php

namespace App\Http\Controllers\Admin;

use App\Student;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PragmaRX\Countries\Package\Countries;
use App\Http\Requests\CreateProfileRequest;
use Illuminate\Support\Str;

class EditStudentController extends Controller
{
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
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateProfileRequest $request)
    {
        //
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
        $countries = new Countries();

        $allCountries = $countries->all()->pluck('cca2','name.common');
        
        $student = Student::findOrFail($id);
        $student->load('profile');
        return view('admin.updateStudentProfile', compact('student','allCountries'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateProfileRequest $request, $id)
    {
        //
    //    dd($request->validated);
        $list = Str::of($request->country)->explode('|')->first();
        // dd($list->last());
        $request->merge(['country'=>$list] );
        
        $sponsor = Student::findOrFail($id);
       
        $data = $request->except('_token','_method'); 
        if($sponsor->profile){
            $sponsor->profile()->update($data);
            return redirect()->action('Admin\EditStudentController@edit',[$id])->with('status','profile updated successfully');
        } else{
            $sponsor->profile()->create($data);
            return redirect()->action('Admin\EditStudentPlanController@edit',[$id])->with('status', 'Student profile added successfully');
        }
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
