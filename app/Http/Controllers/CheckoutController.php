<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Country;
use App\Models\Order_detail;
use App\Models\Order_summery;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    public function checkout(){
        if(session('s_total_amount')){

            return view('frontend.checkout');
        }else{
            return redirect('cart');
        }
    }
    public function checkout_post(Request $request){
        $order_summery_id = Order_summery::insertGetId([

            'user_id' => auth()->id(),
            'customer_name' => $request->coustomer_name,
            'customer_email' => $request->coustomer_email,
            'customer_country' => Country::find(session('s_country_id'))->country_name,
            'customer_city' => session('s_city_name'),
            'customer_address' => $request->coustomer_address,
            'customer_phone_number' => $request->coustomer_phone_number,
            'customer_notes' => $request->coustomer_note,
            'total_amount' => session('s_total_amount'),
            'discount_amount' => session('s_discount_amount'),
            'shipping_charge' => session('s_shipping_charge'),
            'grand_total' => session('s_grand_total'),
            'coupon_name' => session('s_coupon_name'),
            'payment_method' => $request->payment_method,
            'payment_status' => 'pending',
            'created_at' => Carbon::now()
        ]);


        foreach (Cart::where('user_id', auth()->id())->get() as $cart) {
            Order_detail::insert([
                'order_summery_id' => $order_summery_id,
                'product_id' => $cart->product_id,
                'size_id' => $cart->size_id,
                'color_id' => $cart->color_id,
                'amount' => $cart->user_input_amount,
                'created_at' => Carbon::now()
            ]);
            $cart->delete();
        }
        Session::forget('s_total_amount');
        Session::forget('s_discount_amount');
        Session::forget('s_shipping_charge');
        Session::forget('s_grand_total');
        Session::forget('s_coupon_name');
        return redirect('cart');
    }
}
