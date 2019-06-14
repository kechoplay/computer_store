<?php

namespace App\Http\Controllers;

use App\NhaCungCap;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NhaCungCapController extends Controller
{
    //
    public function index()
    {
        $nhacungcap = NhaCungCap::get();
        return view('Admin.list_supplier', compact('nhacungcap'));
    }

    public function create()
    {
        return view('Admin.create_new_supplier');
    }

    public function store(Request $request)
    {
        $data = [
            'supply_name' => $request->supply_name,
            'supply_address' => $request->supply_address,
            'supply_mail' => $request->supply_mail,
            'supply_phone' => $request->supply_phone,
            'note' => $request->note,
        ];

        $rules = [
            'supply_name' => 'required',
            'supply_address' => 'required',
            'supply_mail' => 'required|email|unique:nhacungcap',
            'supply_phone' => 'required',
        ];

        $message = [
            'supply_name.required' => 'Bạn hãy nhập tên nhà cung cấp',
            'supply_address.required' => 'Bạn hãy nhập địa chỉ nhà cung cấp',
            'supply_mail.required' => 'Bạn hãy nhập email nhà cung cấp',
            'supply_mail.email' => 'Bạn hãy nhập email đúng định dạng',
            'supply_mail.unique' => 'Email nhà cung cấp đã tồn tại',
            'supply_phone.required' => 'Bạn hãy nhập số điện thoại nhà cung cấp',
        ];

        $validate = Validator::make($request->all(), $rules, $message);

        if ($validate->fails())
            return redirect()->back()->withErrors($validate)->withInput($data);

        NhaCungCap::create($data);

        return redirect()->route('listSupplierView');
    }

    public function update($id)
    {
        $nhacungcap = NhaCungCap::all()->where('id', $id)->first();
        return view('Admin.update_supplier', compact('nhacungcap'));
    }

    public function edit(Request $request)
    {
        $id = $request->id;
        $supplier = NhaCungCap::find($id);
        $data = [
            'supply_name' => $request->supply_name,
            'supply_address' => $request->supply_address,
            'supply_mail' => $request->supply_mail,
            'supply_phone' => $request->supply_phone,
            'note' => $request->note,
        ];

        $rules = [
            'supply_name' => 'required',
            'supply_address' => 'required',
            'supply_mail' => 'required|email|unique:nhacungcap,supply_mail,' . $supplier->supply_mail . ',supply_mail',
            'supply_phone' => 'required',
        ];

        $message = [
            'supply_name.required' => 'Bạn hãy nhập tên nhà cung cấp',
            'supply_address.required' => 'Bạn hãy nhập địa chỉ nhà cung cấp',
            'supply_mail.required' => 'Bạn hãy nhập email nhà cung cấp',
            'supply_mail.email' => 'Bạn hãy nhập email đúng định dạng',
            'supply_mail.unique' => 'Email nhà cung cấp đã tồn tại',
            'supply_phone.required' => 'Bạn hãy nhập số điện thoại nhà cung cấp',
        ];

        $validate = Validator::make($request->all(), $rules, $message);

        if ($validate->fails())
            return redirect()->back()->withErrors($validate)->withInput($data);

        NhaCungCap::where('id', $id)->update($data);

        return redirect()->route('listSupplierView');
    }

    public function delete($id)
    {
        $supplier = NhaCungCap::all()->where('id', $id)->first();
        if (count($supplier->sanpham) > 0)
            return redirect()->back()->withErrors(['error' => 'Bạn hãy xóa hết sản phẩm thuộc nhà cung cấp này']);

        $supplier->delete();
        return redirect()->back();
    }
}
