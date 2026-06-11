<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\AdministratorController;
use App\Http\Controllers\CourseController;
use Illuminate\Support\Facades\Route;

// Home page - public
Route::get('/', function () {
    return view('home');
});

// Help / User Guide - authenticated
Route::get('/help', function () {
    return view('help');
})->middleware('auth')->name('help');

Route::get('/dashboard', function () {
    $stats = [
        'students'       => \App\Models\Student::count(),
        'teachers'       => \App\Models\Teacher::count(),
        'administrators' => \App\Models\Administrator::count(),
        'courses'        => \App\Models\Course::count(),
        'enrollments'    => \App\Models\Enrollment::count(),
    ];

    // Chart data — students per section
    $studentsBySection = \App\Models\Student::selectRaw('section, count(*) as total')
        ->groupBy('section')->orderBy('total','desc')->get();

    // Chart data — enrollments per course
    $enrollmentsByCourse = \App\Models\Course::withCount('students')
        ->orderBy('students_count','desc')->take(8)->get();

    return view('dashboard', compact('stats', 'studentsBySection', 'enrollmentsByCourse'));
})->middleware(['auth'])->name('dashboard');

// Profile routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ── Students ──────────────────────────────────────────
Route::middleware('auth')->group(function () {
    Route::get('/students', [StudentController::class, 'index'])->name('students.index');
    Route::get('/students/search', [StudentController::class, 'search'])->name('students.search');

    // Admin-only CRUD — must be before /{student} to avoid wildcard conflict
    Route::middleware('role:admin')->group(function () {
        Route::get('/students/create', [StudentController::class, 'create'])->name('students.create');
        Route::post('/students', [StudentController::class, 'store'])->name('students.store');
        Route::get('/students/{student}/edit', [StudentController::class, 'edit'])->name('students.edit');
        Route::put('/students/{student}', [StudentController::class, 'update'])->name('students.update');
        Route::delete('/students/{student}', [StudentController::class, 'destroy'])->name('students.destroy');
    });

    // Show — after /create to avoid wildcard catching "create"
    Route::get('/students/{student}', [StudentController::class, 'show'])->name('students.show');
});

// ── Teachers ──────────────────────────────────────────
Route::middleware('auth')->group(function () {
    Route::get('/teachers', [TeacherController::class, 'index'])->name('teachers.index');
    Route::get('/teachers/search', [TeacherController::class, 'search'])->name('teachers.search');

    // Admin-only CRUD — must be before /{teacher}
    Route::middleware('role:admin')->group(function () {
        Route::get('/teachers/create', [TeacherController::class, 'create'])->name('teachers.create');
        Route::post('/teachers', [TeacherController::class, 'store'])->name('teachers.store');
        Route::get('/teachers/{teacher}/edit', [TeacherController::class, 'edit'])->name('teachers.edit');
        Route::put('/teachers/{teacher}', [TeacherController::class, 'update'])->name('teachers.update');
        Route::delete('/teachers/{teacher}', [TeacherController::class, 'destroy'])->name('teachers.destroy');
    });

    // Show — after /create
    Route::get('/teachers/{teacher}', [TeacherController::class, 'show'])->name('teachers.show');
});

// ── Administrators ────────────────────────────────────
Route::middleware('auth')->group(function () {
    Route::get('/administrators', [AdministratorController::class, 'index'])->name('administrators.index');
    Route::get('/administrators/search', [AdministratorController::class, 'search'])->name('administrators.search');

    // Admin-only CRUD — must be before /{administrator}
    Route::middleware('role:admin')->group(function () {
        Route::get('/administrators/create', [AdministratorController::class, 'create'])->name('administrators.create');
        Route::post('/administrators', [AdministratorController::class, 'store'])->name('administrators.store');
        Route::get('/administrators/{administrator}/edit', [AdministratorController::class, 'edit'])->name('administrators.edit');
        Route::put('/administrators/{administrator}', [AdministratorController::class, 'update'])->name('administrators.update');
        Route::delete('/administrators/{administrator}', [AdministratorController::class, 'destroy'])->name('administrators.destroy');
    });

    // Show — after /create
    Route::get('/administrators/{administrator}', [AdministratorController::class, 'show'])->name('administrators.show');
});

// ── Courses ───────────────────────────────────────────
Route::middleware('auth')->group(function () {
    Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
    Route::get('/courses/search', [CourseController::class, 'search'])->name('courses.search');

    // Admin-only CRUD — must be before /{course}
    Route::middleware('role:admin')->group(function () {
        Route::get('/courses/create', [CourseController::class, 'create'])->name('courses.create');
        Route::post('/courses', [CourseController::class, 'store'])->name('courses.store');
        Route::get('/courses/{course}/edit', [CourseController::class, 'edit'])->name('courses.edit');
        Route::put('/courses/{course}', [CourseController::class, 'update'])->name('courses.update');
        Route::delete('/courses/{course}', [CourseController::class, 'destroy'])->name('courses.destroy');
        Route::post('/courses/{id}/enroll', [CourseController::class, 'enroll'])->name('courses.enroll');
        Route::delete('/courses/{courseId}/unenroll/{studentId}', [CourseController::class, 'unenroll'])->name('courses.unenroll');
        Route::post('/courses/{courseId}/grade/{studentId}', [CourseController::class, 'updateGrade'])->name('courses.grade');
    });

    // Show — after /create
    Route::get('/courses/{course}', [CourseController::class, 'show'])->name('courses.show');
});

require __DIR__.'/auth.php';
