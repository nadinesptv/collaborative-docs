<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

// Auth Routes (Fix: Route [login] not defined)
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('login', [AuthenticatedSessionController::class, 'store'])->name('login');

// Protected Document Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/documents', [DocumentController::class, 'index'])->name('documents.index');
    Route::get('/documents/create', [DocumentController::class, 'create'])->name('documents.create');
    Route::post('/documents', [DocumentController::class, 'store'])->name('documents.store');
    Route::get('/documents/{document}/edit', [DocumentController::class, 'edit'])->name('documents.edit');
    Route::put('/documents/{document}', [DocumentController::class, 'update'])->name('documents.update');
    Route::get('/documents/{document}', [DocumentController::class, 'show'])->name('documents.show');
    Route::post('/documents/{document}/collaborate', [DocumentController::class, 'collaborate'])->name('documents.collaborate');
    Route::post('/documents/{document}/cursor', [DocumentController::class, 'cursor'])->name('documents.cursor');
    Route::get('/documents/{document}/versions', [DocumentController::class, 'versions'])->name('documents.versions');
    Route::post('/documents/{document}/versions/{version}/restore', [DocumentController::class, 'restoreVersion'])->name('documents.restore');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Redirect root to documents or login
Route::get('/', function () {
    return auth()->check() ? redirect()->route('documents.index') : redirect()->route('login');
Route::get('/dashboard', function () {
    return view('dashboard'); // Pastikan file resources/views/dashboard.blade.php ada
})->name('dashboard');

    
});

require __DIR__.'/auth.php';