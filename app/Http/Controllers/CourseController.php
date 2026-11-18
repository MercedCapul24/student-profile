<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::withCount('students')->latest()->get();
        return view('courses.index', compact('courses'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:100',
            'code' => 'required|string|max:20|unique:courses,code',
        ]);

        Course::create($data);

        return redirect()->route('courses.index')->with('success', 'Course added.');
    }
}