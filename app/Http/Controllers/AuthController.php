<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //
    public function index()
    {
        return view('Auth.login');
    }

    public function checkLogin()
    {
        if (Auth::user()) {

        } else {
            return redirect()->route('loginView');
        }
    }
}
