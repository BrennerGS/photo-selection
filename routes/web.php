<?php

use App\Http\Controllers\ProfileController;


use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckRole;
use App\Http\Middleware\CheckRoleAdmin;
use App\Http\Middleware\CheckRoleCliente;
use App\Http\Middleware\CheckRoleFotografo;
use App\Http\Controllers\Foto_upload_controller;



Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('foto_upload', Foto_upload_controller::class);
    
});







require __DIR__.'/auth.php';
