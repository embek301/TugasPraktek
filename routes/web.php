<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\KpiController;
use App\Http\Controllers\EmployeeFormController;
use App\Http\Controllers\Master\CabangController;
use App\Http\Controllers\Master\UserController;
use App\Http\Controllers\Master\DepartementController;
use App\Http\Controllers\Master\JabatanController;
use App\Http\Controllers\Master\Penilai2Controller;
use App\Http\Controllers\Master\Penilai3Controller;
use App\Http\Controllers\Master\Penilai4Controller;
// use App\Http\Controllers\Izin\IzinController;
use App\Http\Controllers\Izin\IzinTerlambat;
use App\Http\Controllers\Izin\IzinPulangAwal;
use App\Http\Controllers\Izin\ClockIn;
use App\Http\Controllers\Izin\ClockOut;
use App\Http\Controllers\Izin\IzinSakit;

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
Route::middleware(['auth'])->group(function () {
    Route::resource('kpi', KpiController::class)->except('show');
    Route::get('/user/change-password', [UserController::class, 'showChangePassword'])->name('user.change-password');
    Route::post('/user/change-password', [UserController::class, 'changePassword']);
    Route::resource('employee-form', EmployeeFormController::class)->except('show');
    // Route::resource('employee-form/izin', IzinController::class)->except('show');
    Route::resource('employee-form/izin-terlambat', IzinTerlambat::class)->except('show');
    Route::resource('employee-form/izin-pulang-awal', IzinPulangAwal::class)->except('show');
    Route::resource('employee-form/izin-clock-in', ClockIn::class)->except('show');
    Route::resource('employee-form/izin-clock-out', ClockOut::class)->except('show');
    Route::resource('employee-form/izin-sakit', IzinSakit::class)->except('show');
});

Route::middleware(['isAdmin'])->group(function () {
    Route::resource('kpi/user', UserController::class)->except('show');
    // Add a custom route for the "inactive" action
    Route::get('kpi/user/inactive', [UserController::class, 'inactive'])->name('user.inactive');
    Route::resource('kpi/cabang', CabangController::class);
    Route::resource('kpi/departement', DepartementController::class);
    Route::resource('kpi/jabatan', JabatanController::class);
    Route::resource('kpi/penilai2', Penilai2Controller::class);
    Route::resource('kpi/penilai3', Penilai3Controller::class);
    Route::resource('kpi/penilai4', Penilai4Controller::class);
});


// Routes for authentication (Login, Logout, etc.)
Auth::routes();

Route::post('/login', [LoginController::class, 'authenticate']);
Route::fallback(function () {
    return redirect()->route('home');
});