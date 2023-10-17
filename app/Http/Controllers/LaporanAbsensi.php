<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Penilai2;
use App\Models\Terlambat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class LaporanAbsensi extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $pageTitle = 'Laporan Absensi';
        $user = auth()->user();
        $userName = $user->who;
        $isPenilai2 = Penilai2::where('name', $userName)->exists();
        $terlambatData = Terlambat::join('users', 'izin-terlambat.nama', '=', 'users.who')
            ->select('izin-terlambat.*', 'users.jabatan', 'users.dept', 'users.cab')
            // ->where('izin-terlambat.jenis', 'izin terlambat')
            ->where('izin-terlambat.nama', $userName) // Filter berdasarkan nama pengguna yang login
            ->orderBy('izin-terlambat.tanggal', 'desc')
            ->get();

        return view('content.Employee.izin.laporanAbsensi', compact('pageTitle', 'terlambatData', 'isPenilai2'));
    }



    public function create()
    {
    }

    public function store(Request $request)
    {
    }
    public function edit(string $id)
    {
    }
}