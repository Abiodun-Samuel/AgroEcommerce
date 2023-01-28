<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use App\Traits\CloudinaryUpload;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use App\Models\User;


class UserDashboardController extends Controller
{
    use CloudinaryUpload;
    public function index(Request $request)
    {
        $orders = [];
        return Inertia::render('User/UserIndex', [
            'orders' => $orders,
        ]);
    }
    public function myProfile()
    {
        return Inertia::render('User/UserProfileIndex', [
            // 'orders' => $orders,
        ]);
    }
    public function updateAvatar(Request $request, User $user)
    {

        $request->validate([
            'avatar' => 'required',
        ]);
        $user->update([
            'avatar' => $request->avatar,
        ]);
        return redirect()->back();
    }

    public function updateProfile(Request $request, User $user)
    {
        $request->validate([
            'email' => 'required|email',
            'gender' => 'required|string',
            'phone' => 'required|string',
            'address' => 'required|string',
            'country' => 'required',
            'state' => 'required|string',
            'city' => 'required|string',
            'dob' => 'required|string',
        ]);

        $user->update([
            'email' => $request->email,
            'gender' => $request->gender,
            'phone' => $request->phone,
            'address' => $request->address,
            'country' => gettype($request->country) == 'array' ? $request->country['name'] : $request->country,
            'state' => $request->state,
            'city' => $request->city,
            'dob' => $request->dob,
            'is_completed' => true
        ]);
        return redirect()->back();
    }
    public function myOrders()
    {
        $orders = [];
        return Inertia::render('User/UserOrderIndex', [
            'orders' => $orders,
        ]);
    }
    /**
     * Display the user's profile form.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Inertia\Response
     */
    public function edit(Request $request)
    {
        return Inertia::render('Dashboard/Edit', [
            'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
            'status' => session('status'),
        ]);
    }

    /**
     * Update the user's profile information.
     *
     * @param  \App\Http\Requests\ProfileUpdateRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProfileUpdateRequest $request)
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('dashboard.edit');
    }

    /**
     * Delete the user's account.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        $request->validate([
            'password' => ['required', 'current-password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}