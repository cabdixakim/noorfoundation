<?php

namespace App\Http\Controllers;

use App\Sponsor;
use Carbon\Carbon;
use App\RegisterYear;
use App\RecordDeposit;
use Illuminate\Http\Request;

class RecordDepositController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','verified',]);
        $this->middleware(['admin'])->except('index');
 
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $sponsors_who_paid_in_full = array();
        $sponsors_with_a_balance = array();
        $current_date = Carbon::now()->format('Y-m-d H:i:s');
    
        $year = (RegisterYear::first()) ? RegisterYear::first()->year : Carbon::now()->format('Y') ;
        $sponsors = Sponsor::with(['deposits'=>function($q) use($year){
            $q->where('year','=',$year );
        }])->get();
        // dd($sponsors); 
       
        
        foreach ($sponsors as $sponsor) {
           if($sponsor->SponsorPlan ){
            if( $sponsor->SponsorPlan->amount_required_annually  <= $sponsor->deposits->sum('amount')){
                //  $sponsors_who_paid_in_full += [$sponsor->username => $sponsor->deposits->sum('amount')];
                  $sponsor->RecordDeposits()->updateOrCreate(['user_id'=>$sponsor->id, 'year'=> $year,],[
                         'year' => $year,
                         'total' => $sponsor->deposits->sum('amount'),
                         'balance' => NULL,
                 ]);
            } else {
                if($sponsor->deposits){
                    $sponsor->RecordDeposits()->updateOrCreate(['user_id'=>$sponsor->id, 'year'=> $year],[
                       'year' => $year,
                       'total' => NULL,
                       'balance' => ($sponsor->SponsorPlan) ? $sponsor->SponsorPlan->amount_required_annually - $sponsor->deposits->sum('amount'): NULL - $sponsor->deposits->sum('amount'),
                     ]);           
                }
         }
        }
    }
        $records_full = RecordDeposit::with('sponsor')->where('balance', NULL)->
                                                        orderBy('year','desc')->get()->groupBy('year');
        $records_balance = RecordDeposit::with('sponsor') ->where('total', NULL)
                                                        ->orderBy('year','desc')
                                                        ->get()->groupBy('year');
       
        return view('admin/listRecords', compact(['records_full', 'records_balance']));
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
     * @param  \App\RecordDeposit  $recordDeposit
     * @return \Illuminate\Http\Response
     */
    public function show(RecordDeposit $recordDeposit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\RecordDeposit  $recordDeposit
     * @return \Illuminate\Http\Response
     */
    public function edit(RecordDeposit $recordDeposit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\RecordDeposit  $recordDeposit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RecordDeposit $recordDeposit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\RecordDeposit  $recordDeposit
     * @return \Illuminate\Http\Response
     */
    public function destroy(RecordDeposit $recordDeposit)
    {
        //
    }
}
