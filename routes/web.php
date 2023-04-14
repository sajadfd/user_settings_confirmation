<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserSettingsController;
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


Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('post-login', [AuthController::class, 'postLogin'])->name('login.post'); 
Route::get('registration', [AuthController::class, 'registration'])->name('register');
Route::post('post-registration', [AuthController::class, 'postRegistration'])->name('register.post'); 
Route::get('dashboard', [AuthController::class, 'dashboard']); 
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/user_settings', [UserSettingsController::class, 'index'])->name('user_settings.index');
    Route::get('/user_settings/{setting}/edit', [UserSettingsController::class, 'edit'])->name('user_settings.edit');
    Route::put('/user_settings/{setting}', [UserSettingsController::class, 'update'])->name('user_settings.update');
    Route::post('/user_settings/{setting}/confirm', [UserSettingsController::class, 'confirm'])->name('user_settings.confirm');
});

Route::get('/', function () {
    return view('dashboard');
});


Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');



Route::group(['middleware' => 'auth'], function () {

    Route::get('user_settings', [UserSettingsController::class, 'index'])->name('user_settings.index');
    Route::get('user_settings/{settingName}/edit', [UserSettingsController::class, 'edit'])->name('user_settings.edit');
    Route::get('user_settings/{settingName}', [UserSettingsController::class, 'update'])->name('user_settings.update');
    Route::get('user_settings/{settingName}/resend-code', [UserSettingsController::class, 'resendCode'])->name('user_settings.resend-code');
});
