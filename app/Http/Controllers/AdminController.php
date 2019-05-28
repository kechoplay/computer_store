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

    public function listCategory()
    {
        $danhmuc = DanhMuc::get();
        return view('Admin.list_danh_muc', compact('danhmuc'));
    }

    public function addNewCategory()
    {
        $danhmuccha = DanhMuc::all()->where('parent_id', 0)->toArray();
        return view('Admin.add_new_category', compact('danhmuccha'));
    }

    public function storeNewCategory(Request $request)
    {
        $categoryName = $request->cate_name;
        $parentId = $request->parentId;
        $sortOrder = $request->sortOrder;
        $status = $request->status;

        $childCategory = DanhMuc::all()->where('parent_id', $parentId)->toArray();
        $isDubplicateOrder = false;

        if (count($childCategory) > 0) {
            foreach ($childCategory as $category) {
                if ($sortOrder == $category['sort_order']) {
                    $isDubplicateOrder = true;
                    break;
                }
            }
        }

        if ($isDubplicateOrder) {
            return redirect()->back()->withErrors(['error' => 'Vị trí hiển thị danh mục trùng. Xin mời chọn vị trí khác']);
        }

        DanhMuc::create([
            'cat_name' => $categoryName,
            'parent_id' => $parentId,
            'sort_order' => $sortOrder,
            'cat_status' => $status,
            'created_by' => Auth::id()
        ]);

        return redirect()->back();
    }

    public function updateCategory($id)
    {
        $category = DanhMuc::all()->where('id', $id)->first();
        $danhmuccha = DanhMuc::all()->where('parent_id', 0)->toArray();
        return view('Admin.update_category', compact('danhmuccha', 'category'));
    }

    public function editCategory(Request $request)
    {
        $id = $request->id;
        $categoryName = $request->cate_name;
        $parentId = $request->parentId;
        $sortOrder = $request->sortOrder;
        $status = $request->status;

        $childCategory = DanhMuc::all()->where('parent_id', $parentId)->where('id', '!=', $id)->toArray();
        $isDubplicateOrder = false;

        if (count($childCategory) > 0) {
            foreach ($childCategory as $category) {
                if ($sortOrder == $category['sort_order']) {
                    $isDubplicateOrder = true;
                    break;
                }
            }
        }

        if ($isDubplicateOrder) {
            return redirect()->back()->withErrors(['error' => 'Vị trí hiển thị danh mục trùng. Xin mời chọn vị trí khác']);
        }

        DanhMuc::where('id', $id)->update([
            'cat_name' => $categoryName,
            'parent_id' => $parentId,
            'sort_order' => $sortOrder,
            'cat_status' => $status,
            'updated_by' => Auth::id()
        ]);

        return redirect()->back();
    }

    public function deleteCategory($id)
    {
        $category = DanhMuc::all()->where('id', $id)->first();
        if (count($category->children) > 0)
            return redirect()->back()->withErrors(['error' => 'Đây là danh mục cha, bạn phải xóa hết danh mục con thì mới xóa được danh mục cha']);

        $category->delete();
        return redirect()->back();
    }
}
