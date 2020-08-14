<?php

namespace App\Http\Controllers;

use App\Sponsor;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use PragmaRX\Countries\Package\Countries;
use App\Http\Requests\CreateProfileRequest;

class SponsorController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth','verified','sponsor']);
 
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
        if ($user->user_type == 'sponsor') {
            $sponsor = Sponsor::findOrFail($user->id);
            $sponsor->load('profile','deposits');
        
            if(!empty($sponsor->getFirstMediaUrl('avatar'))){
            if($sponsor->getMedia('avatar')[0]->hasGeneratedConversion('thumb')){
                 $avatar = $sponsor->getFirstMediaUrl('avatar', 'thumb');
            } else {
                $avatar = $sponsor->getFirstMediaUrl('avatar');
            }
        } else {
            $avatar = null;
        }
           return view('profiles.SponsorProfile',compact('sponsor','avatar'));
        }
        // return redirect('/');
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
        $sponsor = Sponsor::findOrFail($user->id);
        $sponsor->load('profile');
        return view('sponsor.createProfile', compact('sponsor','allCountries'));
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
        $sponsor = Sponsor::findOrFail($user);
        $data = $request->all(); 

        if(!$sponsor->profile){
            $sponsor->profile()->create($data);
            if(empty($sponsor->getFirstMediaUrl('avatar'))){
                return redirect()->route('avatar.create')->with('status', 'Profile added successfully! please add a profile picture');
                } else {
                    return redirect()->route('student.index');
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
    public function show(Sponsor $sponsor)
    {
        //
        if(!$sponsor){
            $sponsor = auth()->user()->id;
         }
         $sponsor->load('profile','deposits');

            if(!empty($sponsor->getFirstMediaUrl('avatar'))){
            if($sponsor->getMedia('avatar')[0]->hasGeneratedConversion('thumb')){
                 $avatar = $sponsor->getFirstMediaUrl('avatar', 'thumb');
            }  else {
                $avatar = $sponsor->getFirstMediaUrl('avatar');
            }
        } else {
            $avatar = null;
        }
         return view('profiles.SponsorProfile', compact('sponsor','avatar'));
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
        $sponsor = Sponsor::findOrFail($user->id);
        $sponsor->load('profile');
        return view('sponsor.updateProfile', compact('sponsor','allCountries'));
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
        $sponsor = Sponsor::findOrFail($user);
       
        $data = $request->except('_token','_method'); 
         
        if($sponsor->profile){
            $sponsor->profile()->update($data);
            return redirect()->action('SponsorController@create')->with('status','profile updated successfully');
        } else{
            return redirect()->action('SponsorController@create');
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
