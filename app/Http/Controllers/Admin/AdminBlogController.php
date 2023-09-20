<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Traits\CloudinaryUpload;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redirect;

class AdminBlogController extends Controller
{
    use CloudinaryUpload;

    /**
    * Display a listing of the resource.
    *
    //  * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $blogs = Blog::get();
        return Inertia::render('Admin/Blog/BlogIndex', [
            'blogs' => $blogs,
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
    //  * @param  \Illuminate\Http\Request  $request
    //  * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        $request->validate([
            'blog_img' => ['required'],
            'blog_title' => ['required'],
            'blog_keywords' => 'string',
            'blog_description' => 'string',
        ]);
        $banner_img = $this->uploadImage($request->file('blog_img'), $request->folder);
        Blog::create([
            'user_id' => auth()->user()->id,
            'image' => $banner_img,
            'title' => $request->blog_title,
            'keywords' => $request->blog_keywords,
            'description' => $request->blog_description,
            'slug' => Str::slug($request->blog_title . ' ' . Str::random(10), '-'),
        ]);
        return Redirect::route('admin.blog.index');
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
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {
        $blog->delete();
        return redirect()->back();
    }
}