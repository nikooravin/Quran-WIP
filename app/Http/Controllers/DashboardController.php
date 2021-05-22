<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request){

        // dd(auth()->user()); shows we're logged in

        return view('login.dashboard');

    }
}
