<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('admin/dashboard',[AdminController::class,'index'])->name('admin.dashboard');
Route::get('admin/profile',[AdminController::class,'profile'])->name('admin.profile');
Route::get('/', function () {
    return view('welcome');
});


Route::get('user/dashboard',[UserController::class,'index'])->name('user.dashboard');
Route::get('user/profile',[UserController::class,'profile'])->name('user.profile');