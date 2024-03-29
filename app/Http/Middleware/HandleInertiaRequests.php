<?php

namespace App\Http\Middleware;

use App\Models\Admin\Category;
// use App\Models\User;
use App\Models\Admin\Setting;
use Illuminate\Http\Request;
use Inertia\Middleware;
use Tightenco\Ziggy\Ziggy;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function version(Request $request)
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed[]
     */
    public function share(Request $request)
    {

        $cartCollection = \Cart::getContent();
        $cartCount = $cartCollection->count();

        return array_merge(parent::share($request), [
            'auth' => [
                'user' => auth()->user() ? auth()->user() : null,
                // 'user' => $request->user() ? $request->user()->withCount('cart', 'wishlist')->first() : null,
            ],
            'data' => [
                'categories' => Category::with('subcategory.products')->get(),
                'settings' => Setting::first(),
                'cartCount' => $cartCount,
            ],
            'ziggy' => function () use ($request) {
                return array_merge((new Ziggy)->toArray(), [
                    'location' => $request->url(),
                ]);
            },
            'order' => [
                'myOrderId' => fn () => $request->session()->get('myOrderId'),
            ],
        ]);
    }
}