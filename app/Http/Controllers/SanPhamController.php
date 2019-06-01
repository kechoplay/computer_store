<?php

namespace App\Http\Controllers;

use App\DanhMuc;
use App\SanPham;
use Carbon\Carbon;
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

    public function editProduct($id)
    {
        $sanpham = SanPham::find($id);
        $sanpham->start_date = Carbon::createFromTimestamp(strtotime($sanpham->start_date))->format('Y-m-d');
        $danhmuc = DanhMuc::all();
        return view('Admin.update_product', compact('sanpham', 'danhmuc'));
    }

    public function update(Request $sp, $id)
    {
        $sanpham = SanPham::find($id);
        $sanpham->product_name = $sp->TenSP;
        $sanpham->cat_id = $sp->MaDM;
        $sanpham->price = $sp->Gia;
        $sanpham->note = $sp->GhiChu;
        $sanpham->description = $sp->MoTa;
        $sanpham->color = $sp->MauSac;
        $sanpham->size = $sp->KichThuoc;
        $sanpham->quantity = $sp->SoLuong;
        $sanpham->warranty = $sp->ThoiHanBH;
        $sanpham->start_date = $sp->NgaySX;
        $sanpham->RAM = $sp->RAM;
        $sanpham->HDD = $sp->HDD;
        $sanpham->is_new = $sp->SPNew;

        if ($sp->has('HinhAnh')) {
            $Anh = $sp->file('HinhAnh');
            // Tạo tên ảnh là UUID duy nhất, tránh trùng tên ảnh cũ
            $filename = Uuid::generate()->string . '.png';
            // Đặt đường dẫn ảnh
            $path = "/files/image/" . $filename;
            // cop ảnh luu vao ht
            Image::make($Anh)->save(public_path($path));
            // Xóa ảnh cũ ( nếu có )
            if (file_exists(public_path($sanpham->image)))
                unlink(public_path($sanpham->image));
            // Cập nhật đường dẫn ảnh mới vào sản phẩm
            $sanpham->image = $path;
        }
        $sanpham->save();
        return redirect()->route('productList');
    }
}