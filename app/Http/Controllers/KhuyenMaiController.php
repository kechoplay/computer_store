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
        return view('Admin.list_sale', compact('khuyenmai'));
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
        KhuyenMai::where('product_id', $request->MaSP)->update(['status' => 0]);
        $khuyenmai = KhuyenMai::find($id);
        // $khuyenmai = new quanlykhuyenmai(); // New là tạo mới
        $khuyenmai->status = 1;
        $khuyenmai->start_time = $request->ThoiGianBD;
        $khuyenmai->end_time = $request->ThoiGianKT;
        $khuyenmai->sale = $request->Giam;
        $khuyenmai->product_id = $request->MaSP;
        $khuyenmai->save();
        return redirect()->back();
    }

    public function delete($id)
    {
        KhuyenMai::find($id)->delete();
        return redirect()->back();
    }
}
