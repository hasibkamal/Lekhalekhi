<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class MyController extends Controller
{


    public function dashboard(){
        return view('dashboard');
    }
    public function home(){
        return view('home');
    }
}
