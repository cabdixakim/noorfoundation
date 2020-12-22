<?php

namespace App\Http\Controllers\Admin;

use App\Sponsor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use PragmaRX\Countries\Package\Countries;
use Illuminate\Support\Str;
use App\Http\Requests\CreateProfileRequest;


class EditSponsorController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth','verified','admin']);
 
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
        
        $sponsor = Sponsor::findOrFail($id);
        $sponsor->load('profile');
        return view('admin.updateSponsorProfile', compact('sponsor','allCountries'));
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
        $list = Str::of($request->country)->explode('|')->first();
        // dd($list->last());
        $request->merge(['country'=>$list] );
        
        $sponsor = Sponsor::findOrFail($id);
       
        $data = $request->except('_token','_method'); 
        if($sponsor->profile){
            $sponsor->profile()->update($data);
            return redirect()->action('Admin\EditSponsorController@edit',[$id])->with('status','profile updated successfully');
        } else{
            $sponsor->profile()->create($data);
            return redirect()->action('SponsorsListController@index')->with('status', 'sponsor profile added successfully');
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
