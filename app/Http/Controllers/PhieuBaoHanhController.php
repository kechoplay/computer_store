<?php

namespace App\Http\Controllers;

use App\PhieuBaoHanh;
use Illuminate\Http\Request;

class PhieuBaoHanhController extends Controller
{
    //
    public function index()
    {
        $phieubaohanh = PhieuBaoHanh::get();

        return view('Admin.list_warranty', compact('phieubaohanh'));
    }
}
