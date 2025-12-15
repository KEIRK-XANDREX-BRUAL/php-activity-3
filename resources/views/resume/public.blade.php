@extends('layouts.app')

@section('content')
<div class="resume-container">
    <div class="left-column">
        <div class="profile-pic">
            <img src="{{ asset($resume->profile_image) }}" alt="Profile Picture">
        </div>
        <h3>{{ $resume->full_name }}</h3>
        <p>{{ $resume->field }}</p>
        <ul>
            <li>Email: {{ $resume->email }}</li> 
            <li>Phone: {{ $resume->phone }}</li>
            <li>Address: {{ $resume->address }}</li>
            <li>GitHub: <a href="{{ $resume->github }}" target="_blank">{{ $resume->github }}</a></li>
        </ul>
        <a href="{{ route('login') }}"><button>Back to Login</button></a>
    </div>

    <div class="right-column">
        <h2>About</h2>
        <p>{{ $resume->about }}</p>

        <h2>Skills</h2>
        <ul>
            @foreach($resume->skills as $skill)
                <li>{{ $skill }}</li>
            @endforeach
        </ul>

        <h2>Education</h2>
        @foreach($resume->education as $edu)
            <p><strong>{{ $edu['level'] }} - {{ $edu['school'] }} ({{ $edu['year'] }})</strong></p>
            <p>Course: {{ $edu['course'] }}</p>
            <p>Relevant: {{ implode(', ', $edu['relevant']) }}</p>
        @endforeach

        <h2>Experience</h2>
        @foreach($resume->experience as $exp)
            <p><strong>{{ $exp['project'] }}</strong>: {{ $exp['description'] }}</p>
        @endforeach
    </div>
</div>
@endsection
