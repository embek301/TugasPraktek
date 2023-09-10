<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Cabang;
use App\Models\Dept;
use App\Models\Golongan;
use App\Models\Hak;
use App\Models\Penilai2;
use App\Models\Penilai3;
use App\Models\Penilai4;
use App\Models\Jabatan;
use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    public function index()
    {
        $pageTitle = 'Karyawan Aktif';
        $users = User::where('hak', '<>', 10)->where('aktif', '<>', 0)->get();
        return view('content.KPI.Master.User.index', compact('pageTitle', 'users'));
    }

    public function inactive()
    {
        $pageTitle = 'Karyawan Tidak Aktif';
        $users = User::where('hak', '<>', 10)->where('aktif', '<>', 1)->get();
        return view('content.KPI.Master.User.inactive', compact('pageTitle', 'users'));
    }
    public function show($id)
    {
        // Retrieve the user by ID and display it
    }

    public function create()
    {
        $pageTitle = 'Tambah Karyawan';
        $cabs = Cabang::orderBy('name', 'asc')->get();
        $depts = Dept::orderBy('name', 'asc')->get();
        $penilai2 = Penilai2::orderBy('name', 'asc')->get();
        $penilai3 = Penilai3::orderBy('name', 'asc')->get();
        $penilai4 = Penilai4::orderBy('name', 'asc')->get();
        $hak = Hak::all();
        $golongan = Golongan::all();
        $jabatan = Jabatan::orderBy('name', 'asc')->get();
        return view('content.KPI.Master.User.create', compact('pageTitle', 'cabs', 'depts', 'penilai2', 'penilai3', 'penilai4', 'hak', 'golongan', 'jabatan'));
    }

    public function store(Request $request)
    {
        $messages = [
            'required' => ':Attribute harus diisi.',
            'unique' => ':Attribute sudah ada',
            'who.required' => 'Nama harus diisi.'
        ];
        $validator = Validator::make($request->all(), [
            'nik' => 'required|unique:users,nik',
            'email' => 'required|unique:users,email',
            'who' => 'required',
            'username' => 'required|unique:users,username',
            'password' => 'required',
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
        $users->aktif = 1;
        $users->status = $request->status;
        $users->tgl_kontrak = $request->tgl_kontrak;

        $users->save();
        Alert::success('Berhasil Ditambahkan', 'Data Karyawan Baru Berhasil Ditambahkan');

        return redirect()->route('user.index');
    }
    public function edit(string $id)
    {
        $pageTitle = 'Edit User';
        $users = User::find($id);
        if ($users && $users->hak == 10) {
            // Redirect ke halaman user.index
            return redirect()->route('user.index');
        }
        $cabs = Cabang::orderBy('name', 'asc')->get();
        $depts = Dept::orderBy('name', 'asc')->get();
        $penilai2 = Penilai2::orderBy('name', 'asc')->get();
        $penilai3 = Penilai3::orderBy('name', 'asc')->get();
        $penilai4 = Penilai4::orderBy('name', 'asc')->get();
        $hak = Hak::all();
        $golongan = Golongan::all();
        $jabatan = Jabatan::orderBy('name', 'asc')->get();

        return view('content.KPI.Master.User.edit', compact('pageTitle', 'cabs', 'depts', 'penilai2', 'penilai3', 'penilai4', 'hak', 'golongan', 'jabatan', 'users'));
    }

    public function update(Request $request, string $id)
    {
        $messages = [
            'required' => ':Attribute harus diisi.',
            'nik' => 'NIK sudah ada',
            'who.required' => 'Nama harus diisi.'
        ];
        $validator = Validator::make($request->all(), [
            'nik' => 'required|unique:users,nik,' . $id, // Add the ID to exclude from unique check
            'email' => 'required|unique:users,email,' . $id,
            'who' => 'required',
            'username' => 'required|unique:users,username,' . $id,
            'password' => 'required',
        ], $messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $users = User::find($id);
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

        // Convert tgl_masuk and tgl_kontrak to Carbon objects
        if ($request->tgl_masuk) {
            $users->tanggal_masuk = Carbon::createFromFormat('d/m/Y', $request->tgl_masuk)->format('Y-m-d');
        } else {
            $users->tanggal_masuk = null;
        }
        $users->jabatan = $request->jabatan;
        $users->email = $request->email;
        $users->aktif = $request->aktif;

        $users->status = $request->status;

        if ($request->tgl_kontrak) {
            // Check if the input date is in 'd/m/Y' format
            if (preg_match('/^\d{1,2}\/\d{1,2}\/\d{4}$/', $request->tgl_kontrak)) {
                // If it's in 'd/m/Y' format, convert it to 'Y-m-d'
                $users->tgl_kontrak = Carbon::createFromFormat('d/m/Y', $request->tgl_kontrak)->format('Y-m-d');
            } else {
                // If it's in a different format, assume it's already in 'Y-m-d'
                $users->tgl_kontrak = $request->tgl_kontrak;
            }
        } else {
            $users->tgl_kontrak = null;
        }

        // Save the changes to the database
        $users->save();
        Alert::success('Berhasil diedit', 'Data Karyawan Berhasil Diedit');
        return redirect()->route('user.index');
    }
    public function destroy($id)
    {
        // Find the user by ID
        $users = User::find($id);

        // Check if the user exists
        if (!$users) {
            return redirect()->back()->with('error', 'User not found');
        }

        // Set the 'aktif' column to 0
        $users->aktif = 0;
        $users->save();
        return redirect()->route('user.index')->with('success', 'User deactivated successfully');
    }
        public function showChangePassword()
    {
        $pageTitle='Ganti Password';
        return view('auth.changepassword',compact('pageTitle'));
    }
    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);

        // Mengambil pengguna yang saat ini login
        $users = Auth::user();

        if (Hash::check($request->current_password, $users->password)) {
            // Memperbarui password pengguna
            $users->update([
                'password' => Hash::make($request->new_password),
            ]);

            return redirect()->route('home')->with('success', 'Password berhasil diubah.');
        } else {
            return redirect()->back()->withErrors(['current_password' => 'Password saat ini salah.']);
        }
    }

}
