<?php
use App\Http\Controllers\FORequestsController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginStudentsController;


Route::get('/', function () {
    return view('welcome');
});

Route::resource('requests', FORequestsController::class)->only(['index', 'create', 'store']);
Route::get("/admin/requests", [AdminController::class, 'index'])->name('admin.requests.index')->middleware('auth:admin');
Route::get("/admin/requests/{request}", [AdminController::class, 'show'])->name('admin.requests.show')->middleware('auth:admin');


// Student login
Route::get('/login-students', [LoginStudentsController::class, 'loginForm'])->name('students.login');
Route::post('/login-students', [LoginStudentsController::class, 'login'])->name('students.login.submit');
Route::post('/logout-students', [LoginStudentsController::class, 'logout'])->name('students.logout');

// Admin login
Route::get('/admin/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'authenticate'])->name('admin.login.submit');
Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

