@extends('layouts.app')

@section('content')
<div class="card">
    <h2>Add Course</h2>
    <form method="POST" action="{{ route('courses.store') }}">
        @csrf
        <div class="grid">
            <div>
                <label>Course name</label>
                <input type="text" name="name" value="{{ old('name') }}" required>
            </div>
            <div>
                <label>Course code</label>
                <input type="text" name="code" value="{{ old('code') }}" required>
            </div>
        </div>
        <button type="submit">Add Course</button>
    </form>
</div>

<div class="card">
    <h2>Courses</h2>
    <table>
        <thead>
            <tr><th>#</th><th>Name</th><th>Code</th><th>No. of students</th></tr>
        </thead>
        <tbody>
            @forelse ($courses as $course)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $course->name }}</td>
                    <td>{{ $course->code }}</td>
                    <td>{{ $course->students_count }}</td>
                </tr>
            @empty
                <tr><td colspan="4">No courses yet.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection