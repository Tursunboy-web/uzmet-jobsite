<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\CandidateController;
use App\Http\Controllers\ApplyController;
use App\Http\Controllers\TelegramController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HrController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/check', function () {
    return csrf_token();
});

# Login/Logout
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

# Dashboard для всех авторизованных
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

# Admin Routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/candidates', [AdminController::class, 'candidates'])->name('admin.candidates');
    Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
    Route::get('/roles', [AdminController::class, 'roles'])->name('admin.roles');
    Route::get('/analytics', [AdminController::class, 'analytics'])->name('admin.analytics');
    Route::get('/settings', [AdminController::class, 'settings'])->name('admin.settings');
});

# HR Routes
Route::middleware(['auth', 'role:hr'])->prefix('hr')->group(function () {
    Route::get('/dashboard', [HrController::class, 'dashboard'])->name('hr.dashboard');
    Route::get('/candidates', [HrController::class, 'candidates'])->name('hr.candidates');
});

# Apply form
Route::get('/apply', [ApplyController::class, 'show'])->name('apply.show');
Route::post('/apply', [ApplyController::class, 'store'])->name('apply.store');

# Telegram webhook
Route::post('/telegram/webhook', [TelegramController::class, 'webhook']);
