<?php

namespace App;

use App\User;
use Carbon\Carbon;

class Sponsor extends User{
  
  use \Parental\HasParent;
  
  protected $dateStart;
  protected $dateEnd;
 
  public function profile()
  {
    return $this->hasOne(SponsorProfile::class);
  }
  public function RecordDeposits()
  {
    # code... 
    return $this->hasMany(RecordDeposit::class,'user_id')->latest();
  }
  public function SponsorPlan()
  {
      return $this->hasOne(SponsorPlan::class);
  }
  public function deposits()
  {
    return $this->hasMany(Deposit::class,'user_id')->latest();
  }

  public function LastFourMonths()
  {
     $this->dateStart = Carbon::now()->subMonths(4);
     $this->dateEnd = Carbon::now();
    return $this->deposits()->where(function($q){
      $q->whereBetween( 'created_at',[$this->dateStart , $this->dateEnd]);
    })->sum('amount');
}

public function annualDeposits()
{
     if(RegisterYear::first()){
           $year = RegisterYear::first()->year;
           return $this->deposits()->where(Carbon::parse('created_at')->format('Y'), $year)->sum('amount');
     } else {
         return $this->deposits()->where(Carbon::parse('created_at', Carbon::now()->format('Y-m-d H:i:s')))->sum('amount');
     }
}

// public function SponsoredStudents()
// {
  
//                 $sponsoredstudents = [];
//                 $payments = $this->payments;
//                 foreach ($payments as $key => $value) {
//                     if (!in_array($value->student, $sponsoredstudents)) {
//                         # code...
//                         $sponsoredstudents[] = $value->student;
//                     }
//                 }
//                 return count($sponsoredstudents);

// }

// public function listStudents()
// {
//    return $this->with('payments.student.profile')->get();
// }

}