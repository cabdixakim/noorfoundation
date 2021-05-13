<?php

namespace App\Rules;

use App\Student;
use Illuminate\Contracts\Validation\Rule;

class ReachedMaximum implements Rule
{
    private $data;
    /**
     * Create a new rule instance.
     *
     * @return void
     */

    public function __construct($data)
    {
        //
        $this->data = $data;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        //
        if(!$this->data['student_id']){
             return False;
        } else {
            $student = Student::findOrFail($this->data['student_id']);
            $credit = $student->CurrentSemesterCredit();
            return $value <= $credit;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        if(!$this->data['student_id']){
            return 'are you sure you chose a student?';
        } else {
        $student = Student::findOrFail($this->data['student_id']);
        $credit = $student->CurrentSemesterCredit();
        return 'You cannot pay more than USD$ '. number_format($credit,0,',',',').' to '.$student->username;
       }
}
}
