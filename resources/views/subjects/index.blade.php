@extends('layouts.app')

@section('content')
<div class="card">
    <h2>Add Subject</h2>
    <form method="POST" action="{{ route('subjects.store') }}">
        @csrf
        <div class="grid">
            <div>
                <label>Subject name</label>
                <input type="text" name="name" value="{{ old('name') }}" required>
            </div>
            <div>
                <label>Subject code</label>
                <input type="text" name="code" value="{{ old('code') }}" required>
            </div>
            <div>
                <label>Units</label>
                <input type="number" name="units" value="{{ old('units', 3) }}" min="1" max="9" required>
            </div>
        </div>
        <button type="submit">Add Subject</button>
    </form>
</div>

<div class="card">
    <h2>Subjects</h2>
    <table>
        <thead>
            <tr><th>#</th><th>Name</th><th>Code</th><th>Units</th></tr>
        </thead>
        <tbody>
            @forelse ($subjects as $subject)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $subject->name }}</td>
                    <td>{{ $subject->code }}</td>
                    <td>{{ $subject->units }}</td>
                </tr>
            @empty
                <tr><td colspan="4">No subjects yet.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection