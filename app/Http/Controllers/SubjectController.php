<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function index()
    {
        $subjects = Subject::latest()->get();
        return view('subjects.index', compact('subjects'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'  => 'required|string|max:100',
            'code'  => 'required|string|max:20|unique:subjects,code',
            'units' => 'required|integer|min:1|max:9',
        ]);

        Subject::create($data);

        return redirect()->route('subjects.index')->with('success', 'Subject added.');
    }
}