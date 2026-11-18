<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use Illuminate\Support\Facades\Route;

// Only for people who are NOT logged in
Route::middleware(['guest', 'nocache'])->group(function () {
    Route::get('/login', [AuthController::class, 'show'])->name('login');

    Route::post('/login', [AuthController::class, 'login'])
        ->name('login.attempt')
        ->middleware('once');

    Route::post('/register', [AuthController::class, 'register'])
        ->name('register')
        ->middleware(['once', 'throttle:10,1']);
});

// Only for logged-in users
Route::middleware(['auth', 'nocache', 'once'])->group(function () {
    Route::redirect('/', '/students');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::resource('courses', CourseController::class)->only(['index', 'store']);
    Route::resource('subjects', SubjectController::class)->only(['index', 'store']);
    Route::resource('students', StudentController::class)->only(['index', 'store']);
    Route::resource('enrollments', EnrollmentController::class)->only(['index', 'store']);
});