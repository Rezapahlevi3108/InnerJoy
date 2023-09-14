<?php

use UniSharp\LaravelFilemanager\Lfm;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\PostingController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [LandingController::class, 'index'])->name('landing.index');
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::get('admin/dashboard',[AdminController::class,'index'])->name('admin.dashboard');
Route::get('admin/profile',[AdminController::class,'profile'])->name('admin.profile');


Route::get('posting/{id}',[PostingController::class,'index'])->name('posting');
Route::get('beranda',[PostingController::class,'beranda'])->name('beranda');

Route::prefix('user')->group(function(){
    Route::controller(UserController::class)->group(function(){
        Route::get('dashboard','index')->name('user.dashboard');
        Route::get('profile','profile')->name('user.profile');
        Route::get('post','post')->name('user.post');
        Route::post('post','storePost')->name('user.storePost');
        Route::get('edit/{id}','editPost')->name('user.edit');
        Route::post('edit','storeEditPost')->name('user.storeEditPost');
        Route::get('delete/{id}','deletePost')->name('user.delete');
    });
});

Route::group(['prefix' => 'laravel-filemanager'], function () {
    Lfm::routes();
});