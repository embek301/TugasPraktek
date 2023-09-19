<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Penilai2;
use App\Models\Terlambat;
use Illuminate\Http\Request;
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $pageTitle = 'List Approval Absensi';
        $terlambatData = [];

        // Get the currently logged-in user
        $user = auth()->user();
        dd($user);
        // Find the Penilai 2 associated with the current user
        $penilai2 = $user->penilai2s;

        if ($penilai2) {
            $penilai2Name = $penilai2->name;
          
            // Retrieve the Terlambat data for users with the same 'nama' as Penilai 2
            $terlambatData = Terlambat::where('nama', $penilai2Name)->get();
        }

        return view('content.Employee.dashboard', compact('pageTitle', 'terlambatData'));
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