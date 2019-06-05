<?php

namespace App\Http\Controllers;

use App\DanhMuc;
use App\KhuyenMai;
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
        $danhmuc = DanhMuc::where('parent_id', 0)->get();
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
        $danhmuc = DanhMuc::where('parent_id', 0)->get();
        return view('Admin.update_product', compact('sanpham', 'danhmuc'));
    }

    // cập nhật sản phẩm
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

    // chi tiết sản phẩm
    public function chiTietSanPham($id)
    {
        $sanpham = SanPham::find($id);
        $sanphamcungloai = SanPham::where('cat_id', $sanpham->cat_id)->where('id', '<>', $id)->take(3)->get();
        return view('User.chitietsanpham', compact('sanpham', 'sanphamcungloai'));
    }

    // danh sách sản phẩm
    public function danhSachSanPham()
    {
        $sanpham = SanPham::simplePaginate(15);

        return view('User.danhsachsanpham', compact('sanpham'));
    }

    // danh sách khuyến mãi
    public function danhSachKhuyenMai()
    {
        $date_start = Carbon::now()->startOfDay();
        $date_end = Carbon::now()->endOfDay();

        $sanpham = KhuyenMai::where('start_time', '<=', $date_end)
            ->where('end_time', '>=', $date_start)->simplePaginate(15);

        return view('User.danhsachkhuyenmai', compact('sanpham'));
    }

    // tìm kiếm sản phẩm
    public function searchProduct(Request $request)
    {
        $str = $request->query('str');

        if ($str != null || $str != '')
            $sanpham = SanPham::where('product_name', 'LIKE', '%' . $str . '%')->simplePaginate(15);
        else
            $sanpham = SanPham::simplePaginate(15);

        $sanpham->appends(['str' => $str]);

        return view('User.search', compact('sanpham', 'str'));
    }

    public function productCategory($idDanhMuc)
    {
        $sanpham = SanPham::where('cat_id', $idDanhMuc)->simplePaginate(15);
        $danhmuc = DanhMuc::where('id', $idDanhMuc)->first();
        return view('User.sanphamdanhmuc', compact('sanpham', 'danhmuc'));
    }
}
