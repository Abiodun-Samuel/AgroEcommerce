<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Promotion;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Traits\CloudinaryUpload;

class AdminPromotionController extends Controller
{

    use CloudinaryUpload;

    /**
    * Display a listing of the resource.
    *
    //  * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $promotions = Promotion::get();
        return Inertia::render('Admin/Promotion/PromotionIndex', [
            'promotions' => $promotions
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
     *
     */
    public function store(Request $request)
    {
        $request->validate([
            'promotion_img' => 'required',
            'promotion_desc' => 'string|nullable',
            'promotion_title' => 'string|nullable',
        ]);
        $banner_img = $this->uploadImage($request->file('promotion_img'), $request->folder);
        Promotion::create([
            'banner_img' => $banner_img,
            'title' => $request->promotion_title,
            'description' => $request->promotion_desc,
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
     *
     */
    public function edit(Promotion $promotion)
    {
        return Inertia::render('Admin/Promotion/PromotionEdit', [
            'promotion' => $promotion
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Promotion $promotion)
    {
        $request->validate([
            'promotion_img' => 'required',
            'promotion_title' => 'string|nullable',
            'promotion_desc' => 'string|nullable'
        ]);

        if ($request->hasFile('promotion_img')) {
            $val = $this->searchImage($request->promotion_img_id);
            if ($val['total_count'] >= 1) {
                $this->deleteImage($request->promotion_img_id);
                $banner_img = $this->uploadImage($request->file('promotion_img'), $request->folder);
                $promotion->update([
                    'banner_img' => $banner_img,
                    'title' => $request->promotion_title,
                    'description' => $request->promotion_desc,
                ]);
            } else {
                $banner_img = $this->uploadImage($request->file('promotion_img'), $request->folder);
                $promotion->update([
                    'banner_img' => $banner_img,
                    'title' => $request->promotion_title,
                    'description' => $request->promotion_desc,
                ]);
            }
        } else {
            $promotion->update([
                'banner_img' => $request->promotion_img,
                'title' => $request->promotion_title,
                'description' => $request->promotion_desc,
            ]);
        }
        return redirect()->route('admin.promotion.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     *
     */
    public function destroy(Promotion $promotion)
    {
        $this->deleteImage(json_decode($promotion->banner_img)->img_id);
        $promotion->delete();
        return redirect()->back();
    }
}