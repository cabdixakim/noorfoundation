<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    //mass assignment off
    protected $fillable = [
        'university_name', 'semester', 'amount_per_semester',
        'semester_start','semester_end','graduation_date','faculty'
    ];

    
    public function student(){
        return $this->belongTo(Student::class);
    }


}
