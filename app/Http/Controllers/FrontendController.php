<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Coupon;
use App\Models\Frontend;
use App\Models\Inventory;
use App\Models\Product;
use App\Models\Shipping;
use App\Models\Subcategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\If_;

class FrontendController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        $products = Product::all();
        return view('frontend.index',compact('categories', 'products'));
    }
    public function shop()
    {
        if (isset($_GET['search_string'])) {
            $products = Product::where('product_name', 'LIKE', '%'.$_GET['search_string'].'%')
            ->orWhere('product_short_description', 'LIKE', '%'.$_GET['search_string'].'%')->orWhere('product_long_description', 'LIKE', '%'.$_GET['search_string'].'%')->get();

        }else{
            $products = Product::all();

        }

        if (isset($_GET['min']) && isset($_GET['max'])) {
            $q1 = Product::whereBetween('product_discounted_price', [$_GET['min'], $_GET['max']])->get();
            $q2 = Product::whereNull('product_discounted_price')->whereBetween('product_regular_price', [$_GET['min'], $_GET['max']])->get();
            $products = $q1->merge($q2);
        }
        $total_search_product = Product::count();
        return view('frontend.shop',compact('products', 'total_search_product'));

    }
    public function category_details($slug)
    {
        $category_info = Category::where('slug',$slug)->first()->id;
        $subcategory_info = Subcategory::where('category_id','$category_info')->get();
        return view('frontend.category_details',compact('category_info','subcategory_info'));
    }
    public function product_details($slug)
    {
        $product_info = Product::where('slug',$slug)->first();
        $related_products = Product::where('category_id',$product_info->category_id)->get();
        $colors = Inventory::where('product_id', $product_info->id)->groupBy('color_id')->select('color_id')->get();
        return view('frontend.product_details',compact('product_info','related_products','colors'));
    }
    public function getsize(Request $request){
        $strtosend = "<option disable>Choose a size</option>";
        $sizes = Inventory::where([
            'product_id' => $request->product_id,
            'color_id' => $request->color_id
        ])->get();

        foreach ($sizes as $size) {
            $strtosend .= "<option class='size_option' value='". $size->realtionwithSize->id ."' >". $size->realtionwithSize->size_name ."</option>";

            // $strtosend .= "<option>adfasddf</option>";
        }
        return $strtosend;
    }

    public function getstock(Request $request)
    {
        return $stock = Inventory::where([
            'product_id' => $request->product_id,
            'color_id' => $request->color_id,
            'size_id' => $request->size_id
        ])->first()->quantity;

    }
    public function add_to_cart(Request $request)
    {
        $exeists_checker = Cart::where([
            'product_id' => $request->product_id,
            'color_id'   => $request->color_id,
            'size_id'    => $request->size_id,
            'user_id'    => $request->user_id,
        ])->exists();

        if ($exeists_checker) {
            Cart::where([
                'product_id' => $request->product_id,
                'color_id'   => $request->color_id,
                'size_id'    => $request->size_id,
                'user_id'    => $request->user_id,
            ])->increment('user_input_amount', $request->user_input_amount);

        } else {
            Cart::insert([
                'product_id' => $request->product_id,
                'color_id'   => $request->color_id,
                'size_id'    => $request->size_id,
                'user_input_amount' => $request->user_input_amount,
                'user_id'    => $request->user_id,
                'created_at' => Carbon::now(),
            ]);

        }

      echo "Cart Added Successfully Please Check Your Cart";
    }
    public function get_city(Request $request){
        $str_to_send = "<option> Select Your City </option>";
        $cities = Shipping::where('country_id', $request->country_id)->get();
        foreach ($cities as $city) {
            $str_to_send .= "<option value='$city->shipping_charge'>$city->city_name</option>";

        }
        echo $str_to_send ;
    }
    public function check_cuppon(Request $request){

         //return $request->total_amount;
        $exists =  Coupon::where('coupon_name', $request->coupon_name)->exists();
        $coupon =  Coupon::where('coupon_name', $request->coupon_name)->first();
        // return $coupon->coupon_name;
        // return $coupon->coupon_limit;
        // return $coupon->coupon_validity;
        // return $coupon->coupon_type;
        // return $coupon->discount_amount;
        if($exists){

            if($coupon->coupon_limit == 0){
                return response()->json(['error' => 'This coupon Limit is already over']);
            }else{
                if($coupon->coupon_validity < Carbon::today()){
                    return response()->json(['error' => 'This coupon validity is already over']);
                }else{
                    if($coupon->coupon_type == 1){
                        $coupon_discount_amount = ($request->total_amount / 100) * $coupon->discount_amount;
                        echo $coupon_discount_amount;
                    }else{
                        echo $coupon->discount_amount;
                    }
                }
            }
        }else{
            // return response(['error'=>'This Is Not Our Coupon']);
            return response()->json(['error' => 'This is not our coupon']);
        }
    }
    public function checkout_redirect(Request $request){

       session()->put('s_total_amount', $request->total_amount);
       session()->put('s_discount_amount', $request->discount_amount);
       session()->put('s_shipping_charge', $request->shipping_charge);
       session()->put('s_grand_total', $request->grand_total);
       session()->put('s_country_id', $request->country_id);
       session()->put('s_city_name', $request->city_name);
       session()->put('s_coupon_name', $request->coupon_name);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Frontend  $frontend
     * @return \Illuminate\Http\Response
     */
    public function show(Frontend $frontend)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Frontend  $frontend
     * @return \Illuminate\Http\Response
     */
    public function edit(Frontend $frontend)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Frontend  $frontend
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Frontend $frontend)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Frontend  $frontend
     * @return \Illuminate\Http\Response
     */
    public function destroy(Frontend $frontend)
    {
        //
    }
}
