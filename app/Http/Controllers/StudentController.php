<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::with(['course', 'profile'])->latest()->get();
        $courses = Course::orderBy('name')->get();
        return view('students.index', compact('students', 'courses'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'course_id'     => 'required|exists:courses,id',
            'student_no'    => 'required|string|max:30|unique:students,student_no',
            'first_name'    => 'required|string|max:100',
            'last_name'     => 'required|string|max:100',
            'email'         => 'required|email|unique:students,email',
            'address'       => 'required|string|max:255',
            'contact_no'    => 'required|string|max:20',
            'birthdate'     => 'required|date|before:today',
            'guardian_name' => 'nullable|string|max:100',
        ]);

        DB::transaction(function () use ($data) {
            $student = Student::create([
                'course_id'  => $data['course_id'],
                'student_no' => $data['student_no'],
                'first_name' => $data['first_name'],
                'last_name'  => $data['last_name'],
                'email'      => $data['email'],
            ]);

            $student->profile()->create([
                'address'       => $data['address'],
                'contact_no'    => $data['contact_no'],
                'birthdate'     => $data['birthdate'],
                'guardian_name' => $data['guardian_name'] ?? null,
            ]);
        });

        return redirect()->route('students.index')->with('success', 'Student added.');
    }
}