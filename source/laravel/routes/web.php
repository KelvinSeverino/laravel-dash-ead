<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\{
    AdminController,
    UserController,
    DashboardController,
    CourseController,
    ModuleController,
    LessonController,
    SupportController,
    ReplySupportController,
};

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->group(function () {
    /**
     * Routes Reply Support
     */
    Route::post('/supports/{id}/reply', [ReplySupportController::class, 'store'])->name('replies.store');

    /**
     * Routes Supports
     */
    Route::get('/supports/{id}', [SupportController::class, 'show'])->name('supports.show');
    Route::get('/supports', [SupportController::class, 'index'])->name('supports.index');

    /**
     * Routes Lessons Modules Courses
     */
    Route::resource('/modules/{moduleId}/lessons', LessonController::class);

    /**
     * Routes Modules Courses
     */
    Route::resource(
        name: '/courses/{courseId}/modules',
        controller: ModuleController::class
    ); //usando recurso do php8 de passar parametros nomeados, funciona igual ao codigo abaixo

    /**
     * Routes Courses
     */
    Route::resource('/courses', CourseController::class); //resource facilita para nao informar as rotas de crud padrao

    /**
     * Routes Admins
     */
    Route::put('/admins/{id}/update-image', [AdminController::class, 'uploadFile'])->name('admins.update.image');
    Route::get('/admins/{id}/image', [AdminController::class, 'changeImage'])->name('admins.change.image');
    Route::resource('/admins', AdminController::class); //resource facilita para nao informar as rotas de crud padrao

    /**
     * Routes Users
     */
    Route::put('/users/{id}/update-image', [UserController::class, 'uploadFile'])->name('users.update.image');
    Route::get('/users/{id}/image', [UserController::class, 'changeImage'])->name('users.change.image');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::post('/users/store', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');
    Route::get('/users', [UserController::class, 'index'])->name('users.index');

    Route::get('/', [DashboardController::class, 'index'])->name('admin.home');
});

Route::get('/', function () {
    return view('welcome');
});
