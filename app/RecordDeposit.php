<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RecordDeposit extends Model
{
    //
    protected $fillable = [
        'year', 
        'total',
        'balance'
    ];
    public function sponsor()
    {
        # code...
        return $this->belongsTo(Sponsor::class,'user_id');
    }
}
