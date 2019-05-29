<?php

namespace App\Http\Controllers;

use App\Admin;
use App\DanhMuc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

class AdminController extends Controller
{
    //
    public function index()
    {
        return view('Admin.index');
    }

    public function storeProfile(Request $request)
    {
        try {
            $id = $request->id;
            $fullname = $request->fullname;
            $address = $request->address;
            $email = $request->email;
            $mobile = $request->phone;
            $gender = $request->gender;
            $birthday = $request->birthday;

            $imageName = $id . '_image.png';
            $path = public_path('files/image/');
            if (!is_dir($path))
                mkdir($path, 0777, true);
            if ($request->image) {
                $imageInfo = Image::make($request->image);
                $imageInfo->save(public_path('files/image/') . $imageName);
            }
            $data = [
                'fullname' => $fullname,
                'address' => $address,
                'email' => $email,
                'mobile' => $mobile,
                'birthday' => $birthday,
                'gender' => $gender,
            ];
            if ($request->image)
                $data['image'] = '/files/image/' . $imageName;

            Admin::where('id', $id)->update($data);

            return redirect()->route('adminIndex');
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return redirect()->route('adminIndex');
        }
    }

    public function listUser()
    {
        $listUser = Admin::where('level', 2)->get()->toArray();
        return view('Admin.list_user', compact('listUser'));
    }

    public function addNewUserView()
    {
        return view('Admin.add_new_user');
    }

    public function storeNewUser(Request $request)
    {
        $username = $request->username;
        $password = $request->password;
        $password2 = $request->password2;
        $fullname = $request->fullname;
        $address = $request->address;
        $email = $request->email;
        $mobile = $request->phone;
        $birthday = $request->birthday;
        $gender = $request->gender;

        $validate = Validator::make($request->all(),[
            'username' => 'required|unique:admin',
            'password' => 'required',
            'password2' => 'required|same:password'
        ],
            [
                'username.required' => 'Tên đăng nhập không được để trống',
                'username.unique' => 'Tên đăng nhập đã tồn tại',
                'password.required' => 'Mật khẩu không được để trống',
                'password2.required' => 'Mật khẩu không được để trống',
            ]
        );

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        }

        $data = [
            'username' => $username,
            'password' => bcrypt($password),
            'fullname' => $fullname,
            'address' => $address,
            'email' => $email,
            'mobile' => $mobile,
            'birthday' => $birthday,
            'gender' => $gender,
            'level' => 2
        ];

        Admin::create($data);

        return redirect()->route('addNewUserView');
    }

    public function deleteUser($id)
    {
        Admin::where(['id' => $id])->delete();
        return redirect()->route('listUserView');
    }


}
