<?php

use App\Http\Controllers\ProfileController;


use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckRole;
use App\Http\Middleware\CheckRoleAdmin;
use App\Http\Middleware\CheckRoleCliente;
use App\Http\Middleware\CheckRoleFotografo;
use App\Http\Controllers\Foto_upload_controller;


Route::get('/register', function () {
    return view('welcome');
})->middleware(['auth', 'verified'])->name('register');

Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::get('foto_upload', [Foto_upload_controller::class, 'index'])->name('foto_upload.index');
    Route::get('foto_upload/create', [Foto_upload_controller::class, 'create'])->name('foto_upload.create');
    Route::post('foto_upload', [Foto_upload_controller::class, 'store'])->name('foto_upload.store');
    Route::get('foto_upload/{id}', [Foto_upload_controller::class, 'show'])->name('foto_upload.show');
    Route::get('foto_upload/{id}/edit', [Foto_upload_controller::class, 'edit'])->name('foto_upload.edit');
    Route::put('foto_upload/{id}', [Foto_upload_controller::class, 'update'])->name('foto_upload.update');
    Route::delete('foto_upload/{id}', [Foto_upload_controller::class, 'destroy'])->name('foto_upload.destroy');

    
});







require __DIR__.'/auth.php';