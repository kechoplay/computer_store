<?php

namespace App\Http\Controllers;

use App\ChiTietHoaDon;
use App\HoaDon;
use App\SanPham;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ShoppingCartController extends Controller
{
    //
    public function addCart(Request $request, $id)
    {
        $quantity = $request->query('quantity');
        $now = time();
        $product = SanPham::where('id', $id)->first();
        if ($product->khuyenmai->count() != 0 && $now >= strtotime($product->khuyenmai[0]->start_time) && $now <= strtotime($product->khuyenmai[0]->end_time))
            $price = intval($product->price - ($product->price * $product->khuyenmai[0]->sale / 100));
        else
            $price = $product->price;

        $listCart = Session::get('cart');

        if (isset($listCart[$id])) {
            if ($quantity != null)
                $finalQuantity = $listCart[$id]['quantity'] + $quantity;
            else
                $finalQuantity = $listCart[$id]['quantity']++;

            if ($product->quantity < $finalQuantity)
                $listCart[$id]['quantity'] = $product->quantity;
            else
                $listCart[$id]['quantity'] = $finalQuantity;

            Session::put('cart', $listCart);
        } else {
            $listCartId = [
                'quantity' => $quantity != null ? $quantity : 1,
                'price' => $price
            ];
            $listCart[$id] = $listCartId;
            Session::put('cart', $listCart);
        }

        return redirect()->back();
    }

    public function cart()
    {
        $listCart = Session::get('cart');
        $listProduct = [];
        if ($listCart != null) {
            foreach ($listCart as $key => $cart) {
                $sanpham = SanPham::where('id', $key)->first();
                $sale = $this->getSale($sanpham);
                $listProduct[] = [
                    'id' => $key,
                    'quantity' => $cart['quantity'],
                    'price' => $cart['price'],
                    'price_origin' => $sanpham->price,
                    'sale' => $sale,
                    'product_name' => $sanpham->product_name,
                    'image' => $sanpham->image
                ];
            }
        }

        return view('User.giohang', compact('listProduct'));
    }

    public function updateCart(Request $request)
    {
        $quantityList = $request->quantity;
        $listCart = Session::get('cart');
        $index = 0;

        foreach ($listCart as $key => $cart) {
            $product = SanPham::where('id', $key)->first();
            if ($product->quantity < $quantityList[$index])
                $listCart[$key]['quantity'] = $product->quantity;
            else
                $listCart[$key]['quantity'] = $quantityList[$index];

            Session::put('cart', $listCart);
            $index++;
        }

        return redirect()->back();
    }

    public function deleteCart($id)
    {
        $listCart = Session::get('cart');
        if (isset($listCart[$id]))
            unset($listCart[$id]);

        Session::put('cart', $listCart);

        return redirect()->back();
    }

    public function checkout(Request $request)
    {
        $listCart = Session::get('cart');
        if (!$listCart) return redirect()->route('index');
        if (!$listCart  || !$request->TenKH || !$request->SDT || !$request->Email || !$request->DiaChi) return redirect()->back();

        $hoaDon = HoaDon::create([
            'customer_name' => $request->TenKH,
            'phone' => $request->SDT,
            'email' => $request->Email,
            'address' => $request->DiaChi,
            'note' => $request->GhiChu,
            'payment_method' => $request->HinhThuc,
            'time_buy' => date("Y-m-d H:i:s"),
            'status' => 1,
        ]);

        $totalMoney = 0;
        foreach ($listCart as $key => $cart) {
            $sanpham = SanPham::where('id', $key)->first();
            $sale = $this->getSale($sanpham);

            ChiTietHoaDon::create([
                'order_id' => $hoaDon->id,
                'product_id' => $key,
                'quantity' => $cart['quantity'],
                'price' => $sanpham->price,
                'sale' => $sale,
            ]);

            $listProduct[] = [
                'id' => $key,
                'quantity' => $cart['quantity'],
                'price' => $cart['price'],
                'price_origin' => $sanpham->price,
                'sale' => $sale,
                'product_name' => $sanpham->product_name,
                'image' => $sanpham->image
            ];
            $totalMoney += $cart['price'] * $cart['quantity'];
        }

        Session::forget('cart');

        return view('User.thanhtoan', compact('listProduct', 'totalMoney', 'hoaDon'));
    }

    public function getSale($sanpham)
    {
        $now = time();
        $sale = 0;
        if ($sanpham->khuyenmai->count() != 0 && $now >= strtotime($sanpham->khuyenmai[0]->start_time) && $now <= strtotime($sanpham->khuyenmai[0]->end_time))
            $sale = $sanpham->khuyenmai[0]->sale;

        return $sale;
    }
}
