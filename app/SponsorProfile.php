<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class SponsorProfile extends Model
{
    protected $fillable = [
        'firstname', 'middlename', 'lastname','country','phone','avatar',
    ];

    
    public function sponsor()
    {
        return $this->belongsTo(Sponsor::class);
    }
}
