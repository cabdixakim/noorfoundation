<?php

namespace App;

use App\User;
use Carbon\Carbon;

class Student extends User{
  
  use \Parental\HasParent;
  
 
  public function profile()
  {
    return $this->hasOne(StudentProfile::class);
  }

  public function plan()
  {
    return $this->hasOne(Plan::class);
  }
  public function planSetting()
  {
    return $this->hasOne(PlanSetting::class);
  }

  public function transcripts()
  {
     return $this->hasMany(Transcript::class)->latest();
  }
  public function studentreceipts()
  {
     return $this->hasMany(StudentReceipt::class)->latest();
  }


  public function withdrawals()
  {
    # code...
    return $this->hasMany(Withdraw::class, 'user_id')->latest();
  }

  public function CurrentSemesterCredit()
  {
    # code...
    if ($this->plan) {
      if($this->goal() < $this->plan->amount_per_semester){
        
        return $this->plan->amount_per_semester - $this->goal();
        
      }

    }
  }

  public function goal()
  {
     if($this->plan){
    return $this->withdrawals()->where(function($q){
      $q->where('semester',$this->plan->semester);
      $q->whereBetween( 'created_at',[new Carbon($this->plan->semester_start), new Carbon($this->plan->semester_end)]);
    })->sum('amount');
  }
    
  }
  public function HasNotReachedGoal(){
    
    if ($this->plan) {
      return $this->goal() < $this->plan->amount_per_semester ;
    }
  }

  public function HasNotGraduated(){
    if ($this->plan) {
      $grad_date = Carbon::parse($this->plan->graduation_date)->addMonths(1)->format('y-m');
      return  $grad_date > Carbon::now()->format('y-m');
    }
  }
  public function SemesterDidNotEnd(){
    if ($this->plan) {
      $sem_end = Carbon::parse($this->plan->semester_end)->addMonths(1)->format('y-m');
      return  $sem_end > Carbon::now()->format('y-m');
    }
  }

}