<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Cabang;
use App\Models\Dept;
use App\Models\Golongan;
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

    public function masterCabang()
    {
        $pageTitle = 'Master Cabang';
        $cabang = Cabang::all();
        return view('content.KPI.master_cabang', compact('pageTitle', 'cabang'));
    }

    public function create()
    {
        $pageTitle = 'Tambah Karyawan';
        $cabs = Cabang::all();
        $depts = Dept::all();
        $penilai2 = Penilai2::all();
        $penilai3 = Penilai3::all();
        $penilai4 = Penilai4::all();
        $hak = Hak::all();
        $golongan = Golongan::all();
        $jabatan = Jabatan::all();
        return view('content.KPI.create', compact('pageTitle', 'cabs', 'depts', 'penilai2', 'penilai3', 'penilai4', 'hak', 'golongan', 'jabatan'));
    }

    public function store(Request $request)
    {
        $messages = [
            'required' => ':Attribute harus diisi.',
            'unique' => ':Attribute sudah ada',
            'password' => 'Password harus 8 karakter'
        ];
        $validator = Validator::make($request->all(), [
            'nik' => 'required|unique:users,nik',
            'email' => 'required|unique:users,email',
            'who' => 'required',
            'username' => 'required|unique:users,username',
            'password' => 'required',
            'grade' => 'required',
            'aktif' => 'required',
            'tgl_masuk' => 'required',


        ], $messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $users = new User;
        $users->nik = $request->nik;
        $users->who = $request->who;
        $users->username = $request->username;
        $users->password = $request->password;
        $users->penilai2 = $request->penilai2;
        $users->penilai3 = $request->penilai3;
        $users->penilai4 = $request->penilai4;
        $users->dept = $request->departemen;
        $users->cab = $request->cabang;
        $users->hak = $request->hak;
        $users->golongan = $request->golongan;
        $users->grade = $request->grade;
        $users->tanggal_masuk = $request->tgl_masuk;
        $users->jabatan = $request->jabatan;
        $users->email = $request->email;
        $users->aktif = $request->aktif;
        $users->status = $request->status;
        $users->tgl_kontrak = $request->tgl_kontrak;

        $users->save();
        return redirect()->route('kpi.index');
    }
    public function edit(string $id)
    {
        $pageTitle = 'Edit Karyawan';
        $users = User::find($id);
        $cabs = Cabang::all();
        $depts = Dept::all();
        $penilai2 = Penilai2::all();
        $penilai3 = Penilai3::all();
        $penilai4 = Penilai4::all();
        $hak = Hak::all();
        $golongan = Golongan::all();
        $jabatan = Jabatan::all();
        return view('content.KPI.edit', compact(
            'pageTitle',
            'users',
            'cabs',
            'depts',
            'penilai2',
            'penilai3',
            'penilai4',
            'hak',
            'golongan',
            'jabatan'
        ));
    }
}
