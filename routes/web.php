<?php


use App\Http\Controllers\FORequestsController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('requests', FORequestsController::class)->only(['index', 'create', 'store']);
Route::get("/admin/requests", [AdminController::class, 'index'])->name('admin.requests.index');
Route::get("/admin/requests/{request}", [AdminController::class, 'show'])->name('admin.requests.show');
