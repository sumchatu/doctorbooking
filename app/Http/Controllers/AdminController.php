<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{User,Appointment};
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Mail;


class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth','admin']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::whereIn('user_type',[2,3])->where('status',1)->paginate(10);
        return view('admin.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->user_type == 2) //for doctor
        {
            $this->validate($request, [
                'user_type' => 'required',
                'fname' => 'required|string|max:255',
                'lname' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8|confirmed',
                'phone' => 'required|digits:10',
                'department' => 'required|string|max:255',
                'fees' => 'required|between:0,99.99',
                'visiting_day' => 'required',
                'visiting_time' => 'required',
                'visiting_time_format' => 'required',
            ]);
        }
        if($request->user_type == 3) //for patient
        {
            $this->validate($request, [
                'user_type' => 'required',
                'fname' => 'required|string|max:255',
                'lname' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8|confirmed',
                'phone' => 'required|digits:10',
                'age' => 'required',
                'sex' => 'required',
                'address' => 'required|string|max:255',
            ]);
        }

        $user = new User();
        $user->user_type = $request->user_type;
        $user->fname = $request->fname;
        $user->lname = $request->lname;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->phone = $request->phone;
        $user->department = $request->department;
        $user->fees = $request->fees;
        $user->visiting_day = $request->visiting_day;
        $user->visiting_time = $request->visiting_time;
        $user->visiting_time_format = $request->visiting_time_format;
        $user->age = $request->age;
        $user->sex = $request->sex;
        $user->aadhar_no = $request->aadhar;
        $user->address = $request->address;

        $user->save();

        $data = ['fname'=>$request->fname,'lname'=>$request->lname];
        $receiver['email']=$request->email;
        Mail::send('admin.mail',$data,function($messages) use ($receiver){
            $messages->to($receiver['email']);
            $messages->subject('Welcome to Doctor App');
        });

        return redirect()->route('admin.index')
            ->with('success', 'New User Created Successfully');
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
        $user = User::findOrFail($id);
        if($user->user_type == 2)
        {
            return view('doctor.edit',compact('user'));
        }
        elseif($user->user_type == 3)
        {
            return view('user.edit',compact('user'));
        }
        else{
            //
        }
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
        $user = User::findOrFail($id);

        if($user->user_type == 2) //for doctor
        {
            $this->validate($request, [
                'fname' => 'required|string|max:255',
                'lname' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users,email,'.$id,
                'phone' => 'required|digits:10',
                'department' => 'required|string|max:255',
                'fees' => 'required|between:0,99.99',
                'visiting_day' => 'required',
                'visiting_time' => 'required',
                'visiting_time_format' => 'required',
            ]);

            $user->fname = $request->fname;
            $user->lname = $request->lname;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->department = $request->department;
            $user->fees = $request->fees;
            $user->visiting_day = $request->visiting_day;
            $user->visiting_time = $request->visiting_time;
            $user->visiting_time_format = $request->visiting_time_format;
        }

        if($user->user_type == 3) //for patient
        {
            $this->validate($request, [
                'fname' => 'required|string|max:255',
                'lname' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users,email,'.$id,
                'phone' => 'required|digits:10',
                'age' => 'required|digits:2',
                'sex' => 'required',
                'address' => 'required|string|max:255',
            ]);

            $user->fname = $request->fname;
            $user->lname = $request->lname;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->age = $request->age;
            $user->sex = $request->sex;
            $user->aadhar_no = $request->aadhar;
            $user->address = $request->address;
        }

        $user->update();

        return redirect()->route('admin.index')
            ->with('success', 'Record Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->status = 0;
        $user->update();

        return redirect()->route('admin.index')
            ->with('success', 'Record Deleted Successfully');

    }

    public function bookAppointment($id)
    {
        $doctor = User::findOrFail($id);

        $patients = User::where('user_type',3)->where('status',1)->orderBy('fname','asc')->get();
        $patientArr = ['' => 'Select Patient'];
        foreach ($patients as $p):
            $patientArr[$p->id] = $p->fname.'-'.$p->lname;
        endforeach;

        return view('admin.booking',compact('doctor','patientArr'));
    }

    public function appointmentSave(Request $request)
    {
        $this->validate($request, [
            'patient_id' => 'required',
            'doctor_id' => 'required',
            'date' => 'required|date',
            'time' => 'required',
        ]);

        $appointment = new Appointment();
        $appointment->doctor_id = $request->doctor_id;
        $appointment->user_id = $request->patient_id;
        $appointment->date_of_appointment = $request->date;
        $appointment->time = $request->time;

        $appointment->save();

        return redirect()->route('admin.index')
        ->with('success', 'Appointment Booked Successfully');

    }

}
