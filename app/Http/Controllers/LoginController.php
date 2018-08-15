<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(){
        return view('login');
    }

    public function loginCheck(Request $request){
        $this->validate($request,[
            'user_email'=>'required',
            'password'=>'required'
        ]);

        if(Auth::attempt(['user_email'=>$request->get('user_email'),'password'=>$request->get('password')])){
            return redirect('dashboard');
        }else{
            return redirect('login');
        }

    }

    public function logout(){
        Auth::logout();
        return redirect('/');
    }

}
