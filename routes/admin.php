<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdsController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\IntroController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\RateController;
use App\Http\Controllers\Admin\ShowSignController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

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

Route::get('/login-admin', [LoginController::class, 'index'])->name('login');
Route::post('/login-admin', [LoginController::class, 'store']);


Route::group(['middleware'=>'auth:admin'],function(){
    Route::get('/logout', [HomeController::class, 'logOut']);
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::get('/admins',[AdminController::class,'index'])->name('admin.admins');
    Route::get('/admin-delete-{id}',[AdminController::class,'delete'])->name('admin.admin.delete');
    Route::get('/admin-create',[AdminController::class,'create'])->name('admin.create.admin');
    Route::post('/admin-create',[AdminController::class,'store'])->name('admin.create.admin.store');

    Route::get('/intro',[IntroController::class,'index']);
    Route::post('/intro',[IntroController::class,'store']);

    Route::get('/ads',[AdsController::class,'index']);
    Route::get('/ad-delete-{id}',[AdsController::class,'delete']);
    Route::get('/create-ad',[AdsController::class,'create']);
    Route::post('/create-ad',[AdsController::class,'store']);
    Route::get('/edite-ad-{id}',[AdsController::class,'edite']);
    Route::post('/edite-ad',[AdsController::class,'update']);

    Route::get('/categories',[CategoryController::class,'index']);
    Route::get('/create-category',[CategoryController::class,'create']);
    Route::post('/create-category',[CategoryController::class,'store']);
    Route::get('/edite-category-{id}',[CategoryController::class,'edite']);
    Route::post('/edite-category',[CategoryController::class,'update']);

    Route::get('/tecnicals',[ShowSignController::class,'tecnicals']);
    Route::get('/users',[ShowSignController::class,'users']);
    
    Route::get('/tecnical-false-{id}',[ShowSignController::class,'statusFalTec']);
    Route::get('/tecnical-true-{id}',[ShowSignController::class,'statusTrueTec']);
    Route::get('/user-{id}',[ShowSignController::class,'deleteUser']);

    Route::get('/tec-rate',[RateController::class,'tecs']);
    Route::get('/users-rate',[RateController::class,'users']);
});