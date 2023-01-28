<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Category;
use App\Traits\CloudinaryUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Illuminate\Support\Str;

class AdminCategoryController extends Controller
{
    use CloudinaryUpload;

    public function index()
    {
        $categories = Category::get();
        return Inertia::render('Admin/Category/CategoryIndex', [
            'categories' => $categories,
        ]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_img' => ['required'],
            'category_title' => ['required'],
        ]);
        $banner_img = $this->uploadImage($request->file('category_img'), $request->folder);
        Category::create([
            'banner_img' => $banner_img,
            'title' => $request->category_title,
            'slug' => Str::slug($request->category_title, '-'),
        ]);
        return Redirect::route('admin.category.index');
    }

    public function show($id)
    {
        //
    }

    public function edit(Category $category)
    {
        return Inertia::render('Admin/Category/CategoryEdit', [
            'category' => $category,
        ]);
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'category_img' => ['required'],
            'category_title' => ['required'],
        ]);

        if ($request->hasFile('category_img')) {
            $val = $this->searchImage($request->category_img_id);
            if ($val['total_count'] >= 1) {
                $this->deleteImage($request->category_img_id);
                $banner_img = $this->uploadImage($request->file('category_img'), $request->folder);
                $category->update([
                    'banner_img' => $banner_img,
                    'title' => $request->category_title,
                    'slug' => Str::slug($request->category_title, '-'),
                ]);
            } else {
                $banner_img = $this->uploadImage($request->file('category_img'), $request->folder);
                $category->update([
                    'banner_img' => $banner_img,
                    'title' => $request->category_title,
                    'slug' => Str::slug($request->category_title, '-'),
                ]);
            }
        } else {
            $category->update([
                'banner_img' => $request->category_img,
                'title' => $request->category_title,
                'slug' => Str::slug($request->category_title, '-'),
            ]);
        }
        return Redirect::route('admin.category.index');
    }

    public function destroy(Category $category)
    {
        $this->deleteImage(json_decode($category->banner_img)->img_id);
        $category->delete();
        return Redirect::route('admin.category.index');
    }
}