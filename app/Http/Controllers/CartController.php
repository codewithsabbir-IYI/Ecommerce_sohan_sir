<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\FuncCall;

class CartController extends Controller
{
    public function cart(){
        $carts = Cart::where('user_id', auth()->id())->get();
        return view('frontend.cart', compact('carts'));
    }

    public function remove_cart(Cart $id){
        $id->delete();
        return back();
    }
    public function clear_cart(){
        Cart::where('user_id', auth()->id())->delete();
        return back();
    }
    public function cart_item_all_update(Request $request){
        foreach ($request->cart_item as $cart_id => $user_input_amount) {

            Cart::find($cart_id)->update([
                'user_input_amount' => $user_input_amount
            ]);

        }
        return back();
    }
}
