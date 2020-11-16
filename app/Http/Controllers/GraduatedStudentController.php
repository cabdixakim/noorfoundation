<?php

namespace App\Http\Controllers;

use App\Student;
use Carbon\Carbon;
use App\GraduatedStudent;
use Illuminate\Http\Request;

class GraduatedStudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $students = Student::with(['profile','plan'])->orderBy('created_at', 'desc')->get();
        $graduatedStudents = GraduatedStudent::latest()->get();
        $graduated = collect([]);
        
        foreach ($students as $student) {
            if($student->plan->graduation_date < Carbon::now()){

                $graduated->push($student);
            }
           
        }
        foreach ($graduatedStudents as $student) {
            $graduated->push($student);
        }
    //   foreach ($graduated as $key => $value) {
    //      dd($key);
    //   }
             return view('student.studentslist', compact('graduated'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        
        return view('student.createGraduatedStudentProfile');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //;
        $data = $request->validate([
            'firstname'=> 'required',
            'middlename'=> 'required',
            'lastname'=> 'required',
            'university'=> 'required',
            'faculty'=> 'required',
            'start_date'=> 'required',
            'graduation_date'=> 'required',

        ]);
        GraduatedStudent::create($data);
        return redirect('/') ;
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
