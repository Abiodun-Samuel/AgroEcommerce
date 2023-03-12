<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PagesController extends Controller
{
    //     about
// blogs
// contact
// agroInput
// agriCourt
// harvestYield
    public function blogs()
    {
        $blogs = Blog::get();
        return Inertia::render('BlogPage', [
            'blogs' => $blogs,
        ]);
    }
    public function blogsDetails(Blog $blog)
    {
        $blog->update([
            'views' => ++$blog->views
        ]);
        $blog = $blog->with('user')->first();
        return Inertia::render('BlogDetailsPage', [
            'blog' => $blog,
        ]);
    }
}