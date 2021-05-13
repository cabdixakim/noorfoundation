<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deposit extends Model
{
    //
    protected $fillable = [
        'year',
         'amount',
         'created_at',
         'updated_at',
        //  'status',
   ];
   

    public function sponsor()
    {
       return $this->belongsTo(Sponsor::class,'user_id');
    }
}
