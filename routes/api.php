<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AlumniController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

Route::post('/register', [AuthController::class, 'register']);
Route::post('login',    [AuthController::class, 'login']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    // ==== ADMIN AREA (/api/admin/...) ====
    Route::prefix('admin')->middleware('role:admin')->group(function () {
        // -- CRUD ADMIN --
        Route::get('admin',         [AdminController::class, 'indexAdmin']);
        Route::post('admin',        [AdminController::class, 'storeAdmin']);
        Route::get('admin/{id}',    [AdminController::class, 'showAdmin']);
        Route::put('admin/{id}',    [AdminController::class, 'updateAdmin']);
        Route::delete('admin/{id}', [AdminController::class, 'destroyAdmin']);
        Route::post('admin/batch-delete', [AdminController::class, 'batchDeleteAdmins']);
        Route::get('profile', [AdminController::class, 'show']);
        Route::put('profile', [AdminController::class, 'update']);

        // -- CRUD ALUMNI --
        Route::get('alumni',         [AdminController::class, 'indexAlumni']);
        Route::post('alumni',        [AdminController::class, 'storeAlumni']);
        Route::get('alumni/{id}',    [AdminController::class, 'showAlumni']);
        Route::put('alumni/{id}',    [AdminController::class, 'updateAlumni']);
        Route::delete('alumni/{id}', [AdminController::class, 'destroyAlumni']);
        Route::post('alumni/batch-delete', [AdminController::class, 'batchDeleteAlumni']);
    });

    // ==== ALUMNI AREA (/api/alumni/...) ====
    Route::prefix('alumni')->middleware('role:alumni')->group(function () {
        Route::get('profile', [AlumniController::class, 'show']);
        Route::put('profile', [AlumniController::class, 'update']);
    });
});
?>