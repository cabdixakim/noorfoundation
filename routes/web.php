<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    if(Auth::check()){
        if (Auth::user()->user_type == 'student') {
            return redirect()->route('student.index');
        } elseif (Auth::user()->user_type == 'sponsor') {
            return redirect()->route('sponsor.index');
        } elseif (Auth::user()->user_type == 'admin') {
            return redirect('/admin');
        }
    } 
    return view('auth.login');
});

Auth::routes(['verify' => true]);

//logout GET route
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');

Route::get('/admin', function ()
{
    if(Auth::check()){
    if (Auth::user()->user_type == 'admin') {
        return redirect()->route('deposit.index');
    }
  }
});

// student routes

// // crerate student plan and profile
// Route::get('/profiles/students/create', 'StudentProfileController@create')->name('profiles.student.profile.create');
// Route::get('/profiles/students/plan/create', 'PlanController@create')->name('profiles.student.plan.create');
// // store student profile  and plan
// Route::post('/profiles/students', 'StudentProfileController@store')->name('profiles.student.profile.store');
// Route::post('/profiles/students/plan', 'PlanController@store')->name('profiles.student.plan.store');
// // get a student profile
// Route::get('/profiles/students/{student}', 'StudentProfileController@show')->name('profiles.student.show');


// // sponsor routes
// Route::post('/profiles/sposnors', 'SponsorProfileController@store')->name('profiles.sponsor.store');
// Route::get('/profiles/sponsors/{sponsor}', 'SponsorProfileController@show')->name('profiles.sponsor.show');


//route for student, assigning route parameter as 'id' instead of 'student'
Route::resource('profile/student', 'StudentController',['parameters' =>[
    'student' => 'id'
 ]]);

//route for sponsor, assigning route parameter as 'id' instead of 'sponsor'
Route::resource('profile/sponsor', 'SponsorController');
Route::resource('plan', 'PlanController');
Route::resource('loginas', 'Admin\LoginAsController');

//allowing easy password reset
Route::resource('easy-password-reset', 'Hacks\EasyPasswordResetController');

// Route::resource('Admin/adminpayments', 'AdminPaymentsController');

Route::resource('Admin/dashboard', 'AdminDashboardController');
Route::resource('Admin/student-settings', 'AdminStudentController');
Route::resource('Admin/create-student', 'Admin\AddStudentController');
Route::resource('Admin/create-sponsor', 'Admin\AddSponsorController');

//the admin route for updating the student
Route::resource('Admin/update-student-profile', 'Admin\EditStudentController',['parameters' =>[
       'update-student-profile' => 'id'
    ]]);

// admin route for updating student plan
Route::resource('Admin/update-student-plan', 'Admin\EditStudentPlanController');

//the admin route for updating the sponsor
Route::resource('Admin/update-sponsor-profile', 'Admin\EditSponsorController',['parameters' =>[
    'update-sponsor-profile' => 'id'
 ]]);


Route::resource('payment', 'PaymentController');
Route::resource('deposit', 'DepositController');
Route::resource('sponsor-plan', 'SponsorPlanController');
Route::resource('register-year', 'RegisterYearController');
Route::resource('show-records', 'RecordDepositController');
Route::resource('withdraw', 'WithdrawController');
Route::resource('notifications', 'NotificationController');

Route::resource('avatar', 'AvatarController');

Route::resource('sponsored-students', 'SponsoredStudentsController');

//admin route to control sponsors
Route::resource('Admin/sponsors', 'Admin\SponsorSettingController');


Route::resource('graduated-students', 'GraduatedStudentController');
Route::resource('sponsors-list', 'SponsorsListController');
Route::resource('transcript', 'TranscriptController');
Route::resource('receipt', 'StudentReceiptController');