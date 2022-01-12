<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(Auth::user()->user_type==1)
        {
            return redirect()->route('admin.index');
        }
        elseif(Auth::user()->user_type==1)
        {
            return view('doctor.index');
        }
        else
        {
            return view('user.index');
        }
        
    }
}
