<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;

class AdminProfileController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    //  * @return \Illuminate\Http\Response
    */
    public function index()
    {
        return Inertia::render('Admin/Profile/ProfileIndex');
    }
    public function updateAvatar(Request $request, User $user)
    {
        $request->validate([
            'avatar' => ['required'],
        ]);
        $user->update([
            'avatar' => $request->avatar,
        ]);
        return Redirect::route('admin.index');
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
        return Redirect::route('admin.index');
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
        //
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
    public function destroy($id)
    {
        //
    }
}