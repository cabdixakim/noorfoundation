<?php

namespace App\Http\Requests;

use App\Sponsor;
use App\Student;
use App\User;
use Illuminate\Support\Str;
use Illuminate\Foundation\Http\FormRequest;
use PragmaRX\Countries\Package\Countries;


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
        $id = request()->route('id');
        if($id != null){
            $user = User::findOrFail($id);
        } else {
            $user = '';
        }
        $inputcode = Str::of($this->input('country'))->explode('|')->last();
        if($user != ''){
        if( $user->profile && $user->profile->country != ''){
            $usercode = Countries::where('name.common', $user->profile->country)->first()->cca2;
            $usercountry = $user->profile->country;
            if($usercode === $inputcode || $inputcode == '' || $usercountry == $inputcode){
                $validatePhone = $usercode;
            }else {
                $validatePhone = $inputcode;
            }
           
        } else {
            $validatePhone = $inputcode;
        } 
    }  else {
        $validatePhone = $inputcode;
    }
        return [
            'firstname'=> 'required|string',
            'middlename'=> 'required|string',
            'lastname'=> 'required|string',
            'phone'=> 'required|numeric|phone:'.$validatePhone,
            'country'=> ['required'],
        ]; 
    }
}
