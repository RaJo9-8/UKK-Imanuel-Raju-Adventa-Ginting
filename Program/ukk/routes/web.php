<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\bukucontroller;
use App\Http\Controllers\PeminjamanController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');
    Route::get('/buku/search', [BukuController::class, 'search'])->name('buku.search');
    
    Route::get('/peminjaman/input/{id}', [PeminjamanController::class, 'input'])->name('peminjaman.input');
    Route::post('/peminjaman/store', [PeminjamanController::class, 'store'])->name('peminjaman.store');
    Route::get('/peminjaman-saya', [PeminjamanController::class, 'peminjamanku'])->name('peminjaman.peminjamanku');
    Route::put('/peminjaman/{id}/kembalikan', [PeminjamanController::class, 'kembalikan'])->name('peminjaman.kembalikan');
});

Route::middleware(['auth', 'level:1'])->group(function () {

    Route::get('/users', [UserController::class, 'tampil'])->name('user.tampil');
    Route::get('/users/input', [UserController::class, 'input'])->name('user.input');
    Route::post('/users/store', [UserController::class, 'store'])->name('user.store');
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('user.update');
    Route::delete('/users/{id}', [UserController::class, 'delete'])->name('user.delete');

    Route::get('/buku', [bukucontroller::class, 'tampil'])->name('buku.tampil');
    Route::get('/buku/input', [bukucontroller::class, 'input'])->name('buku.input');
    Route::post('/buku/store', [bukucontroller::class, 'store'])->name('buku.store');
    Route::get('/buku/{id}/edit', [bukucontroller::class, 'edit'])->name('buku.edit');
    Route::put('/buku/{id}', [bukucontroller::class, 'update'])->name('buku.update');
    Route::delete('/buku/{id}', [bukucontroller::class, 'destroy'])->name('buku.delete');

    Route::get('/peminjaman', [PeminjamanController::class, 'tampil'])->name('peminjaman.tampil');
    Route::get('/peminjaman/{id}/edit', [PeminjamanController::class, 'edit'])->name('peminjaman.edit');
    Route::put('/peminjaman/{id}', [PeminjamanController::class, 'update'])->name('peminjaman.update');
    Route::delete('/peminjaman/{id}', [PeminjamanController::class, 'delete'])->name('peminjaman.delete');

    
});


