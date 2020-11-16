<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GraduatedStudent extends Model
{
    //
    protected $fillable = [
        'firstname',
        'middlename',
        'lastname',
        'university',
        'faculty',
        'start_date',
        'graduation_date',
    ];
    
}
