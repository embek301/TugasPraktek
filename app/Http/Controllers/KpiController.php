<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Cabang;
use App\Models\Dept;
use App\Models\Hak;
use App\Models\Penilai2;
use App\Models\Penilai3;
use App\Models\Penilai4;
use App\Models\Jabatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KpiController extends Controller
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
        $pageTitle = 'KPI';
        $users = User::all();
        return view('content.KPI.dashboard', compact('pageTitle', 'users'));
    }
}
