<?php


use App\Http\Controllers\FORequestsController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginStudentsController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\StudentProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('requests', FORequestsController::class)->only(['index', 'create', 'store'])->middleware('auth.student');
Route::get('/profile', [StudentProfileController::class, 'show'])->name('profile.show')->middleware('auth:student');
Route::post('/profile', [StudentProfileController::class, 'update'])->name('profile.update')->middleware('auth:student');
Route::get('/profile/change-password', [StudentProfileController::class, 'changePasswordForm'])->name('profile.password.form')->middleware('auth:student');
Route::post('/profile/change-password', [StudentProfileController::class, 'updatePassword'])->name('profile.password.update')->middleware('auth:student');

Route::get('/admin/requests', [AdminController::class, 'index'])->name('admin.requests.index')->middleware('auth.admin');
Route::get('/admin/requests/{request}', [AdminController::class, 'show'])->name('admin.requests.show')->middleware('auth.admin');
Route::get('/requests/{request}', [FORequestsController::class, 'show'])->name('requests.show')->middleware('auth.student');


// Authentication routes for students
Route::get('/login', [LoginStudentsController::class, 'showLoginForm'])->name('login.student.show')->middleware('guest:student');
Route::post('/login', [LoginStudentsController::class, 'login'])->name('login.student.submit')->middleware('guest:student');
Route::post('/logout', [LoginStudentsController::class, 'logout'])->name('logout.student')->middleware('auth:student');


// Authentication routes for admins and super admin
Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login')->middleware('guest:admin');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('admin.login.submit')->middleware('guest:admin');
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout')->middleware('auth:admin');
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard')->middleware('auth:admin');
    Route::post('/reclamations', [AdminController::class, 'toggleReclamations'])->name('admin.reclamations.toggle')->middleware('auth:admin');
    Route::get('/students/create', [AdminController::class, 'createStudent'])->name('admin.students.create')->middleware('auth:admin');
    Route::post('/students', [AdminController::class, 'storeStudent'])->name('admin.students.store')->middleware('auth:admin');
    // Bulk upload routes
    Route::get('/students/bulk-upload', [AdminController::class, 'bulkUploadForm'])->name('admin.students.bulkUpload')->middleware('auth:admin');
    Route::post('/students/bulk-upload', [AdminController::class, 'bulkUploadStore'])->name('admin.students.bulkUpload.store')->middleware('auth:admin');
    Route::middleware(['auth.admin', 'super.admin'])->name('admin.manage.')->group(function () {
        Route::resource('manage-admins', SuperAdminController::class)
            ->parameters(['manage-admins' => 'admin'])
            ->names([
                'index' => 'index',
                'store' => 'store',
                'show' => 'show',
                'edit' => 'edit',
                'update' => 'update',
                'destroy' => 'destroy',
            ])
            ->except(['create']);
    });
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');
