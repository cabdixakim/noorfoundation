<?php

namespace App\Http\Controllers;

use App\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\CreatePlanRequest;

class PlanController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth','verified']);
 
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
        $user = auth()->user()->id;
        $student = Student::findOrFail($user);
        $student->load('plan');
        return view('student.createPlan', compact('student'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePlanRequest $request)
    {
        //
        $user = auth()->user()->id;
        $student = Student::findOrfail($user);
        $data = $request->validated();
        if (!$student->plan) {
            # code...
            $student->plan()->create($data);
            $student->plansetting()->update([
                'status'=> 'disabled',
            ]);
            if(empty($student->getFirstMediaUrl('avatar'))){
            return redirect()->route('avatar.create')->with('status', 'Plan added successfully! please add a profile picture');
            } else {
                return redirect()->route('student.index');
            }
        } 
        return redirect()->back();
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
        // dd(auth()->user()->planSetting);
       

            $user = auth()->user()->id;
            $student = Student::findOrFail($user);
            $student->load('plan');
            return view('student.updatePlan', compact('student'));
        
            
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreatePlanRequest $request, $id)
    {
        //

        $user = auth()->user()->id;
        $student = Student::findOrfail($user);
        $data = $request->validated();
        if ($student->plan) {
            # code...
            $student->plan()->update($data);
            return redirect()->action('PlanController@create');
        } else {
            return redirect()->action('PlanController@create');
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
