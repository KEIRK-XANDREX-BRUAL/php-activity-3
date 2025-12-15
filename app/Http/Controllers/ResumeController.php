<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Resume;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ResumeController extends Controller
{
    
    // Show edit form
    public function edit()
    {
        $resume = Resume::where('user_id', Auth::id())->firstOrFail();
        return view('resume.edit', compact('resume'));
    }

    // Update resume
    public function update(Request $request)
    {
        $resume = Resume::where('user_id', Auth::id())->firstOrFail();

        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'field' => 'required|string|max:255',
            'about' => 'nullable|string',
            'github' => 'nullable|url',
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:50',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'skills' => 'nullable|array',
            'education' => 'nullable|array',
            'experience' => 'nullable|array',
        ]);

        // Handle profile image
        if ($request->hasFile('profile_image')) {
            $path = $request->file('profile_image')->store('images', 'public');
            $validated['profile_image'] = 'storage/' . $path;
        }

        // Convert array fields to JSON before saving
        if (isset($validated['skills'])) {
            $validated['skills'] = json_encode($validated['skills']);
        }
        if (isset($validated['education'])) {
            $validated['education'] = json_encode($validated['education']);
        }
        if (isset($validated['experience'])) {
            $validated['experience'] = json_encode($validated['experience']);
        }

        $resume->update($validated);

        return redirect()->route('resume.edit')->with('success', 'Resume updated successfully.');
    }

    // Public resume view
    public function view()
    {
        $resume = Resume::where('user_id', Auth::id())->firstOrFail();

        $resume->skills = json_decode($resume->skills, true) ?? [];
        $resume->education = json_decode($resume->education, true) ?? [];
        $resume->experience = json_decode($resume->experience, true) ?? [];

        return view('resume.view', compact('resume'));
    }


    public function public($id)
    {
        $resume = Resume::findOrFail($id);

        $resume->skills = json_decode($resume->skills, true) ?? [];
        $resume->education = json_decode($resume->education, true) ?? [];
        $resume->experience = json_decode($resume->experience, true) ?? [];

        return view('resume.public', compact('resume'));
    }

    public function showLoginForm()
    {
        $resume = \App\Models\Resume::first(); // fetch the first resume
        return view('auth.login', compact('resume'));
    }


}
