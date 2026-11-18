@extends('layouts.app')

@section('content')
<div class="card">
    <h2>Add Student</h2>
    <form method="POST" action="{{ route('students.store') }}">
        @csrf
        <div class="grid">
            <div>
                <label>Course</label>
                <select name="course_id" required>
                    <option value="">-- Select course --</option>
                    @foreach ($courses as $course)
                        <option value="{{ $course->id }}" @selected(old('course_id') == $course->id)>
                            {{ $course->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div>
                <label>Student no.</label>
                <input type="text" name="student_no" value="{{ old('student_no') }}" required>
            </div>
            <div>
                <label>First name</label>
                <input type="text" name="first_name" value="{{ old('first_name') }}" required>
            </div>
            <div>
                <label>Last name</label>
                <input type="text" name="last_name" value="{{ old('last_name') }}" required>
            </div>
            <div>
                <label>Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required>
            </div>
            <div>
                <label>Address</label>
                <input type="text" name="address" value="{{ old('address') }}" required>
            </div>
            <div>
                <label>Contact no.</label>
                <input type="text" name="contact_no" value="{{ old('contact_no') }}" required>
            </div>
            <div>
                <label>Birthdate</label>
                <input type="date" name="birthdate" value="{{ old('birthdate') }}" required>
            </div>
            <div>
                <label>Guardian name (optional)</label>
                <input type="text" name="guardian_name" value="{{ old('guardian_name') }}">
            </div>
        </div>
        <button type="submit">Add Student</button>
    </form>
</div>

<div class="card">
    <h2>Students</h2>
    <table>
        <thead>
            <tr>
                <th>#</th><th>Student no.</th><th>Name</th><th>Course</th>
                <th>Email</th><th>Address</th><th>Contact</th><th>Birthdate</th><th>Guardian</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($students as $student)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $student->student_no }}</td>
                    <td>{{ $student->first_name }} {{ $student->last_name }}</td>
                    <td>{{ $student->course->name }}</td>
                    <td>{{ $student->email }}</td>
                    <td>{{ $student->profile->address ?? '-' }}</td>
                    <td>{{ $student->profile->contact_no ?? '-' }}</td>
                    <td>{{ $student->profile->birthdate ?? '-' }}</td>
                    <td>{{ $student->profile->guardian_name ?? '-' }}</td>
                </tr>
            @empty
                <tr><td colspan="9">No students yet.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection