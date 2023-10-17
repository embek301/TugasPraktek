<?php


use App\Http\Controllers\LaporanAbsensi;
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
use App\Http\Controllers\Izin\IzinLembur;
use App\Http\Controllers\Izin\CutiTerencana;
use App\Http\Controllers\Izin\CutiTidakTerencana;
use App\Http\Controllers\LaporanApproval;
use App\Http\Controllers\DataLaporan\LaporanPulangAwal;
use App\Http\Controllers\DataLaporan\LaporanTerlambat;
use App\Http\Controllers\DataLaporan\LaporanClockOut;
use App\Http\Controllers\DataLaporan\LaporanClockIn;
use App\Http\Controllers\DataLaporan\LaporanSakit;
use App\Http\Controllers\DataLaporan\LaporanLembur;
use App\Http\Controllers\DataLaporan\LaporanCuti;
use App\Http\Controllers\DataLaporan\LaporanRekapitulasi;
use App\Http\Controllers\Izin\ApprovalCuti;

// use App\Http\Controllers\ExportController;

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
    Route::resource('employee-form/izin-terlambat', IzinTerlambat::class)->except('show');
    Route::resource('employee-form/izin-pulang-awal', IzinPulangAwal::class)->except('show');
    Route::resource('employee-form/izin-clock-in', ClockIn::class)->except('show');
    Route::resource('employee-form/izin-clock-out', ClockOut::class)->except('show');
    Route::resource('employee-form/izin-sakit', IzinSakit::class)->except('show');
    Route::resource('employee-form/laporan-absensi', LaporanAbsensi::class)->except('show');
    Route::resource('employee-form/izin-lembur', IzinLembur::class)->except('show');
    Route::resource('employee-form/cuti-terencana', CutiTerencana::class)->except('show');
    Route::resource('employee-form/cuti-tidak-terencana', CutiTidakTerencana::class)->except('show');
    Route::resource('employee-form/list-cuti', ApprovalCuti::class)->except('show');

    Route::resource('kpi/user', UserController::class)->except('show');
    // Add a custom route for the "inactive" action
    Route::get('kpi/user/inactive', [UserController::class, 'inactive'])->name('user.inactive');
    Route::resource('kpi/cabang', CabangController::class);
    Route::resource('kpi/departement', DepartementController::class);
    Route::resource('kpi/jabatan', JabatanController::class);
    Route::resource('kpi/penilai2', Penilai2Controller::class);
    Route::resource('kpi/penilai3', Penilai3Controller::class);
    Route::resource('kpi/penilai4', Penilai4Controller::class);
    Route::resource('employee-form/laporan-approval', LaporanApproval::class)->except('show');

    Route::resource('employee-form/data-terlambat', LaporanTerlambat::class)->except('show');
    Route::get('/filter-terlambat', [LaporanTerlambat::class, 'filterData'])->name('filter-terlambat');
    Route::get('/export-excel-terlambat', [LaporanTerlambat::class, 'exportExcel'])->name('export.excel.terlambat');
    Route::get('/export-pdf-terlambat', [LaporanTerlambat::class, 'exportPDF'])->name('export.pdf.terlambat');

    Route::resource('employee-form/data-pulangAwal', LaporanPulangAwal::class)->except('show');
    Route::get('/filter-pulangAwal', [LaporanPulangAwal::class, 'filterDataPulangAwal'])->name('filter-pulangAwal');
    Route::get('/export-excel-pulangAwal', [LaporanPulangAwal::class, 'exportExcel'])->name('export.excel.pulangAwal');
    Route::get('/export-pdf-pulangAwal', [LaporanPulangAwal::class, 'exportPDF'])->name('export.pdf.pulangAwal');

    Route::resource('employee-form/data-clockOut', LaporanClockOut::class)->except('show');
    Route::get('/filter-clockOut', [LaporanClockOut::class, 'filterDataClockOut'])->name('filter-clockOut');
    Route::get('/export-excel-clockOut', [LaporanClockOut::class, 'exportExcelClockOut'])->name('export.excel.clockOut');
    Route::get('/export-pdf-clockOut', [LaporanClockOut::class, 'exportPDFClockOut'])->name('export.pdf.clockOut');

    Route::resource('employee-form/data-clockIn', LaporanClockIn::class)->except('show');
    Route::get('/filter-clockIn', [LaporanClockIn::class, 'filterDataClockIn'])->name('filter-clockIn');
    Route::get('/export-excel-clockIn', [LaporanClockIn::class, 'exportExcelClockIn'])->name('export.excel.clockIn');
    Route::get('/export-pdf-clockIn', [LaporanClockIn::class, 'exportPDFClockIn'])->name('export.pdf.clockIn');

    Route::resource('employee-form/data-Sakit', LaporanSakit::class)->except('show');
    Route::get('/filter-Sakit', [LaporanSakit::class, 'filterDataSakit'])->name('filter-Sakit');
    Route::get('/export-excel-Sakit', [LaporanSakit::class, 'exportExcelSakit'])->name('export.excel.Sakit');
    Route::get('/export-pdf-Sakit', [LaporanSakit::class, 'exportPDFSakit'])->name('export.pdf.Sakit');

    Route::resource('employee-form/data-Lembur', LaporanLembur::class)->except('show');
    Route::get('/filter-Lembur', [LaporanLembur::class, 'filterDataLembur'])->name('filter-Lembur');
    Route::get('/export-excel-Lembur', [LaporanLembur::class, 'exportExcelLembur'])->name('export.excel.Lembur');
    Route::get('/export-pdf-Lembur', [LaporanLembur::class, 'exportPDFLembur'])->name('export.pdf.Lembur');

    Route::resource('employee-form/data-Cuti', LaporanCuti::class)->except('show');
    Route::get('/filter-Cuti', [LaporanCuti::class, 'filterDataCuti'])->name('filter-Cuti');
    Route::get('/export-excel-Cuti', [LaporanCuti::class, 'exportExcelCuti'])->name('export.excel.Cuti');
    Route::get('/export-pdf-Cuti', [LaporanCuti::class, 'exportPDFCuti'])->name('export.pdf.Cuti');

    Route::resource('employee-form/data-Rekapitulasi', LaporanRekapitulasi::class)->except('show');
    Route::get('/filter-Rekapitulasi', [LaporanRekapitulasi::class, 'filterDataRekapitulasi'])->name('filter-Rekapitulasi');
    Route::get('/export-excel-Rekapitulasi', [LaporanRekapitulasi::class, 'exportExcelRekapitulasi'])->name('export.excel.Rekapitulasi');
    Route::get('/export-pdf-Rekapitulasi', [LaporanRekapitulasi::class, 'exportPDFRekapitulasi'])->name('export.pdf.Rekapitulasi');
    
});

// Routes for authentication (Login, Logout, etc.)
Auth::routes();

Route::post('/login', [LoginController::class, 'authenticate']);
Route::fallback(function () {
    return redirect()->route('home');
});