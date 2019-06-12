<?php

namespace App\Http\Controllers;

use App\DanhMuc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DanhMucController extends Controller
{
    //
    public function listCategory()
    {
        $danhmuc = DanhMuc::get();
        return view('Admin.list_danh_muc', compact('danhmuc'));
    }

    public function addNewCategory()
    {
        $danhmuccha = DanhMuc::all()->where('parent_id', 0)->toArray();
        return view('Admin.add_new_category', compact('danhmuccha'));
    }

    public function storeNewCategory(Request $request)
    {
        $categoryName = $request->cate_name;
        $parentId = $request->parentId;
        $sortOrder = $request->sortOrder;
        $status = $request->status;

        $childCategory = DanhMuc::all()->where('parent_id', $parentId)->toArray();
        $isDubplicateOrder = false;

        if (count($childCategory) > 0) {
            foreach ($childCategory as $category) {
                if ($sortOrder == $category['sort_order']) {
                    $isDubplicateOrder = true;
                    break;
                }
            }
        }

        if ($isDubplicateOrder) {
            return redirect()->back()->withErrors(['error' => 'Vị trí hiển thị danh mục trùng. Xin mời chọn vị trí khác']);
        }

        DanhMuc::create([
            'cat_name' => $categoryName,
            'parent_id' => $parentId,
            'sort_order' => $sortOrder,
            'cat_status' => $status
        ]);

        return redirect()->back();
    }

    public function updateCategory($id)
    {
        $category = DanhMuc::all()->where('id', $id)->first();
        $danhmuccha = DanhMuc::all()->where('parent_id', 0)->toArray();
        return view('Admin.update_category', compact('danhmuccha', 'category'));
    }

    public function editCategory(Request $request)
    {
        $id = $request->id;
        $categoryName = $request->cate_name;
        $parentId = $request->parentId;
        $sortOrder = $request->sortOrder;
        $status = $request->status;

        $childCategory = DanhMuc::all()->where('parent_id', $parentId)->where('id', '!=', $id)->toArray();
        $isDuplicateOrder = false;

        if (count($childCategory) > 0) {
            foreach ($childCategory as $category) {
                if ($sortOrder == $category['sort_order']) {
                    $isDuplicateOrder = true;
                    break;
                }
            }
        }

        if ($isDuplicateOrder) {
            return redirect()->back()->withErrors(['error' => 'Vị trí hiển thị danh mục trùng. Xin mời chọn vị trí khác']);
        }

        DanhMuc::where('id', $id)->update([
            'cat_name' => $categoryName,
            'parent_id' => $parentId,
            'sort_order' => $sortOrder,
            'cat_status' => $status
        ]);

        return redirect()->back();
    }

    public function deleteCategory($id)
    {
        $category = DanhMuc::all()->where('id', $id)->first();
        if (count($category->children) > 0)
            return redirect()->back()->withErrors(['error' => 'Đây là danh mục cha, bạn phải xóa hết danh mục con thì mới xóa được danh mục cha']);

        if ($category->sanpham->count())
            return redirect()->back()->withErrors(['error' => 'Bạn hãy xóa hết sản phẩm thuộc danh mục này']);

        $category->delete();
        return redirect()->back();
    }
}
