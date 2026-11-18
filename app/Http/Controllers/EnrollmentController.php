<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    public function index()
    {
        $students = Student::with('subjects')->orderBy('last_name')->get();
        $subjects = Subject::orderBy('name')->get();
        return view('enrollments.index', compact('students', 'subjects'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'student_id' => 'required|exists:students,id',
            'subject_id' => 'required|exists:subjects,id',
        ]);

        Student::findOrFail($data['student_id'])
            ->subjects()
            ->syncWithoutDetaching([$data['subject_id']]);

        return redirect()->route('enrollments.index')->with('success', 'Subject assigned to student.');
    }
}