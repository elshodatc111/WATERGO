<?php

use App\Http\Controllers\Web\{
    AuthController, 
    HomeController,
    RegionController,
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
    Route::post('/user/update/status', [UserController::class, 'update_status'])->name('users_update_status');
    Route::post('/user/update/password', [UserController::class, 'update_password'])->name('users_update_password');

    Route::get('/regions', [RegionController::class, 'index'])->name('regions_index');
    Route::get('/region/{id}', [RegionController::class, 'show'])->name('regions_show');
    Route::post('/regions/store', [RegionController::class, 'store'])->name('regions_store');

});