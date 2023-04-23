<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Mail\ContactMail;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Inertia\Inertia;

class PagesController extends Controller
{
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
    public function about()
    {
        return Inertia::render('AboutPage');
    }
    public function agroInput()
    {
        return Inertia::render('Services/AgroInput');
    }
    public function agriCourt()
    {
        return Inertia::render('Services/AgriCourt');
    }
    public function harvestYield()
    {
        return Inertia::render('Services/HarvestYield');
    }
    public function contact()
    {
        return Inertia::render('ContactPage');
    }
    public function sendMessage(Request $request)
    {
        $ContactData = $request->validate([
            'name' => 'required|string|max:20|min:3',
            'phone' => 'required|numeric|digits:11',
            'email' => 'required|email:rfc,strict,filter',
            'subject' => 'required|string',
            'message' => 'required|string',
        ]);
        Mail::to('contact@superoagrobase.com')->send(new ContactMail($ContactData));
        return redirect()->back();
    }
}