<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    //mass assignment turned off
    protected $fillable = [
         'student_id', 'amount','semester','status',
    ];

    public function latestPayments()
    {
      # code...
      $this->latest()->get();
    }
    public function sponsor()
    {
       return $this->belongsTo(Sponsor::class,'user_id');
    }
    public function student(){
        return $this->belongsTo(Student::class,'student_id');
    }

    public function receipt()
    {
      return  $this->hasOne(Receipt::class);
    }
  
}
