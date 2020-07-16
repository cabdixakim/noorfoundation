<?php

namespace App\Http\Controllers;

use App\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TranscriptController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware(['auth','verified']);

 
    }

    public function index()
    {
        //
        // if(Auth::check()){
        //     if(auth()->user()->user_type == 'student'){
        //          $user = auth()->id();
        //          $student = Student::findOrFail($user);
        //          $transcripts = $student->transcripts;
        //          foreach ($transcripts as $key => $transcript) {
        //              # code...
        //              if(!empty($transcript->getFirstMediaUrl('transcripts'))){
        //                 if($transcript->getMedia('transcripts')[0]->hasGeneratedConversion('thumb')){
        //                    $url = $transcript->getFirstMediaUrl('transcripts','thumb');
        //                 }  else {
        //                     $url = $transcript->getFirstMediaUrl('transcripts');
        //                 }
        //              } else {
        //                 $url = null;
        //             }
        //          }
        //     }
        //     return redirect('/');

        // }
        
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('student.transcript');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(auth()->check()){
            $user = auth()->user();
        }
        // dd($request->all());
        $data = $request->validate([
            'description' => ['required', 'string', 'min:20', 'max:150'],
            'photo' => 'required',
        ]);
        
        if($user->user_type == 'student'){
            $student = Student::findOrFail($user->id);
            $result = $student->transcripts()->create(['description'=> $data['description']]);
            $result->addMediaFromRequest('photo')->toMediaCollection('transcripts','s3');
            return redirect(route('student.index'));
        } else {
            return redirect('/');
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
