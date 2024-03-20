<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LessonController;
use App\Http\Controllers\Admin\ClassroomController;
use App\Http\Controllers\Admin\DashboardController;

Route::get('/', function () {
    return view('welcome');
});


//prefix admin
Route::prefix('admin')->group(function () {
    //middleware auth
    Route::group(['middleware' => ['auth']], function () {
        //Route Dashboard
        Route::get('/dashboard', DashboardController::class)->name('admin.dashboard');

        //Route Resource Lessons
        Route::resource('/lessons', LessonController::class, ['as' => 'admin']);

        //Route Resource Classrooms
        Route::resource('/classrooms', ClassroomController::class, ['as' => 'admin']);
    });
});
