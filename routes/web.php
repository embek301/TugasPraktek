<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\KpiController;
use App\Http\Controllers\Master\CabangController;
use App\Http\Controllers\Master\UserController;
use App\Http\Controllers\Master\DepartementController;
use App\Http\Controllers\Master\JabatanController;
use App\Http\Controllers\Master\Penilai2Controller;
use App\Http\Controllers\Master\Penilai3Controller;
use App\Http\Controllers\Master\Penilai4Controller;

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

Route::get('/', function () {
    return redirect()->route('home');
});

Route::get('home', [HomeController::class, 'index'])->name('home');

// Use the auth middleware to protect routes that require authentication
Route::middleware(['auth'])->group(function () {
    Route::resource('kpi', KpiController::class);
    Route::resource('user', UserController::class)->except('show');
    // Add a custom route for the "inactive" action
    Route::get('/user/inactive', [UserController::class, 'inactive'])->name('user.inactive');
    Route::resource('cabang', CabangController::class);
    Route::resource('departement', DepartementController::class);
    Route::resource('jab', JabatanController::class);
    Route::resource('pen2', Penilai2Controller::class);
    Route::resource('pen3', Penilai3Controller::class);
    Route::resource('pen4', Penilai4Controller::class);
    Route::get('/user/change-password',  [UserController::class, 'showChangePassword'])->name('user.change-password');
    Route::post('/user/change-password',  [UserController::class, 'changePassword']);
});

// Routes for authentication (Login, Logout, etc.)
Auth::routes();

Route::post('/login', [LoginController::class, 'authenticate']);
Route::fallback(function () {
    return redirect()->route('home');
});