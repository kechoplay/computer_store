<?php

namespace App\Http\Controllers;

use App\DanhMuc;
use App\SanPham;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Webpatser\Uuid\Uuid;

class SanPhamController extends Controller
{
    //
    public function index(){
        $sanpham = SanPham::all();
        return view('Admin.list_product', compact('sanpham'));
    }

    public function createProduct()
    {
        $danhmuc = DanhMuc::all();
        return view('Admin.create_new_product', compact('danhmuc'));
    }

    public function storeNewProduct(Request $sp){
        $path = '';
        if($sp->has('HinhAnh')){
            $Anh = $sp->file('HinhAnh');
            // Tạo tên ảnh là UUID duy nhất, tránh trùng tên ảnh cũ
            $filename = Uuid::generate()->string.'.png';
            // Đặt đường dẫn ảnh
            $path = "/files/image/";
            if (!is_dir($path))
                mkdir($path, 0777, true);

            // cop ảnh luu vao ht
            Image::make($Anh)->save(public_path($path) . $filename);
        }

        $sanpham = new SanPham();
        $sanpham->TenSP = $sp->TenSP;
        $sanpham->DM= $sp->MaDM;
        $sanpham->Gia = $sp->Gia;
        $sanpham->HinhAnh =  $path . $filename ;
        $sanpham->GhiChu = $sp->GhiChu;
        $sanpham->MoTa = $sp->MoTa;
        $sanpham->MauSac = $sp->MauSac;
        $sanpham->KichThuoc = $sp->KichThuoc;
        $sanpham->SoLuong = $sp->SoLuong;
        $sanpham->ThoiHanBH = $sp->ThoiHanBH;
        $sanpham->NgaySX = $sp->NgaySX;
        $sanpham->RAM = $sp->RAM;
        $sanpham->HDD = $sp->HDD;
        $sanpham->SPNew = $sp->SPNew;
        $sanpham->save();

        return redirect()->route('productList');
    }
}
