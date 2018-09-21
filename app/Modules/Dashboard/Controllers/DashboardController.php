<?php

namespace App\Modules\Dashboard\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard(){
//        dd(Auth::user()->user_type);
        return view('Dashboard::dashboard');
    }
}
