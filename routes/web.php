<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Admin\AdminController;


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

Route::get('/', function () {
  return view('welcome');
});


Route::group(['prefix' => 'user', 'as' => 'user.'], function () {

  //url: user/register 
  Route::middleware(['userauth'])->group(function () {
    Route::get('/',             [UserController::class, 'register'])->name('home');
    Route::get('/login',        [UserController::class, 'login'])->name('login');
    Route::post('/register',    [UserController::class, 'registerAction'])->name('register');
    Route::post('/loginaction', [UserController::class, 'loginAction'])->name('loginaction');
    Route::get('/verify-email/{token}', [UserController::class, 'emailVerification'])->name('email.verification');
  });

 
  Route::middleware(['auth:user'])->group(function () {
    Route::get('/profile',        [UserController::class, 'index'])->name('profile');
    Route::get('/profile/logout', [UserController::class, 'logout'])->name('logout');
    
  });
});

//Route::get('/verify-email/{token}', [UserController::class, 'emailVerification'])->name('email.verification');

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {

  Route::get('/',             [AdminController::class, 'login'])->name('login');
  Route::post('/loginaction', [AdminController::class, 'loginAction'])->name('loginaction');

  Route::middleware(['auth:admin'])->group(function () {
    Route::get('/profile',        [AdminController::class, 'index'])->name('profile');
    Route::get('/list',        [AdminController::class, 'userlist'])->name('list');
    Route::get('/profile/logout', [AdminController::class, 'logout'])->name('logout');
  });
});
