<?php

use App\Http\Controllers\Web\{
    AuthController, 
    HomeController,
    UserController
};
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('web.auth')->group(function () {    
    Route::get('/', [HomeController::class, 'index'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    
    Route::get('/users', [UserController::class, 'index'])->name('users_index');
    Route::get('/users/show/{id}', [UserController::class, 'show'])->name('users_show');
    Route::post('/users', [UserController::class, 'store'])->name('users_store');
    Route::post('/user/update', [UserController::class, 'update'])->name('users_update');

});