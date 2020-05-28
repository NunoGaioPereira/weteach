<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function courses(Request $request)
    {
        return view('courses');
    }

    public function course(Request $request, $subdomain)
    {
        $course = \App\Course::where('subdomain', '=', $subdomain)->firstOrFail();
        return view('course.index', compact('course'));
    }
}
