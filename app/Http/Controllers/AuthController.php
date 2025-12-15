<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Resume; // FIX: Import Resume model to fetch data

class AuthController extends Controller
{
    // Show login form (FIXED: Passing $resume for the public link in the view)
    public function showLoginForm()
    {
        // Fetch the first resume entry to provide a link to the public view on the login page.
        // Assumes at least one resume exists, otherwise handle in the view (e.g., check for $resume existence).
        $resume = Resume::first(); 
        return view('auth.login', compact('resume'));
    }

    // Handle login using username
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('resume.view');
        }

        return back()->with('error', 'Invalid username or password.');
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}