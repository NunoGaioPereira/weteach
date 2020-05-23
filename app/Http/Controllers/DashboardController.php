<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DashboardController extends Controller
{
    public function index (Request $request)
    {
        return view('dashboard');
    }

    public function profile (Request $request)
    {
        return view('settings.profile');
    }

    public function profile_save (Request $request)
    {
        $user = auth()->user();
        // Validate the response

        // Save the user info
        $user->name = $request->name;
        $user->email = $request->email;

        $photo = $request->photo;
        $filename = Str::slug($request->name) . '-'. uniqid() . '.' . $photo->extension();
        $photo->storeAs('public/images/user', $filename);

        $user->photo = $filename;

        $user->save();

        return back()->with(['alert' => 'Successfully updated your profile info.']);
    }

    // Security
    public function security (Request $request)
    {
        return view('settings.security');
    }

    public function security_save (Request $request)
    {
        echo 'Succesfully saved your password.';
    }

    // Billing
    public function billing (Request $request)
    {
        return view('settings.billing');
    }

    public function billing_save (Request $request)
    {
        echo 'Succesfully saved your billing info.';
    }
}
