<?php

namespace App\Http\Controllers;

use App\Sponsor;
use App\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AvatarController extends Controller
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
        
        if(Auth::check()){
            if(auth()->user()->user_type == 'student'){
                $user = auth()->id();
                $student = Student::findOrFail($user);
               
                 if(!empty($student->getFirstMediaUrl('avatar'))){
                    if($student->getMedia('avatar')[0]->hasGeneratedConversion('thumb')){
                       $avatar = $student->getFirstMediaUrl('avatar','thumb');
                    } else {
                        $avatar = $student->getFirstMediaUrl('avatar');
                    }
                 } else {
                    $avatar = null;
                }
            } elseif(auth()->user()->user_type == 'sponsor'){
                $user = auth()->id();
                $sponsor = Sponsor::findOrFail($user);
              
                 if(!empty($sponsor->getFirstMediaUrl('avatar'))){
                    if($sponsor->getMedia('avatar')[0]->hasGeneratedConversion('thumb')){
                       $avatar = $sponsor->getFirstMediaUrl('avatar','thumb');
                    } else {
                        $avatar = $sponsor->getFirstMediaUrl('avatar');
                    }
                 } else {
                    $avatar = null;
                }
            }

        }
        
        return view('avatar',compact('avatar'));
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
        if(auth()->check()){
            $user = auth()->user();
        }
         
        if($user->user_type == 'student'){
            $student = Student::findOrFail($user->id);
            if($request->hasFile('photo')){
                $student->addMediaFromRequest('photo')->toMediaCollection('avatar','s3');
                return redirect()->route('student.index');   
            }
             return redirect()->back();
        } elseif($user->user_type == 'sponsor') {
            $sponsor = Sponsor::findOrFail($user->id);
            if ($request->hasFile('photo')) {
                $sponsor->addMediaFromRequest('photo')->toMediaCollection('avatar','s3');
                return redirect()->route('sponsor.index');
            }
            return redirect()->back();
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
