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
        <a href="{{ route('resume.edit') }}"><button>Edit Resume</button></a>
        <a href="{{ route('resume.public', $resume->id) }}"><button>View Public</button></a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit">Logout</button>
        </form>
    </div>

    <div class="right-column">
        <h2>About</h2>
        <p>{{ $resume->about }}</p>

        <h2>Skills</h2>
        <ul>
            {{-- FIX: Added check to ensure $resume->skills is a valid array before looping --}}
            @if(is_array($resume->skills))
                @foreach($resume->skills as $skill)
                    <li>{{ $skill }}</li>
                @endforeach
            @endif
        </ul>

        <h2>Education</h2>
        {{-- FIX: Added check to ensure $resume->education is a valid array before looping --}}
        @if(is_array($resume->education))
            @foreach($resume->education as $edu)
                <p><strong>{{ $edu['level'] }} - {{ $edu['school'] }} ({{ $edu['year'] }})</strong></p>
                <p>Course: {{ $edu['course'] }}</p>
                <p>Relevant: {{ implode(', ', $edu['relevant']) }}</p>
            @endforeach
        @endif

        <h2>Experience</h2>
        {{-- FIX: Added check to ensure $resume->experience is a valid array before looping --}}
        @if(is_array($resume->experience))
            @foreach($resume->experience as $exp)
                <p><strong>{{ $exp['project'] }}</strong>: {{ $exp['description'] }}</p>
            @endforeach
        @endif
    </div>
</div>
@endsection