<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SponsorPlan extends Model
{
    //
    protected $fillable = [
         
          'amount_required_annually',
    ];

    public function sponsor()
    {
        return $this->belongsTo(Sponsor::class);
    }
}
