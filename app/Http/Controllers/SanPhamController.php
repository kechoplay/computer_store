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
    public function index()
    {
        $sanpham = SanPham::all();
        return view('Admin.list_product', compact('sanpham'));
    }

    public function createProduct()
    {
        $danhmuc = DanhMuc::all();
        return view('Admin.create_new_product', compact('danhmuc'));
    }

    public function storeNewProduct(Request $sp)
    {
        $path = '';
        if ($sp->has('HinhAnh')) {
            $Anh = $sp->file('HinhAnh');
            // Tạo tên ảnh là UUID duy nhất, tránh trùng tên ảnh cũ
            $filename = Uuid::generate()->string . '.png';
            // Đặt đường dẫn ảnh
            $path = "/files/image/";
            if (!is_dir($path))
                mkdir($path, 0777, true);

            // cop ảnh luu vao ht
            Image::make($Anh)->save(public_path($path) . $filename);
        }

        // lưu dữ liệu vào database
        $data = [
            'product_name' => $sp->TenSP,
            'cat_id' => $sp->MaDM,
            'price' => $sp->Gia,
            'image' => $path . $filename,
            'note' => $sp->GhiChu,
            'description' => $sp->MoTa,
            'color' => $sp->MauSac,
            'size' => $sp->KichThuoc,
            'quantity' => $sp->SoLuong,
            'warranty' => $sp->ThoiHanBH,
            'start_date' => $sp->NgaySX,
            'RAM' => $sp->RAM,
            'HDD' => $sp->HDD,
            'is_new' => $sp->SPNew,
        ];

        SanPham::create($data);

        return redirect()->route('productList');
    }
}
