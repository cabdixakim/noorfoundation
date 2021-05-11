<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers; 

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function redirectTo()
    {
        if (auth()->user()->user_type === 'student'){
            $user = auth()->user();
            if (!$user->profile) {
                return '/profile/student/create';
            }
            return '/profile/student';  //return student profile
        } 
        elseif (auth()->user()->user_type === 'sponsor'){
            $user = auth()->user();
            if (!$user->profile) {
                return '/profile/sponsor/create';
            }
            return '/deposit'; //return sponsor profile
        }
        elseif (auth()->user()->user_type === 'admin'){
           
            return '/'; //return sponsor profile
        }
    }

    public function username()
    {
        $field = (filter_var(request()->email, FILTER_VALIDATE_EMAIL) || !request()->email) ? 'email' : 'username';
        request()->merge([$field => request()->email]);
        return $field;
    }

}
