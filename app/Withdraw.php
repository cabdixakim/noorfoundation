<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Withdraw extends Model
{
    //
    protected $fillable = [
        'amount',
        'semester',
  ];
  

   public function student()
   {
      return $this->belongsTo(Student::class,'user_id');
   }
}
