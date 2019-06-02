<?php

namespace App\Http\Controllers;

use App\SanPham;
use Illuminate\Http\Request;

class ChitietsanphamController extends Controller
{
    public function index($id){
        $sanpham = SanPham::find($id);
        $sanphamcungloai = SanPham::where('cat_id',$sanpham->cat_id)->take(3)->get();
        return view('User.chitietsanpham', compact('sanpham', 'sanphamcungloai'));
    }
}
