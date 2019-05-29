<?php

namespace App\Http\Controllers;

use App\Admin;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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
            return redirect()->route('adminIndex');
        } else {
            return redirect()->route('loginView');
        }
    }

    public function login(Request $request)
    {
        $notice = '';
        $validate = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required'
        ],
            [
                'username.required' => 'Bạn phải nhập tài khoản',
                'password.required' => 'Bạn phải điền mật khẩu'
            ]
        );

        $password = $request->input('password');
        $username = $request->input('username');
        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        }

        if (Auth::attempt(['username' => $username, 'password' => $password])) {
            Admin::where('id', Auth::id())->update(['last_login_time' => strtotime(Carbon::now())]);
        } else {
            $notice = "Tài khoản hoặc mật khẩu k chính xác";
            return redirect()->back()->withInput(['notice' => $notice]);
        }

        return redirect()->route('adminIndex');
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        Auth::logout();
        return redirect()->route('loginView');
    }
}
