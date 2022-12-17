<?php

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


    Route::resource('Grade', GradeController::class);


});


//
