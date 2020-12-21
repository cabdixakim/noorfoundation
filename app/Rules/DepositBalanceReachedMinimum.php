<?php

namespace App\Rules;

use App\Deposit;
use App\Student;
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
        $balance = Deposit::all('amount')->count();
      
        return $value <= $balance;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Total balance is less than the value you entered' ;
    }
}
