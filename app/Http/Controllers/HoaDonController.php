<?php

namespace App\Http\Controllers;

use App\HoaDon;
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

        return view('Admin.detail_order', compact('hoadon'));
    }
}
