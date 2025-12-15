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
        // $resume->skills is automatically an array here due to model casting
        $resume = Resume::where('user_id', Auth::id())->firstOrFail();
        return view('resume.edit', compact('resume'));
    }

    // Update resume (MUST NOT contain manual json_encode)
    public function update(Request $request)
    {
        $resume = Resume::where('user_id', Auth::id())->firstOrFail();

        $validated = $request->validate([
            // ... (validation rules)
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'skills' => 'nullable|array',
            'education' => 'nullable|array',
            'experience' => 'nullable|array',
        ]);

        // Handle profile image (including delete logic from prior step)
        if ($request->hasFile('profile_image')) {
            if ($resume->profile_image && Storage::disk('public')->exists(str_replace('storage/', '', $resume->profile_image))) {
                Storage::disk('public')->delete(str_replace('storage/', '', $resume->profile_image));
            }
            $path = $request->file('profile_image')->store('images', 'public');
            $validated['profile_image'] = 'storage/' . $path;
        }

        // The Resume Model handles array-to-JSON conversion automatically.
        $resume->update($validated);

        return redirect()->route('resume.edit')->with('success', 'Resume updated successfully.');
    }

    // Public resume view (MUST NOT contain manual json_decode)
    public function view()
    {
        // $resume->skills is automatically an array here due to model casting
        $resume = Resume::where('user_id', Auth::id())->firstOrFail();
        return view('resume.view', compact('resume'));
    }


    public function public($id)
    {
        // $resume->skills is automatically an array here due to model casting
        $resume = Resume::findOrFail($id);
        return view('resume.public', compact('resume'));
    }
}