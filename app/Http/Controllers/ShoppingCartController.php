<?php

namespace App\Http\Controllers;

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
            $listCart[$id]['quantity'] = $quantity != null ? $listCart[$id]['quantity'] + $quantity : $listCart[$id]['quantity'] + 1;
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
        if (count($listCart) > 0) {
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

    public function getSale($sanpham)
    {
        $now = time();
        $sale = 0;
        if ($sanpham->khuyenmai->count() != 0 && $now >= strtotime($sanpham->khuyenmai[0]->start_time) && $now <= strtotime($sanpham->khuyenmai[0]->end_time))
            $sale = $sanpham->khuyenmai[0]->sale;

        return $sale;
    }
}
