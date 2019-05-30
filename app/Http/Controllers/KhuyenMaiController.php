<?php

namespace App\Http\Controllers;

use App\KhuyenMai;
use Illuminate\Http\Request;

class KhuyenMaiController extends Controller
{
    //
    public function index()
    {
        $khuyenmai = KhuyenMai::all();
        return view('Admin.sale_list', compact('khuyenmai'));
    }

    public function create()
    {
        $danhsachsanpham = quanlysanpham::all();
        return view('admin/quanlykhuyenmai/create', compact('danhsachsanpham'));
    }

    public function them(Request $km)
    {
        $khuyenmai = new quanlykhuyenmai();
        $khuyenmai->ThoiGianBD = $km->ThoiGianBD;
        $khuyenmai->ThoiGianKT = $km->ThoiGianKT;
        $khuyenmai->Giam = $km->Giam;
        $khuyenmai->MaSP = $km->MaSP;
        $khuyenmai->save();
        return redirect('admin/quanlykhuyenmai/list');
    }

    public function update($MaKM)
    {
        $khuyenmai = quanlykhuyenmai::find($MaKM);
        $danhsachsanpham = quanlysanpham::all();
        return view('admin/quanlykhuyenmai/update', compact('khuyenmai', 'danhsachsanpham'));
    }

    public function sua(Request $km, $MaKM)
    {
        $khuyenmai = quanlykhuyenmai::find($MaKM);
        // $khuyenmai = new quanlykhuyenmai(); // New là tạo mới
        $khuyenmai->TrangThai = $km->TrangThai == 'on';
        $khuyenmai->ThoiGianBD = $km->ThoiGianBD;
        $khuyenmai->ThoiGianKT = $km->ThoiGianKT;
        $khuyenmai->Giam = $km->Giam;
        $khuyenmai->MaSP = $km->MaSP;
        $khuyenmai->save();
        return redirect('admin/quanlykhuyenmai/list');
    }

    public function delete($MaKM)
    {
        quanlykhuyenmai::find($MaKM)->delete();
        return redirect('admin/quanlykhuyenmai/list');
    }
}
