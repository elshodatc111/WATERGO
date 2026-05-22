<?php

use App\Http\Controllers\Web\{
    AuthController, 
    HomeController,
    MoliyaController,
    MoliyaSettingController,
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
    Route::post('/user/salary', [UserController::class, 'salaryStore'])->name('users_salary_store');
    Route::post('/user/update/status', [UserController::class, 'update_status'])->name('users_update_status');
    Route::post('/user/update/password', [UserController::class, 'update_password'])->name('users_update_password');

    Route::get('/regions', [RegionController::class, 'index'])->name('regions_index');
    Route::get('/region/{id}', [RegionController::class, 'show'])->name('regions_show');
    Route::post('/regions/store', [RegionController::class, 'store'])->name('regions_store');
    Route::post('/regions/update/status', [RegionController::class, 'update_status'])->name('regions_update_status');
    Route::post('/regions/update', [RegionController::class, 'update'])->name('regions_update');
    Route::post('/regions/add/currer', [RegionController::class, 'add_currer'])->name('regions_add_currer');
    Route::post('/regions/trash/currer', [RegionController::class, 'trash_currer'])->name('regions_trash_currer');

    Route::get('/moliya', [MoliyaController::class, 'index'])->name('moliya_index');
    Route::post('/moliya/maxsulot/kirim', [MoliyaController::class, 'maxsulotKirim'])->name('moliya_maxsulot_kirim');
    Route::post('/moliya/maxsulot/chiqim', [MoliyaController::class, 'maxsulotChiqim'])->name('moliya_maxsulot_chiqim');
    Route::post('/moliya/daromad/chiqim', [MoliyaController::class, 'daromadChiqim'])->name('moliya_daromad_chiqim');
    Route::post('/moliya/xarajat/chiqim', [MoliyaController::class, 'storeXarajat'])->name('moliya_xarajat_chiqim');

    Route::get('/moliya/settings', [MoliyaSettingController::class, 'index'])->name('moliya_settings');
    Route::post('/moliya/settings/update', [MoliyaSettingController::class, 'update'])->name('moliya_settings_update');

});