<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Penilai2;
use App\Models\Terlambat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class EmployeeFormController extends Controller
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
        $pageTitle = 'Laporan Approval Absensi';
        $terlambatData = [];

        // Get the currently logged-in user
        $user = auth()->user();
        $userName = $user->who;

        // Check if the user's name is in the Penilai2 list
        $isPenilai2 = Penilai2::where('name', $userName)->exists();
        $isPengganti = Terlambat::where('pengganti', $userName)->exists();

        if ($isPenilai2 && $isPengganti) {
            $terlambatData = Terlambat::where('last', $userName)
                ->whereNotIn('jenis', ['Izin Cuti Tidak Terencana', 'Izin Cuti Terencana'])
                ->orderBy('tanggal', 'desc')
                ->get();
        } elseif ($isPenilai2) {
            $terlambatData = Terlambat::where('last', $userName)
                ->orderBy('tanggal', 'desc')
                ->get();
        } else {
            if ($user->hak == 7) {
                $terlambatData = Terlambat::whereNotNull('approval1')
                    ->where('approval1', '!=', '')
                    ->whereNull('approval2')
                    ->orderByRaw('id_terlambat DESC, tanggal DESC, jam DESC')
                    ->get();
            } elseif ($user->hak == 10) {
                // If the user has hak equal to 10 (superadmin), show all data
                $terlambatData = Terlambat::orderBy('tanggal', 'desc')
                    ->get();
            } else {
                // For other cases, filter the data based on user's who attribute
                $terlambatData = Terlambat::where('last', $userName)
                    ->orderBy('tanggal', 'desc')
                    ->get();
            }
        }


        return view('content.Employee.dashboard', compact('pageTitle', 'terlambatData', 'userName', 'isPenilai2'));
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