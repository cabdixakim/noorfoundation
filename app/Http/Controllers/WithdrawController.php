<?php

namespace App\Http\Controllers;

use App\User;
use App\Deposit;
use App\Student;
use App\Withdraw;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\createWithdrawRequest;
use App\Notifications\WithdrawNotification;
use Illuminate\Support\Facades\Notification;

class WithdrawController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','verified']);
        $this->middleware('admin')->except('index');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $groupedData = Withdraw::orderBy('created_at','desc')->get()->groupBy(function($val) {
            return Carbon::parse($val->created_at)->format('Y-M');
      });
    //   dd($groupedData);
         $balance = Deposit::all()->sum('amount') - Withdraw::all()->sum('amount');
        if(Auth::check()){
            if(auth()->user()->user_type == 'admin'){
                return view('admin.listWithdraws',compact('groupedData','balance'));
            } else {
           return view('randomUsersListWithdraws',compact('groupedData','balance'));
        }
       }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $students = Student::all();
        foreach($students as $student){
              dump($student);
        }
        return view('admin.createWithdraw',compact('students'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(createWithdrawRequest $request)
    {
        //
        $student = Student::find($request->student_id);
        dd($student, $request->all());
        $withdrawal = $student->withdrawals()->create($request->all());
         
        if($withdrawal){
            $users = User::where('user_type', '!=', 'admin')->get();
            Notification::send($users, new WithdrawNotification($withdrawal));
        }
        return redirect()->back()->with('status', 'Money withdrawn successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
