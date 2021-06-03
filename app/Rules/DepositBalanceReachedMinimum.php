<?php

namespace App\Rules;

use App\Deposit;
use App\Student;
use App\Withdraw;
use Illuminate\Contracts\Validation\Rule;

class DepositBalanceReachedMinimum implements Rule
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
        
        $balance = Deposit::all()->sum('amount') - Withdraw::all()->sum();
       
        return $value < $balance;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Sorry! value entered is more than the money we have in our account.' ;
    }
}
