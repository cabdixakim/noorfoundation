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
  public function payments()
  {
    return $this->hasMany(Payment::class,'user_id');
  }

  public function LastFourMonths()
  {
     $this->dateStart = Carbon::now()->subMonths(4);
     $this->dateEnd = Carbon::now();
    return $this->payments()->where(function($q){
      $q->whereBetween( 'created_at',[$this->dateStart , $this->dateEnd]);
    })->sum('amount');
}

public function SponsoredStudents()
{
  
                $sponsoredstudents = [];
                $payments = $this->payments;
                foreach ($payments as $key => $value) {
                    if (!in_array($value->student, $sponsoredstudents)) {
                        # code...
                        $sponsoredstudents[] = $value->student;
                    }
                }
                return count($sponsoredstudents);

}

public function listStudents()
{
   return $this->with('payments.student.profile')->get();
}

}