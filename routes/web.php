<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ResumeController;

Route::get('/', function () {
    return redirect()->route('login');
});

// Authentication
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Resume routes (auth required)
Route::get('/resume/view', [ResumeController::class, 'view'])->name('resume.view')->middleware('auth');
Route::get('/resume/edit', [ResumeController::class, 'edit'])->name('resume.edit')->middleware('auth');
Route::post('/resume/update', [ResumeController::class, 'update'])->name('resume.update')->middleware('auth');

// Public resume (accessible to anyone)
Route::get('/resume/public/{id}', [ResumeController::class, 'public'])->name('resume.public');
