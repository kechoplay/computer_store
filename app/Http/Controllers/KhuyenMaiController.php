<?php

namespace App\Http\Controllers;

use App\KhuyenMai;
use App\SanPham;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

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
        $danhsachsanpham = SanPham::all();
        return view('Admin.create_new_sale', compact('danhsachsanpham'));
    }

    public function store(Request $request)
    {
        KhuyenMai::where('product_id', $request->MaSP)->update(['status' => 0]);
        KhuyenMai::create([
            'product_id' => $request->MaSP,
            'start_time' => $request->ThoiGianBD,
            'end_time' => $request->ThoiGianKT,
            'sale' => $request->Giam,
            'status' => 1
        ]);

        return redirect()->back();
    }

    public function update($id)
    {
        $khuyenmai = KhuyenMai::find($id);
        $danhsachsanpham = SanPham::all();
        return view('Admin.update_sale', compact('khuyenmai', 'danhsachsanpham'));
    }

    public function edit(Request $request, $id)
    {
        $khuyenmai = KhuyenMai::find($id);
        // $khuyenmai = new quanlykhuyenmai(); // New là tạo mới
        $khuyenmai->TrangThai = $request->TrangThai == 'on';
        $khuyenmai->ThoiGianBD = $request->ThoiGianBD;
        $khuyenmai->ThoiGianKT = $request->ThoiGianKT;
        $khuyenmai->Giam = $request->Giam;
        $khuyenmai->MaSP = $request->MaSP;
        $khuyenmai->save();
        return redirect('admin/quanlykhuyenmai/list');
    }

    public function delete($MaKM)
    {
        quanlykhuyenmai::find($MaKM)->delete();
        return redirect('admin/quanlykhuyenmai/list');
    }
}
