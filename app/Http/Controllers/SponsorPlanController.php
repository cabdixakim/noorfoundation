<?php

namespace App\Http\Controllers;

use App\User;
use App\Deposit;
use App\RecordDeposit;
use App\RegisterYear;
use App\Sponsor;
use Carbon\Carbon;
use App\SponsorPlan;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SponsorPlanController extends Controller
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
        
        
        $sponsors = Sponsor::all();
      
        return view('admin/createSponsorPlan',compact('sponsors'));
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
             'sponsor_id'=> 'required',
             'amount_required'=> 'required'
        ]);
                $sponsor = Sponsor::findOrFail($data['sponsor_id']);
        if(!$sponsor->SponsorPlan){

                $sponsor->SponsorPlan()->create([
                'amount_required_annually' => $data['amount_required'],
                ]);
        } else {
                $sponsor->SponsorPlan()->update([
                'amount_required_annually' => $data['amount_required'],
                ]);
            }
            
           $nowYear = Carbon::now()->format('Y');
            if( $sponsor->deposits && $data['amount_required']  <= $sponsor->deposits()->where('year', $nowYear)->sum('amount')){
        
        $sponsor->RecordDeposits()->updateOrCreate(['user_id'=>$sponsor->id, 'year'=>$nowYear ],[
            'year' =>$nowYear,
            'total' => $sponsor->deposits()->where('year', $nowYear)->sum('amount'),
            'annual_deposits' => ($sponsor->deposits()
            ->where('year',$nowYear)->get() != NULL) ? $sponsor->deposits()
            ->where('year',$nowYear)->sum('amount') : 0 ,
            'balance' =>NULL,
        ]); 
        
    } else 
        if($sponsor->deposits){

            $sponsor->RecordDeposits()->updateOrCreate(['user_id'=>$sponsor->id, 'year'=>$nowYear ],[
                'year' =>$nowYear,
                'total' => NULL,
                'annual_deposits' => ($sponsor->deposits()
                ->where('year',$nowYear)->get() != NULL) ? $sponsor->deposits()
                ->where('year',$nowYear)->sum('amount') : 0 ,
                'balance' =>($sponsor->RecordDeposits()->where('user_id', $sponsor->id)
                        ->value('year') ==$nowYear) ? 
                            $data['amount_required'] - $sponsor->deposits()->where('year',$nowYear)->sum('amount'): 
                            $data['amount_required'],
            ]); 
    } 

return redirect()->back()->with('status', 'plan added successfully');
}

/**
     * Display the specified resource.
     *
     * @param  \App\SponsorPlan  $sponsorPlan
     * @return \Illuminate\Http\Response
     */
    public function show(SponsorPlan $sponsorPlan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SponsorPlan  $sponsorPlan
     * @return \Illuminate\Http\Response
     */
    public function edit(SponsorPlan $sponsorPlan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SponsorPlan  $sponsorPlan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SponsorPlan $sponsorPlan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SponsorPlan  $sponsorPlan
     * @return \Illuminate\Http\Response
     */
    public function destroy(SponsorPlan $sponsorPlan)
    {
        //
    }
}
