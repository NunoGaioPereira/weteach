<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function courses(Request $request)
    {
        return view('courses');
    }
}
