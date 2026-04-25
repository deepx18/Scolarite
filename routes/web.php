<?php


use App\Http\Controllers\FORequestsController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginStudentsController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\StudentProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Locale switcher

Route::get('/lang/{locale}', [LanguageController::class, 'switch'])
    ->name('locale.switch')
    ->where('locale', '[a-z]{2}');

// Route::get('/locale/{locale}', function ($locale) {
//     $available = ['en', 'fr', 'ar'];
//     if (in_array($locale, $available)) {
//         // set a persistent cookie for locale (1 year)
//         $cookie = cookie('locale', $locale, 60 * 24 * 365);
//         return redirect()->back()->withCookie($cookie);
//     }
//     return redirect()->back();
// })->name('locale.switch');

Route::resource('requests', FORequestsController::class)->only(['index', 'create', 'store'])->middleware('auth.student');
Route::get('/profile', [StudentProfileController::class, 'show'])->name('profile.show')->middleware('auth:student');
Route::post('/profile', [StudentProfileController::class, 'update'])->name('profile.update')->middleware('auth:student');
Route::get('/profile/change-password', [StudentProfileController::class, 'changePasswordForm'])->name('profile.password.form')->middleware('auth:student');
Route::post('/profile/change-password', [StudentProfileController::class, 'updatePassword'])->name('profile.password.update')->middleware('auth:student');

Route::get('/admin/requests', [AdminController::class, 'index'])->name('admin.requests.index')->middleware('auth.admin');
Route::get('/admin/requests/{request}', [AdminController::class, 'show'])->name('admin.requests.show')->middleware('auth.admin');
Route::put('/admin/requests/{request}', [AdminController::class, 'update'])->name('admin.requests.update')->middleware('auth.admin');
Route::delete('/admin/requests/{request}', [AdminController::class, 'destroy'])->name('admin.requests.destroy')->middleware('auth.admin');
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
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard')->middleware('auth.admin');
    Route::get('/profile', [AdminController::class, 'profile'])->name('admin.profile')->middleware('auth:admin');
    Route::post('/reclamations', [AdminController::class, 'toggleReclamations'])->name('admin.reclamations.toggle')->middleware('auth:admin');
    Route::get('/recent-requesters', [AdminController::class, 'recentRequesters'])->name('admin.recentRequesters')->middleware('auth:admin');
    Route::get('/students', [AdminController::class, 'studentsIndex'])->name('admin.students.index')->middleware('auth:admin');
    Route::get('/students/export', [AdminController::class, 'exportStudents'])->name('admin.students.export')->middleware('auth:admin');
    Route::get('/students/create', [AdminController::class, 'createStudent'])->name('admin.students.create')->middleware('auth:admin');
    Route::post('/students', [AdminController::class, 'storeStudent'])->name('admin.students.store')->middleware('auth:admin');
    // Bulk upload routes
    Route::get('/students/bulk-upload', [AdminController::class, 'bulkUploadForm'])->name('admin.students.bulkUpload')->middleware('auth:admin');
    Route::post('/students/bulk-upload', [AdminController::class, 'bulkUploadStore'])->name('admin.students.bulkUpload.store')->middleware('auth:admin');
    Route::get('/students/{student}', [AdminController::class, 'showStudent'])->name('admin.students.show')->middleware('auth:admin');
    Route::get('/students/{student}/edit', [AdminController::class, 'editStudent'])->name('admin.students.edit')->middleware('auth:admin');
    Route::put('/students/{student}', [AdminController::class, 'updateStudent'])->name('admin.students.update')->middleware('auth:admin');
    Route::delete('/students/{student}', [AdminController::class, 'destroyStudent'])->name('admin.students.destroy')->middleware('auth:admin');
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

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');
