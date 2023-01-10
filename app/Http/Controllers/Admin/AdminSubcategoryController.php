<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Category;
use App\Models\Admin\SubCategory;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redirect;

class AdminSubcategoryController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    //  * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $subcategories = SubCategory::with('category')->get();
        $categories = Category::get();
        return Inertia::render('Admin/Subcategory/Index', [
            'subcategories' => $subcategories,
            'categories' => $categories,
        ]);
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
    //  * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        $request->validate([
            'subcategory_img' => ['required'],
            'subcategory_title' => ['required'],
            'category_id' => ['required'],
        ]);

        SubCategory::create([
            'banner_img' => $request->subcategory_img,
            'title' => $request->subcategory_title,
            'slug' => Str::slug($request->subcategory_title, '-'),
            'category_id' => $request->category_id,
        ]);
        return Redirect::route('admin.subcategory.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    //  * @return \Illuminate\Http\Response
    */
    public function destroy(Subcategory $subcategory)
    {
        $subcategory->delete();
        return Redirect::route('admin.subcategory.index');
    }
}