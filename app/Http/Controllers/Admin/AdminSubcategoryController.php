<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Category;
use App\Models\Admin\Subcategory;
use App\Traits\CloudinaryUpload;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redirect;

class AdminSubcategoryController extends Controller
{
    use CloudinaryUpload;

    /**
    * Display a listing of the resource.
    *
    //  * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $subcategories = Subcategory::with('category')->get();
        $categories = Category::get();
        return Inertia::render('Admin/Subcategory/SubcategoryIndex', [
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
        $banner_img = $this->uploadImage($request->file('subcategory_img'), $request->folder);
        Subcategory::create([
            'banner_img' => $banner_img,
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
    //  * @return \Illuminate\Http\Response
    */
    public function edit(Subcategory $subcategory)
    {
        return Inertia::render('Admin/Subcategory/SubcategoryEdit', [
            'subcategory' => $subcategory,
        ]);
    }

    public function update(Request $request, Subcategory $subcategory)
    {
        //          category_id: props.subcategory.category_id,
//   subcategory_img: props.subcategory.banner_img,
//   subcategory_title: props.subcategory.title,
//   subcategory_img_id: JSON.parse(props.subcategory.banner_img)?.img_id,
//   folder: "subcategory",
        $request->validate([
            'subcategory_img' => ['required'],
            'subcategory_title' => ['required'],
            'category_id' => ['required'],
            'folder' => ['required'],
            'subcategory_img_id' => ['required'],
        ]);

        if ($request->hasFile('subcategory_img')) {
            $val = $this->searchImage($request->subcategory_img_id);
            if ($val['total_count'] >= 1) {
                $this->deleteImage($request->subcategory_img_id);
                $banner_img = $this->uploadImage($request->file('subcategory_img'), $request->folder);
                $subcategory->update([
                    'banner_img' => $banner_img,
                    'title' => $request->subcategory_title,
                    'slug' => Str::slug($request->subcategory_title, '-'),
                    'category_id' => $request->category_id
                ]);
            } else {
                $banner_img = $this->uploadImage($request->file('subcategory_img'), $request->folder);
                $subcategory->update([
                    'banner_img' => $banner_img,
                    'title' => $request->subcategory_title,
                    'slug' => Str::slug($request->subcategory_title, '-'),
                    'category_id' => $request->category_id
                ]);
            }
        } else {
            $subcategory->update([
                'banner_img' => $request->subcategory_img,
                'title' => $request->subcategory_title,
                'slug' => Str::slug($request->subcategory_title, '-'),
                'category_id' => $request->category_id
            ]);
        }
        return Redirect::route('admin.subcategory.index');
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    //  * @return \Illuminate\Http\Response
    */
    public function destroy(Subcategory $subcategory)
    {
        $this->deleteImage(json_decode($subcategory->banner_img)->img_id);
        $subcategory->delete();
        return Redirect::route('admin.subcategory.index');
    }
}