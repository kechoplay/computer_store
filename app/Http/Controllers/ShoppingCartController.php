<?php

namespace App\Http\Controllers;

use App\SanPham;
use Gloudemans\Shoppingcart\Facades\Cart;
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

        $shoppingCart = Cart::content();
        $listCartId[] = $id;
        Session::put('cart', $listCartId);
        dd(Session::all());
        foreach ($shoppingCart as $cart) {
//            if (!in_array($cart->id, $listCartId))
//                $listCartId[] = $cart->id;

            if ($id == $cart->id) {
                if ($quantity != null)
                    Cart::update($cart->rowId, $quantity);
                else
                    Cart::update($cart->rowId, 1);
            }
        }

//        if (!in_array($id, $listCartId)) {
//            if ($quantity != null)
//                Cart::add($id, $product->product_name, $quantity, $price);
//            else
//                Cart::add($id, $product->product_name, 1, $price);
//        }

        return redirect()->back();
    }
}
