<?php

namespace App\Http\Controllers\Admin;

use App\Sponsor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SponsorSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $allSponsors = Sponsor::with(['profile'])->get();
                $bannedSponsors = Sponsor::onlyTrashed()->get();
                //  dd($allSponsors[0]->plansetting->status);
                return view('admin.adminsponsors',compact('allSponsors','bannedSponsors'));
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
        if (auth()->user()->user_type == 'admin') {
            $sponsor = Sponsor::withTrashed()->find($id);
            if($sponsor->deleted_at == null){
                $sponsor->delete();
                return redirect()->back()->with('status', $sponsor->username.' is now banned');
            } else {
               $sponsor->restore();
               return redirect()->back();
            }
         }  
    }
}
