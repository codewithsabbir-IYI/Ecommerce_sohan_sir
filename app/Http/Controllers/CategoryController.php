<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('category.index',[
            'categories' =>Category::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('category.create') ;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required|unique:categories,category_name',
            'category_photo' => 'image'
        ]);
        $category_id = Category::insertGetId([
           'category_name' => $request->category_name,
           'created_at' => Carbon::now()
       ]);
       if ($request->hasFile('category_photo')) {

        $new_name = $category_id.".".$request->file('category_photo')->getClientOriginalExtension();
        Image::make($request->file('category_photo'))->resize(300,150)->save(base_path('public/dashboard/uploads/category_photos/'.$new_name));
            Category::find($category_id)->update([
                'category_photo' => $new_name
            ]);

       }

       return redirect('category')->with('category_added','Category Added Succeccfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {

        return view('category.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {

        return view('category.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
       $old_name = $category->category_name;
       $category->update([
            'category_name' => $request->category_name,
        ]);

        if ($request->hasFile('category_photo')) {

            if ($category->category_photo !== 'default_category_photo.jpg') {
                unlink(public_path()."/dashboard/uploads/category_photos/".$category->category_photo);
            }


            $new_name = $category->id.".".$request->file('category_photo')->getClientOriginalExtension();
            Image::make($request->file('category_photo'))->resize(300,150)->save(base_path('public/dashboard/uploads/category_photos/'.$new_name));
                Category::find($category->id)->update([
                    'category_photo' => $new_name
                ]);
        }
        return redirect('category')->with('category_updated',$old_name.'Category Updated Successfully To'.$request->category_name);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return back();
    }

    // thats for harddelete

    public function harddelete($id)
    {
        $photo_name = Category::find($id)->category_photo;
        if ($photo_name !== 'default_category_photo.jpg') {
            unlink(public_path()."/dashboard/uploads/category_photos/".$photo_name);
        }

        Category::find($id)->forceDelete();
        return back()->with('harddelete', 'Category Deleted Forever');
    }
}
