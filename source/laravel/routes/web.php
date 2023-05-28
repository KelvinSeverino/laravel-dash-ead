<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\{
    AdminController,
    UserController
};

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('users.index');

    Route::get('/', [AdminController::class, 'index'])->name('admin.home');
});

Route::get('/', function () {
    return view('welcome');
});
