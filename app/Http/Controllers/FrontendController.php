<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Frontend;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Http\Request;

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
        return view('frontend.product_details',compact('product_info','related_products'));
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
