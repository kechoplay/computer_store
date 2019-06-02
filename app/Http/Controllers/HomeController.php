<?php

namespace App\Http\Controllers;

use App\DanhMuc;
use App\KhuyenMai;
use App\SanPham;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $sanphamused = SanPham::where('is_new', 0)->take(3)->get();
        $sanphamnew = SanPham::where('is_new', 1)->take(3)->get();

        $date_start = Carbon::now()->startOfDay();
        $date_end = Carbon::now()->endOfDay();
        $danhsachkhuyenmai = KhuyenMai::where('start_time', '<=', $date_end)
            ->where('end_time', '>=', $date_start)
            ->take(3)->get();

//        $tintuc = quanlytintuc::all();
//        $danhsachsanphambanchay = quanlychitiethoadon::groupBy('MaSP')
//            ->selectRaw('sum(SoLuong) as SoLuong , MaSP')
//            ->orderBy('SoLuong', 'desc')
//            ->take(4)->get();
        return view('User.index',compact('sanphamused','sanphamnew','danhsachkhuyenmai'));
    }
}
