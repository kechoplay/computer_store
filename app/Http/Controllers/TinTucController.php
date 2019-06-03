<?php

namespace App\Http\Controllers;

use App\TinTuc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Webpatser\Uuid\Uuid;

class TinTucController extends Controller
{
    //
    public function index()
    {
        $tintuc = TinTuc::all();
        return view('Admin.list_tin_tuc', compact('tintuc'));
    }

    public function create()
    {
        return view('Admin.create_new_new');
    }

    public function store(Request $request)
    {
        $path = '';
        if ($request->has('HinhAnh')) {
            $Anh = $request->file('HinhAnh');
            // Tạo tên ảnh là UUID duy nhất, tránh trùng tên ảnh cũ
            $filename = Uuid::generate()->string . '.png';
            // Đặt đường dẫn ảnh
            $path = "/files/image/" . $filename;
            // cop ảnh luu vao ht
            Image::make($Anh)->save(public_path($path));
        }

        TinTuc::create([
            'title' => $request->TieuDe,
            'date' => $request->NgayThang,
            'sort_description' => $request->TomTat,
            'description' => $request->NoiDungCT,
            'image' => $path,
            'admin_id' => Auth::id()
        ]);

        return redirect()->route('listNewView');
    }

    public function update($id)
    {
        $tintuc = TinTuc::find($id);
        return view('Admin.update_new', compact('tintuc'));
    }

    public function edit(Request $tt, $MaTT)
    {
        $tintuc = TinTuc::find($MaTT);
        // $tintuc = new quanlytintuc();
        $tintuc->title = $tt->TieuDe;
        $tintuc->date = $tt->NgayThang;
        $tintuc->sort_description = $tt->TomTat;
        $tintuc->description = $tt->NoiDungCT;
        $tintuc->admin_id = Auth::id();
        $path = '';
        if ($tt->has('HinhAnh')) {
            $Anh = $tt->file('HinhAnh');
            // Tạo tên ảnh là UUID duy nhất, tránh trùng tên ảnh cũ
            $filename = Uuid::generate()->string . '.png';
            // Đặt đường dẫn ảnh
            $path = "/files/image/" . $filename;
            // cop ảnh luu vao ht
            Image::make($Anh)->save(public_path($path));
            // Xóa ảnh cũ ( nếu có )
            if (file_exists(public_path($tintuc->image)))
                unlink(public_path($tintuc->image));
            // Cập nhật đường dẫn ảnh mới vào sản phẩm
            $tintuc->image = $path;
        }

        $tintuc->save();
        return redirect()->route('listNewView');
    }

    public function delete($id)
    {
        $tintuc = TinTuc::find($id);
        if (file_exists(public_path($tintuc->image)))
            unlink(public_path($tintuc->image));
        $tintuc->delete();
        return redirect()->route('listNewView');
    }
}
