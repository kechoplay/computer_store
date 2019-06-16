<?php

namespace App\Http\Controllers;

use App\HinhThucThanhToan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HinhThucThanhToanController extends Controller
{
    //
    public function index()
    {
        $payment = HinhThucThanhToan::get();
        return view('Admin.list_payment', compact('payment'));
    }

    public function create()
    {
        return view('Admin.create_new_payment');
    }

    public function store(Request $request)
    {
        $data = [
            'payment_name' => $request->payment_name,
        ];

        $rules = [
            'payment_name' => 'required',
        ];

        $message = [
            'payment_name.required' => 'Bạn hãy nhập tên hình thức thanh toán',
        ];

        $validate = Validator::make($request->all(), $rules, $message);

        if ($validate->fails())
            return redirect()->back()->withErrors($validate)->withInput($data);

        HinhThucThanhToan::create($data);

        return redirect()->route('listPaymentView');
    }

    public function update($id)
    {
        $payment = HinhThucThanhToan::all()->where('id', $id)->first();
        return view('Admin.update_payment', compact('payment'));
    }

    public function edit(Request $request)
    {
        $id = $request->id;
        $data = [
            'payment_name' => $request->payment_name,
        ];

        $rules = [
            'payment_name' => 'required',
        ];

        $message = [
            'payment_name.required' => 'Bạn hãy nhập tên hình thức thanh toán',
        ];

        $validate = Validator::make($request->all(), $rules, $message);

        if ($validate->fails())
            return redirect()->back()->withErrors($validate)->withInput($data);

        HinhThucThanhToan::where('id', $id)->update($data);

        return redirect()->route('listPaymentView');
    }

    public function delete($id)
    {
        $payment = HinhThucThanhToan::all()->where('id', $id)->first();

        $payment->delete();
        return redirect()->back();
    }
}
