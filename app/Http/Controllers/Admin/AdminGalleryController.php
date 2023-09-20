<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Traits\CloudinaryUpload;

class AdminGalleryController extends Controller
{
    use CloudinaryUpload;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $galleries = Gallery::get();
        return Inertia::render('Admin/Gallery/GalleryIndex', [
            'galleries' => $galleries
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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'gallery_img' => 'required',
            'gallery_title' => 'string|nullable',
            'width' => 'required|string',
            'height' => 'required|string'
        ]);
        $gallery_img = $this->uploadImage($request->file('gallery_img'), $request->folder);
        Gallery::create([
            'gallery_img' => $gallery_img,
            'title' => $request->gallery_title,
            'width' => $request->width,
            'height' => $request->height,
        ]);
        return redirect()->back();
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
    public function edit(Gallery $gallery)
    {
        return Inertia::render('Admin/Gallery/GalleryEdit', [
            'gallery' => $gallery
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gallery $gallery)
    {
        $request->validate([
            'gallery_img' => 'required',
            'gallery_title' => 'string|nullable',
            'width' => 'required|string',
            'height' => 'required|string'
        ]);

        if ($request->hasFile('gallery_img')) {
            $val = $this->searchImage($request->gallery_img_id);
            if ($val['total_count'] >= 1) {
                $this->deleteImage($request->gallery_img_id);
                $gallery_img = $this->uploadImage($request->file('gallery_img'), $request->folder);
                $gallery->update([
                    'gallery_img' => $gallery_img,
                    'title' => $request->gallery_title,
                    'width' => $request->width,
                    'height' => $request->height,
                ]);
            } else {
                $gallery_img = $this->uploadImage($request->file('gallery_img'), $request->folder);
                $gallery->update([
                    'gallery_img' => $gallery_img,
                    'title' => $request->gallery_title,
                    'width' => $request->width,
                    'height' => $request->height,
                ]);
            }
        } else {
            $gallery->update([
                'gallery_img' => $request->gallery_img,
                'title' => $request->gallery_title,
                'width' => $request->width,
                'height' => $request->height,
            ]);
        }
        return redirect()->route('admin.gallery.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gallery $gallery)
    {
        $this->deleteImage(json_decode($gallery->gallery_img)->img_id);
        $gallery->delete();
        return redirect()->back();
    }
}
