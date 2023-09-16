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
Route::post('login', [AuthController::class, 'loginCheck'])->name('loginCheck');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('register', [AuthController::class, 'regisStore'])->name('regisStore');
Route::get('logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');
Route::get('posting/{id}',[PostingController::class,'index'])->name('posting');
Route::get('beranda',[PostingController::class,'beranda'])->name('beranda');

Route::prefix('admin')->group(function () {
    Route::middleware(['auth', 'isAdmin'])->group(function () {
        Route::controller(AdminController::class)->group(function () {
            Route::get('dashboard','index')->name('admin.dashboard');
            Route::get('profile','profile')->name('admin.profile');
            Route::post('profile/update', 'editProfile')->name('admin.profileUpdate');
            Route::get('admin','indexAdmin')->name('admin.admin');
            Route::get('admin/get', 'getAdmin')->name('admin.admin.get');
            Route::post('admin/store', 'storeAdmin')->name('admin.admin.store');
            Route::get('admin/show/{id}', 'showAdmin')->name('admin.admin.show');
            Route::post('admin/update/{id}', 'updateAdmin')->name('admin.admin.update');
            Route::get('admin/destroy/{id}', 'destroyAdmin')->name('admin.admin.destroy');
            Route::get('user','indexUser')->name('admin.user');
            Route::get('user/get', 'getUser')->name('admin.user.get');
            Route::post('user/store', 'storeUser')->name('admin.user.store');
            Route::get('user/show/{id}', 'showUser')->name('admin.user.show');
            Route::post('user/update/{id}', 'updateUser')->name('admin.user.update');
            Route::get('user/destroy/{id}', 'destroyUser')->name('admin.user.destroy');
            Route::get('posting','indexPosting')->name('admin.posting');
            Route::get('posting/get', 'getPosting')->name('admin.posting.get');
            Route::get('posting/detail-posting/{id}', 'detailPosting')->name('admin.posting.detail-posting');
            Route::post('posting/block/{id}', 'blockPosting')->name('admin.posting.block');
            Route::get('posting/destroy/{id}', 'destroyPosting')->name('admin.posting.destroy');
        });
    });
});

Route::prefix('user')->group(function(){
    Route::middleware(['auth', 'isUser'])->group(function () {
        Route::controller(UserController::class)->group(function(){
            Route::get('dashboard','index')->name('user.dashboard');
            Route::get('profile','profile')->name('user.profile');
            Route::post('profile/update', 'editProfile')->name('user.profileUpdate');
            Route::get('post','post')->name('user.post');
            Route::post('post','storePost')->name('user.storePost');
            Route::get('edit/{id}','editPost')->name('user.edit');
            Route::post('edit','storeEditPost')->name('user.storeEditPost');
            Route::get('delete/{id}','deletePost')->name('user.delete');
            Route::get('fetchData/{kategori?}/{visibilitas?}','fetchData')->name('user.fetchData');
            Route::get('searchData/{kategori?}/{visibilitas?}/{query}','searchData')->name('user.searchData');
        });   
    });
});

Route::group(['prefix' => 'laravel-filemanager'], function () {
    Lfm::routes();
});