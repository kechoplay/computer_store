<?php

namespace App\Http\Controllers;

use App\HoaDon;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function loginForm()
    {
        if (Auth::guard('users')->check())
            return redirect()->back();

        return view('User.login');
    }

    public function login(Request $request)
    {
        if (Auth::guard('users')->check())
            return redirect()->back();

        $rules = [
            'name' => 'required',
            'password' => 'required',
        ];

        $message = [
            'name.required' => 'Bạn hãy nhập tên đăng nhập',
            'password.required' => 'Bạn hãy nhập mật khẩu',
        ];

        $validate = Validator::make($request->all(), $rules, $message);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate);
        }

        if (Auth::guard('users')->attempt(['name' => $request->name, 'password' => $request->password])) {
            return redirect()->route('index');
        }

        return redirect()->back()->withInput(['message' => 'Tên đăng nhập hoặc mật khẩu k đúng']);
    }

    public function registerForm()
    {
        if (Auth::guard('users')->check())
            return redirect()->back();

        return view('User.register');
    }

    public function register(Request $request)
    {
        if (Auth::guard('users')->check())
            return redirect()->back();

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'fullname' => $request->fullname,
            'address' => $request->address,
            'phone' => $request->phone
        ];

        $rules = [
            'name' => 'required|unique:users',
            'email' => 'required|unique:users|email',
            'password' => 'required',
            'fullname' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'gender' => 'required',
        ];

        $message = [
            'name.required' => 'Bạn hãy nhập tên đăng nhập',
            'name.unique' => 'Tên đăng nhập đã tồn tại',
            'email.required' => 'Bạn hãy nhập email',
            'email.unique' => 'Email đã tồn tại',
            'email.email' => 'Email không đúng định dạng',
            'password.required' => 'Bạn hãy nhập mật khẩu',
            'fullname.required' => 'Bạn hãy nhập mật khẩu',
            'address.required' => 'Bạn hãy nhập mật khẩu',
            'phone.required' => 'Bạn hãy nhập mật khẩu',
            'gender.required' => 'Bạn hãy nhập mật khẩu',
        ];

        $validate = Validator::make($request->all(), $rules, $message);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput($data);
        }

        $data['password'] = bcrypt($request->password);
        $data['gender'] = $request->gender;
        User::create($data);

        return redirect()->route('loginUserView');
    }

    public function logout()
    {
        Session::flush();
        Auth::guard('users')->logout();
        return redirect()->back();
    }

    public function customerOrder()
    {
        $listOrder = HoaDon::where('user_id', Auth::guard('users')->user()->id)->orderBy('id', 'DESC')->get();
        return view('User.customer_order', compact('listOrder'));
    }
}
