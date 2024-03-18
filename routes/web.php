<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('register');
});
Route::get('/create', function () {
    return view('create');
});

Route::post('/create',[UserController::class,'create'] )->name('create');
Route::put('/update/{id}',[UserController::class,'updateTask'] )->name('update');
Route::get('/update/{id}',[UserController::class,'update'] );
Route::get('/delete/{id}',[UserController::class,'deleteTask'] )->name('deleteTask');
Route::get('/assignTask/{id}',[UserController::class,'assignTask'] )->name('assignTask');
Route::post('/assignTaskUser/{title}/{description}/{status}',[UserController::class,'assignTaskUser'] )->name('assignTaskUser');


Route::get('/dashboard',[UserController::class,'task'] )->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
