<?php

namespace App\Http\Requests;

use Illuminate\Support\Str;
use Illuminate\Foundation\Http\FormRequest;

class CreateProfileRequest extends FormRequest
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
        $valdatePhone = Str::of($this->input('country'))->explode('|')->last();
       
        return [
            'firstname'=> 'required|string',
            'middlename'=> 'required|string',
            'lastname'=> 'required|string',
            'phone'=> 'required|integer|phone:'.$valdatePhone,
            'country'=> ['required'],
        ];
    }
}
