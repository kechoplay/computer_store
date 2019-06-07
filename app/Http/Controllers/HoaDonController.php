<?php

namespace App\Http\Controllers;

use App\ChiTietHoaDon;
use App\HoaDon;
use App\PhieuBaoHanh;
use Illuminate\Http\Request;

class HoaDonController extends Controller
{
    //
    public function index()
    {
        $danhsachhoadon = HoaDon::orderBy('status', 'ASC')->get()->toArray();

        return view('Admin.list_order', compact('danhsachhoadon'));
    }

    public function orderDetail($id)
    {
        $hoadon = HoaDon::where('id', $id)->first();
        $tongtien = 0;
        foreach ($hoadon->chitiethoadon as $chitiethoadon) {
            $tongtien += $chitiethoadon->price * $chitiethoadon->quantity;
        }

        return view('Admin.detail_order', compact('hoadon', 'tongtien'));
    }

    public function approve($id)
    {
        $hoadon = HoaDon::where('id', $id)->first();
        $hoadon->status = 2;
        $hoadon->save();
        foreach($hoadon->chitiethoadon as $chitiethoadon) {
            $sanpham = $chitiethoadon->sanpham;
            $sanpham->decrement('quantity', $chitiethoadon->quantity);
            $sanpham->save();
            if (isset($sanpham->warranty) && $sanpham->warranty > 0) {
                PhieuBaoHanh::create([
                    'order_id' => $id,
//                    'user_id' => '',
                    'product_id' => $chitiethoadon->product_id,
                    'customer_name' => $hoadon->customer_name,
                    'phone' => $hoadon->phone,
                    'buy_date' => $hoadon->time_buy,
                    'warranty' => $sanpham->warranty
                ]);
            }
        }
        return redirect()->back();
    }

    public function ship($MaHD){
        $hoadon = HoaDon::find($MaHD);
        $hoadon->status = 3;
        $hoadon->save();
        return redirect()->back();
    }

    public function cancelShip($id){
        $hoadon = HoaDon::find($id);
        $hoadon->status = 4;
        $hoadon->save();
        foreach($hoadon->chitiethoadon as $chitiethoadon) {
            $sanpham = $chitiethoadon->sanpham;
            $sanpham->increment('quantity', $chitiethoadon->quantity);
            $sanpham->save();
        }
        PhieuBaoHanh::where('order_id', $id)->delete();
        return redirect()->back();
    }

    public function cancel($id){
        $hoadon = HoaDon::find($id);
        $hoadon->status = 4;
        $hoadon->save();
        return redirect()->back();
    }
}
