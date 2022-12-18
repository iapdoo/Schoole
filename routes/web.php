<?php

use App\Http\Controllers\Admin\ClassRoom\ClassRoomController;
use App\Http\Controllers\Admin\Grade\GradeController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//
//Route::group(['prefix' => LaravelLocalization::setLocale()], function()
//{
//    /** ADD ALL LOCALIZED ROUTES INSIDE THIS GROUP **/
//
//});

Auth::routes();

Route::group(['middleware' => 'guest'], function () {
    Route::get('/', function () {
        return view('auth.login');
    });
});


Route::group(['prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth']
], function () {

    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
############################ START Grades ROUTE ########################################################################
    Route::get('/Grades', [GradeController::class, 'index'])->name('Grades.index');
    Route::post('/Grades/store', [GradeController::class, 'store'])->name('Grades.store');
    Route::post('/Grades/update/{id}', [GradeController::class, 'update'])->name('Grades.update');
    Route::post('/Grades/destroy/{id}', [GradeController::class, 'destroy'])->name('Grades.destroy');
############################ END Grades ROUTE ##########################################################################
############################ START Classrooms ROUTE ####################################################################
    Route::get('/Classrooms', [ClassRoomController::class, 'index'])->name('Classrooms.index');
    Route::post('/Classrooms/store', [ClassRoomController::class, 'store'])->name('Classrooms.store');
    Route::post('/Classrooms/update/{id}', [ClassRoomController::class, 'update'])->name('Classrooms.update');
    Route::post('/Classrooms/destroy/{id}', [ClassRoomController::class, 'destroy'])->name('Classrooms.destroy');
############################ END Classrooms ROUTE ######################################################################


});


//
