<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePlanRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
            'university_name'=> 'required|string',
            'semester'=> 'required|string',
            'amount_per_semester'=> 'required|integer',
            'graduation_date'=> 'required',
            'semester_start'=> 'required',
            'semester_end'=> ['required'],
        ];
    }
}
