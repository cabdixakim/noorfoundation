<?php

namespace App\Http\Controllers;

use App\Student;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use PragmaRX\Countries\Package\Countries;
use App\Http\Requests\CreateProfileRequest;

class StudentController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth','verified']);
        // $this->middleware('sponsor')->only('show');
        $this->middleware('admin')->only('destroy');
 
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user = auth()->user();
        if ($user->user_type == 'student') {
            $student = Student::findOrFail($user->id);
            $student->load('profile','withdrawals','plan');
            $transcripts = $student->transcripts;
            $receipts = $student->studentreceipts;

            if(!empty($student->getFirstMediaUrl('avatar'))){
            if($student->getMedia('avatar')[0]->hasGeneratedConversion('thumb')){
                 $avatar = $student->getFirstMediaUrl('avatar', 'thumb');
            } else {
                $avatar = $student->getFirstMediaUrl('avatar');
            }
        } else {
            $avatar = null;
        }
           return view('profiles.StudentProfile',compact('student','avatar', 'transcripts','receipts'));
        } 
        return redirect('/');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $countries = new Countries();

        $allCountries = $countries->all()->pluck('cca2','name.common');
        
        $user = auth()->user();
        $student = Student::findOrFail($user->id);
        $student->load('profile');
        return view('student.createProfile', compact('student','allCountries'));
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
        $list = Str::of($request->country)->explode('|')->first();
        // dd($list->last());
        $request->merge(['country'=>$list] );
        
        $user = auth()->user()->id;
        $student = Student::findOrFail($user);
        $data = $request->all(); 

        if(!$student->profile){
            $student->profile()->create($data);
            if (!$student->plan) {
                return redirect()->route('plan.create')->with('status','Profile added successfully. Now add a Plan');
            } else {
                return redirect()->back()->with('status','profile added successfully');
            }
        } else{
            return redirect()->back();
        }
 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        //
        if(!$student){
            $student = auth()->user()->id;
         }
         $student->load('profile','withdrawals','plan','transcripts');
         $transcripts = $student->transcripts;
         $receipts = $student->studentreceipts;

            if(!empty($student->getFirstMediaUrl('avatar'))){
            if($student->getMedia('avatar')[0]->hasGeneratedConversion('thumb')){
                 $avatar = $student->getFirstMediaUrl('avatar', 'thumb');
            } else {
                $avatar = $student->getFirstMediaUrl('avatar');
            }
        } else {
            $avatar = null;
        }
         return view('profiles.StudentProfile', compact('student','avatar','transcripts','receipts'));
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
        
        $user = auth()->user();
        $student = Student::findOrFail($user->id);
        $student->load('profile');
        return view('student.updateProfile', compact('student','allCountries'));
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
        $list = Str::of($request->country)->explode('|')->first();
        // dd($list->last());
        $request->merge(['country'=>$list] );
        
        $user = auth()->user()->id;
        $student = Student::findOrFail($user);
        $data = $request->except('_token','_method'); 
         
        if($student->profile){
            $student->profile()->update($data);
            return redirect()->action('StudentController@create')->with('status','profile updated successfully');
        } else{
            return redirect()->action('StudentController@create');
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
        if (auth()->user()->user_type == 'admin') {
           $student = Student::withTrashed()->find($id);
           if($student->deleted_at == null){
               $student->delete();
               return redirect()->back()->with('status', $student->username.' is now banned');
           } else {
              $student->restore();
              return redirect()->back();
           }
        }                                                     
    }
}
