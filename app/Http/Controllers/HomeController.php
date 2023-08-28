<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Throwable;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        
        try{
            return view('home');
        }catch (Throwable $e){
            return view('error.error');
        }
    }

    public function logOut(){
        try{
            //Session::guard('admin')->flush();
            Auth::guard('admin')->logout();
            return redirect()->back();
        }catch (Throwable $e){
            return view('error.error');
        }
    }
}
