<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentProfile extends Model
{
    //
    protected $fillable = [
        'firstname', 'middlename', 'lastname','country','phone','avatar',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

   
}
