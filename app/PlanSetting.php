<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlanSetting extends Model
{
    //
    protected $fillable = [
        'status'
    ];
    
    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
