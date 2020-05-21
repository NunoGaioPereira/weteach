<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        echo 'Succesfully saved your profile.';
    }
}
