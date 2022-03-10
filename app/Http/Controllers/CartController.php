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
}
