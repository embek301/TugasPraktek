<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Penilai2;
use App\Models\Terlambat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class LaporanApproval extends Controller
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
        $pageTitle = 'Laporan Reminder Absensi';
        $terlambatData = Terlambat::select('izin-terlambat.*', 'users.penilai2')
            ->leftJoin('users', 'izin-terlambat.nama', '=', 'users.who')
            ->whereNull('approval1')
            ->orderBy('izin-terlambat.tanggal', 'desc')
            ->get();

        // Ambil nama "penilai2" yang sesuai dengan setiap nama pada tabel "terlambat"
        $penilai2Data = [];

        foreach ($terlambatData as $terlambat) {
            $penilai2Data[$terlambat->nama] = $terlambat->penilai2;
        }
        // Get the currently logged-in user
        $user = auth()->user();
        $userName = $user->who;
        // Check if the user's name is in the Penilai2 list
        $isPenilai2 = Penilai2::where('name', $userName)->exists();
        // dd($isPenilai2);
        if ($isPenilai2) {
            // For users who are penilai2
            $terlambatData = Terlambat::where('last', $userName)->orderBy('tanggal', 'desc')->get();
        } else {
            // For other users
            if ($user->hak == 7) {
                // Filter the data to only show records with Approval1 not equal to null and Approval2 equal to null
                $terlambatData = Terlambat::whereNull('approval1')
                    // ->where('approval1', '!=', '')
                    // ->whereNull('approval2')
                    ->orderBy('tanggal', 'desc')
                    ->get();
                // dd($terlambatData);
            } elseif ($user->hak == 10) {
                // If the user has hak equal to 10 (superadmin), show all data
                $terlambatData = Terlambat::orderBy('tanggal', 'desc')->get();
            } else {
                // For other cases, filter the data based on user's who attribute
                $terlambatData = Terlambat::where('last', $userName)->orderBy('tanggal', 'desc')->get();
            }
        }
        // dd($terlambatData);
        // dd($isPenilai2);
        return view('content.Employee.izin.laporanApproval', compact('pageTitle', 'terlambatData', 'userName', 'isPenilai2','penilai2Data'));
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