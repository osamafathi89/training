<?php

use App\Http\Controllers\admin\CatController;
use App\Http\Controllers\admin\SubCatController;
use App\Http\Controllers\admin\CourseController;
use App\Http\Controllers\admin\IndexController;
use App\Http\Controllers\SettingController;
use Illuminate\Routing\RouteGroup;

Route::group(["prefix"=>"admin-area"],function(){
   Route::middleware(['auth'])->group(function () {
    Route::get('/',[IndexController::class,'dash']);
    Route::resource('/settings',SettingController::class);
    Route::resource('/cats',CatController::class);
    Route::resource('/subcats',SubCatController::class);
    Route::resource('/courses',CourseController::class);
    Route::get('/deletecat/{id}',[CatController::class,'deleteCat'])->name('cats.delete');
    Route::get('/deletesubcat/{id}',[SubCatController::class,'deleteCat'])->name('subcats.delete');
    Route::get('/deletecourse/{id}',[CourseController::class,'deleteCourse'])->name('courses.delete');
 
   });
})
?>