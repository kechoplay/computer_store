<?php

namespace App\Http\Controllers;

use App\Admin;
use App\ChiTietHoaDon;
use App\DanhMuc;
use App\Exports\doanhthuExport;
use App\HoaDon;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use Maatwebsite\Excel\Facades\Excel;

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

        $validate = Validator::make($request->all(), [
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

    public function statistic(Request $request)
    {
        $kieu = 'ngay';
        if (isset($request->kieu)) $kieu = $request->kieu;

        $TuNgay = Carbon::now()->startOfMonth();
        if ($request->TuNgay) $TuNgay = Carbon::parse($request->TuNgay);

        $DenNgay = Carbon::now()->endOfMonth();
        if ($request->DenNgay) $DenNgay = Carbon::parse($request->DenNgay);

        $NgayDau = $TuNgay->copy()->startOfDay();

        if ($request->kieu == 'tuan') {
            $NgayCuoi = $NgayDau->copy()->endOfWeek();
        } else if ($request->kieu == 'thang') {
            $NgayCuoi = $NgayDau->copy()->endOfMonth();
        } else if ($request->kieu == 'nam') {
            $NgayCuoi = $NgayDau->copy()->endOfYear();
        } else {
            $NgayCuoi = $NgayDau->copy()->endOfDay();
        }
        $danhsachdoanhthu = [];
        $danhsachngay = [];
        do {
            $danhsachhoadontrongngay = HoaDon::where('status', 3)
                ->where('time_buy', '>=', $NgayDau->format('Y-m-d H:i:s'))
                ->where('time_buy', '<=', $NgayCuoi->format('Y-m-d H:i:s'))
                ->get();
            $doanhthu = 0;
            foreach ($danhsachhoadontrongngay as $hoadon) {
                $doanhthu += $hoadon->tongtien();
            }

            if ($doanhthu > 0) {
                if ($request->kieu == null) {
                    $danhsachngay[] = $NgayDau->toDateString();
                } else {
                    $danhsachngay[] = $NgayDau->toDateString() . ' - ' . $NgayCuoi->toDateString();
                }
                $danhsachdoanhthu[] = $doanhthu;
            }
            $NgayDau = $NgayCuoi->copy()->addDay()->startOfDay();
            if ($request->kieu == 'tuan') {
                $NgayCuoi = $NgayDau->copy()->endOfWeek();
            } else if ($request->kieu == 'thang') {
                $NgayCuoi = $NgayDau->copy()->endOfMonth();
            } else if ($request->kieu == 'nam') {
                $NgayCuoi = $NgayDau->copy()->endOfYear();
            } else {
                $NgayCuoi = $NgayDau->copy()->endOfDay();
            }
        } while ($NgayDau->copy()->diffInDays($DenNgay, false) > 0);

        $danhsachhoadon = HoaDon::where('status', 3)->where('time_buy', '>=', $TuNgay)->where('time_buy', '<=', $DenNgay)->get();

        return view('Admin.statistic', compact('danhsachngay', 'danhsachdoanhthu', 'danhsachhoadon', 'TuNgay', 'DenNgay', 'kieu'));
    }

    public function statisticProduct(Request $request)
    {
        $TuNgay = Carbon::now()->startOfMonth();
        if ($request->TuNgay) $TuNgay = $request->TuNgay;
        $DenNgay = Carbon::now()->endOfMonth();
        if ($request->DenNgay) $DenNgay = $request->DenNgay;

        $danhsachhoadon = HoaDon::where('status', 3)->where('time_buy', '>=', $TuNgay)->where('time_buy', '<=', $DenNgay)->get();
        $danhsachsanpham = [];
        $luotmua = [];
        $tongtien = [];
        $idHoaDon = [];
        foreach ($danhsachhoadon as $hoadon) {
            $idHoaDon[] = $hoadon->id;
        }

        $listProductWithTotal = ChiTietHoaDon::selectRaw("SUM(quantity) as luotmua, SUM(price*quantity) as doanhthu, product_id")->whereIn('order_id', $idHoaDon)->groupBy('product_id')->get();

        foreach ($listProductWithTotal as $chitiethoadon) {
            $sanpham = $chitiethoadon->sanpham;
            $MaSP = $sanpham->id;

            $luotmua[$MaSP] = $chitiethoadon->luotmua;
            $tongtien[$MaSP] = $chitiethoadon->doanhthu;
            $danhsachsanpham[] = $sanpham;
        }
        return view('Admin.statistic_product', compact('danhsachsanpham', 'luotmua', 'tongtien', 'TuNgay', 'DenNgay'));
    }

    public function export(Request $request)
    {
        return Excel::download(new doanhthuExport($request->TuNgay, $request->DenNgay), 'doanhthu.xlsx');
    }
}
