<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Image;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

       return view('product.create',[
           'categories' => Category::all(),
           'subcategories' => Subcategory::all()
       ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $slug = Str::slug($request->product_name)."_".Str::random(5);
        $product_sku = Str::lower(substr($request->product_name, 0,3).rand());
        $product_id = Product::insertGetId($request->except("_token")+[
            'slug' =>  $slug,
            'product_sku' => $product_sku,
            'created_at' => Carbon::now()
        ]);
        if ($request->hasFile('product_thumbnail_photo')) {

            $new_name = $product_id.".".$request->file('product_thumbnail_photo')->getClientOriginalExtension();
            Image::make($request->file('product_thumbnail_photo'))->resize(270,310)->save(base_path('public/frontend/uploads/product_thumbnail_photo/'.$new_name));
                Product::find($product_id)->update([
                    'category_photo' => $new_name
                ]);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
