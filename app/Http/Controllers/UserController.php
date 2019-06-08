<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function loginForm()
    {
        return view('User.login');
    }

    public function login(Request $request)
    {

    }

    public function registerForm()
    {
        return view('User.register');
    }

    public function register()
    {
        return view('User.register');
    }
}
