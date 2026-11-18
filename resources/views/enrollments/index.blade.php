@extends('layouts.app')

@section('content')
<div class="card">
    <h2>Assign Subject to Student</h2>
    <form method="POST" action="{{ route('enrollments.store') }}">
        @csrf
        <div class="grid">
            <div>
                <label>Student</label>
                <select name="student_id" required>
                    <option value="">-- Select student --</option>
                    @foreach ($students as $student)
                        <option value="{{ $student->id }}" @selected(old('student_id') == $student->id)>
                            {{ $student->last_name }}, {{ $student->first_name }} ({{ $student->student_no }})
                        </option>
                    @endforeach
                </select>
            </div>
            <div>
                <label>Subject</label>
                <select name="subject_id" required>
                    <option value="">-- Select subject --</option>
                    @foreach ($subjects as $subject)
                        <option value="{{ $subject->id }}" @selected(old('subject_id') == $subject->id)>
                            {{ $subject->code }} - {{ $subject->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <button type="submit">Assign Subject</button>
    </form>
</div>

<div class="card">
    <h2>Student Enrollments</h2>
    <table>
        <thead>
            <tr><th>#</th><th>Student</th><th>Subjects</th><th>Total units</th></tr>
        </thead>
        <tbody>
            @forelse ($students as $student)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $student->first_name }} {{ $student->last_name }}</td>
                    <td>
                        @forelse ($student->subjects as $subject)
                            {{ $subject->code }}@if (! $loop->last), @endif
                        @empty
                            -
                        @endforelse
                    </td>
                    <td>{{ $student->subjects->sum('units') }}</td>
                </tr>
            @empty
                <tr><td colspan="4">No students yet.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection