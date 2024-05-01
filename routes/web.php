<?php

use App\Http\Controllers\admin\AdminAuthController;
use App\Http\Controllers\admin\AdminDashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PresensiController;
use App\Http\Controllers\SubmmissionController;
use Illuminate\Support\Facades\Route;

// Route Panel
Route::middleware(['guest:user'])->group(function () {
    Route::get('/admin', function () {
        return view('admin.auth.login');
    })->name('admin.login.index');
    Route::post('admin/auth/login', [AdminAuthController::class, 'store'])->name('admin.login.store');
});

Route::middleware(['auth:user'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

        Route::get('logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
    });
});

// Route Employee
Route::middleware(['guest:employee'])->group(function () {
    Route::get('/', function () {
        return view('auth.login');
    })->name('login.index');
    Route::post('auth/login', [AuthController::class, 'store'])->name('login.store');
});

Route::middleware(['auth:employee'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Presensi
    Route::get('presensi', [PresensiController::class, 'index'])->name('presensi.index');
    Route::post('presensi', [PresensiController::class, 'store'])->name('presensi.store');
    Route::get('presensi/history', [PresensiController::class, 'history'])->name('presensi.history');
    Route::post('presensi/history', [PresensiController::class, 'getHistory']);

    // Employee
    Route::prefix('employee')->name('employee.')->group(function () {
        Route::get('', [EmployeeController::class, 'index'])->name('index');
        Route::put('{nik}', [EmployeeController::class, 'update'])->name('update');
    });

    // Submission
    Route::prefix('submission')->name('submission.')->group(function () {
        Route::get('', [SubmmissionController::class, 'index'])->name('index');
        Route::get('/leave', [SubmmissionController::class, 'create'])->name('create');
        Route::post('/leave', [SubmmissionController::class, 'store'])->name('store');
    });

    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
});
