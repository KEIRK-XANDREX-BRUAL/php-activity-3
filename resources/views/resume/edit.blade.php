@extends('layouts.app')

@section('content')
<div class="resume-container">
    <div class="right-column">
        <h2>Edit Resume</h2>
        @if(session('success'))
            <div class="success">{{ session('success') }}</div>
        @endif
        <form action="{{ route('resume.update') }}" method="POST" enctype="multipart/form-data" class="resume-form">
            @csrf
            <label>Full Name</label>
            <input type="text" name="full_name" value="{{ $resume->full_name }}" required>

            <label>Field</label>
            <input type="text" name="field" value="{{ $resume->field }}" required>

            <label>Email</label>
            <input type="email" name="email" value="{{ $resume->email }}" required> <!-- added email -->

            <label>About</label>
            <textarea name="about" rows="3">{{ $resume->about }}</textarea>

            <label>Github</label>
            <input type="text" name="github" value="{{ $resume->github }}">

            <label>Address</label>
            <input type="text" name="address" value="{{ $resume->address }}">

            <label>Phone</label>
            <input type="text" name="phone" value="{{ $resume->phone }}">

            <label>Profile Image</label>
            <input type="file" name="profile_image">

            <button type="submit">Save Changes</button>
        </form>
    </div>
</div>
@endsection
