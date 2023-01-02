<?php

use App\Http\Controllers\Admin\ClassRoom\ClassRoomController;
use App\Http\Controllers\Admin\Grade\GradeController;
use App\Http\Controllers\Admin\Section\SectionController;
use App\Http\Controllers\Admin\Student\PromotionController;
use App\Http\Controllers\Admin\Student\StudentController;
use App\Http\Controllers\Admin\Teachers\TeacherController;
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
    Route::post('delete_all', [ClassRoomController::class, 'delete_all'])->name('delete_all');
    Route::post('Filter_Classes', [ClassRoomController::class, 'Filter_Classes'])->name('Filter_Classes');

############################ END Classrooms ROUTE ######################################################################
############################ START Sections ROUTE ####################################################################
    Route::get('/Sections', [SectionController::class, 'index'])->name('Sections.index');
    Route::post('/Sections/store', [SectionController::class, 'store'])->name('Sections.store');
    Route::post('/Sections/update/{id}', [SectionController::class, 'update'])->name('Sections.update');
    Route::post('/Sections/destroy/{id}', [SectionController::class, 'destroy'])->name('Sections.destroy');
//    Route::post('delete_all', [SectionController::class, 'delete_all'])->name('delete_all');
    Route::get('/classes/{id}', [SectionController::class, 'getclasses'])->name('getclasses');

############################ END sections ROUTE ######################################################################
    //==============================  START parents ROUTE============================

    Route::view('add_parent','livewire.show_Form');
    //============================== END parents ROUTE============================
############################ START Teachers ROUTE ####################################################################
    Route::get('/Teachers', [TeacherController::class, 'index'])->name('Teachers.index');
    Route::get('/Teachers/create', [TeacherController::class, 'create'])->name('Teachers.create');
    Route::get('/Teachers/edit/{id}', [TeacherController::class, 'edit'])->name('Teachers.edit');
    Route::post('/Teachers/store', [TeacherController::class, 'store'])->name('Teachers.store');
    Route::post('/Teachers/destroy/{id}', [TeacherController::class, 'destroy'])->name('Teachers.destroy');
    Route::post('/Teachers/update/{id}', [TeacherController::class, 'update'])->name('Teachers.update');
    Route::post('/Teachers/destroy/{id}', [TeacherController::class, 'destroy'])->name('Teachers.destroy');

////    Route::post('delete_all', [SectionController::class, 'delete_all'])->name('delete_all');
//    Route::get('/classes/{id}', [SectionController::class, 'getclasses'])->name('getclasses');

############################ END Teachers ROUTE ######################################################################
    ############################ START Students ROUTE ####################################################################
    Route::get('/Students', [StudentController::class, 'index'])->name('Students.index');
    Route::get('/Students/create', [StudentController::class, 'create'])->name('Students.create');
    Route::post('/Students/store', [StudentController::class, 'store'])->name('Students.store');
    Route::get('/Students/edit/{id}', [StudentController::class, 'edit'])->name('Students.edit');
    Route::post('/Students/update/{id}', [StudentController::class, 'update'])->name('Students.update');
    Route::post('/Students/destroy/{id}', [StudentController::class, 'destroy'])->name('Students.destroy');
    Route::get('/Get_classrooms/{id}', [StudentController::class, 'Get_classrooms'] );
    Route::get('/Get_Sections/{id}',  [StudentController::class, 'Get_Sections'] );
    Route::get('/Students/show/{id}', [StudentController::class, 'show'])->name('Students.show');
    Route::post('Upload_attachment', [StudentController::class, 'Upload_attachment'] )->name('Upload_attachment');
    Route::get('Download_attachment/{studentsname}/{filename}', [StudentController::class, 'Download_attachment'] )->name('Download_attachment');
    Route::post('Delete_attachment', [StudentController::class, 'Delete_attachment'] )->name('Delete_attachment');
############################ END Students ROUTE ######################################################################
############################ START Students Promotion ROUTE ####################################################################
    Route::get('/Promotion', [PromotionController::class, 'index'])->name('Promotion.index');
    Route::get('/Promotion/create', [PromotionController::class, 'create'])->name('Promotion.create');
    Route::post('/Promotion/store', [PromotionController::class, 'store'])->name('Promotion.store');
    Route::get('/Promotion/edit/{id}', [PromotionController::class, 'edit'])->name('Promotion.edit');
    Route::post('/Promotion/update/{id}', [PromotionController::class, 'update'])->name('Promotion.update');
    Route::post('/Promotion/destroy/{id}', [PromotionController::class, 'destroy'])->name('Promotion.destroy');


############################ END Students Promotion ROUTE ######################################################################
});


//
