<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
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
Route::post('/assignTaskUser/{id}/{title}/{description}',[UserController::class,'assignTaskUser'] )->name('assignTaskUser');

Route::get('/admin',[AdminController::class,'getalluser'] )->name('admin');
Route::get('/admin/update/{id}',[AdminController::class,'UserDetails'] )->name('UserDetails');
Route::post('/admin/update/{id}',[AdminController::class,'updateUserDetails'] )->name('updateUserDetails');
Route::get('/admin/newtask',[AdminController::class,'adminAssignTask'] )->name('adminAssignTask');
Route::post('/admin/newtaskAssign',[AdminController::class,'newtaskAssign'] )->name('newtaskAssign');
Route::get('/admin/delete/{id}',[AdminController::class,'admindeleteTask'] )->name('admindeleteTask');

Route::get('/github',[LoginController::class,'login'] );
Route::get('/auth/github/callback',[LoginController::class,'loginCallback'] );

Route::get('/dashboard',[UserController::class,'task'] )->middleware(['auth', 'verified'])->name('dashboard');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
