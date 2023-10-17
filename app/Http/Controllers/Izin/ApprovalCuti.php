<?php


namespace App\Http\Controllers\Izin;

use App\Mail\CutiTidakTerencanaMail;
use App\Mail\CutiTerencanaMail;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Cabang;
use App\Models\User;
use Carbon\Carbon;
use App\Models\Penilai2;
use App\Models\Terlambat;
use Illuminate\Support\Facades\Mail;
use App\Mail\noClockOutNotification;
use Illuminate\Support\Facades\DB;





class ApprovalCuti extends Controller
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
        $users = User::all();
        $dateInGMTPlus7 = Carbon::now()->setTimezone('Asia/Jakarta');
        $currentHour = $dateInGMTPlus7->format('H'); // Get the current hour in 24-hour format
        $idClockOut = 'ASR' . $dateInGMTPlus7->format('y') . $dateInGMTPlus7->format('m') . '0001';
        $pageTitle = 'List Pengganti Cuti';
        $user = auth()->user();
        $userName = $user->who;
        $isPenilai2 = Penilai2::where('name', $userName)->exists();
        $isPengganti = Terlambat::where('pengganti', $userName)->exists();
        $terlambatData = [];

        if ($isPengganti) {
            // For users who are penilai2
            $terlambatData = Terlambat::where('last', $userName)
                ->whereIn('jenis', ['Izin Cuti Tidak Terencana', 'Izin Cuti Terencana'])
                ->orderBy('tanggal', 'desc')
                ->get();
        } else {
            // For other users
            if ($user->hak == 7) {
                // Filter the data to only show records with Approval1 not equal to null and Approval2 equal to null
                $terlambatData = Terlambat::whereNotNull('approval1')
                    ->where('approval1', '!=', '')
                    ->whereNull('approval2')
                    ->whereIn('jenis', ['Izin Cuti Tidak Terencana', 'Izin Cuti Terencana'])
                    ->orderByRaw('id_terlambat DESC,tanggal DESC, jam DESC')
                    ->get();
            } elseif ($user->hak == 10) {
                // If the user has hak equal to 10 (superadmin), show all data
                $terlambatData = Terlambat::whereIn('jenis', ['Izin Cuti Tidak Terencana', 'Izin Cuti Terencana'])
                    ->orderBy('tanggal', 'desc')
                    ->get();
            } else {
                // For other cases, filter the data based on user's who attribute
                $terlambatData = Terlambat::where('last', $userName)
                    ->whereIn('jenis', ['Izin Cuti Tidak Terencana', 'Izin Cuti Terencana'])
                    ->orderBy('tanggal', 'desc')
                    ->get();
            }
        }

        return view('content.Employee.izin.ListPengganti', compact('pageTitle', 'users', 'dateInGMTPlus7', 'idClockOut', 'isPenilai2', 'isPengganti', 'terlambatData'));
    }


    public function create()
    {

    }


    public function store(Request $request)
    {

    }
    public function edit(string $id_terlambat)
    {
        $users = User::all();
        $pageTitle = 'Approval';
        $izinTerlambat = Terlambat::where('id_terlambat', $id_terlambat)->first();
        $dateInGMTPlus7 = now()->setTimezone('Asia/Jakarta');
        $whoValue = $izinTerlambat->nama;
        // Retrieve the corresponding User model
        $user = User::where('who', $whoValue)->first();
        $namaTerlambat = $izinTerlambat->nama;
        $pengguna = User::where('who', $namaTerlambat)->first();
        $jabatanUser = $pengguna ? $pengguna->jabatan : 'Nilai Default atau Lainnya';

        // Find the user with hak=9 and the same cabang as the current user
        if ($user) {
            // Jika pengguna ditemukan, maka ambil cabangnya
            $currentCabang = $user->cab;
        } else {
            // Jika pengguna tidak ditemukan, atur $currentCabang menjadi nilai default atau sesuai dengan kebutuhan Anda
            $currentCabang = 'Nilai Default atau Lainnya';
        }

      
        $penilai2Name = $user ? $user->penilai2 : '';
        $user = auth()->user();
        $userName = $user->who;
        $isPenilai2 = Penilai2::where('name', $userName)->exists();
        return view('content.Employee.izin.approval-1.approvalCuti', compact('pageTitle', 'izinTerlambat', 'dateInGMTPlus7', 'users', 'penilai2Name',  'isPenilai2', 'jabatanUser'));
    }

    public function update(Request $request, string $id_terlambat)
    {
        $terlambat = Terlambat::find($id_terlambat);
        $terlambat->nik = $request->nik;
        $penilai2Name = auth()->user()->penilai2;
        $terlambat->last = $penilai2Name;
        $terlambat->approval3 = $request->status3;
        $terlambat->alasan3 = $request->alasanDiterima;
        $terlambat->tgl_app3 = $request->tgl_app3;
        // dd($terlambat);
        $jenisIzin = $terlambat->jenis;
        $penilai2Mail = User::where('who', $penilai2Name)->value('email');
        if ($jenisIzin === 'Izin Cuti Tidak Terencana') {
            $emailNotification = new CutiTidakTerencanaMail($terlambat);
        } elseif ($jenisIzin === 'Izin Cuti Terencana') {
            $emailNotification = new CutiTerencanaMail($terlambat);
        } else {
            // Handle jenis izin lainnya jika diperlukan
        }
        config(['mail.from.address' => auth()->user()->email]);

        // Mengirim email notifikasi
        Mail::to($penilai2Mail)->send($emailNotification);

        // Mengembalikan nilai MAIL_FROM_ADDRESS ke nilai default setelah pengiriman email
        config(['mail.from.address' => env('MAIL_FROM_ADDRESS')]);

        $terlambat->save();
        // DB::commit();

        Alert::success('Berhasil Ditambahkan', 'Data Izin Berhasil Ditambahkan ');
        // Redirect atau melakukan tindakan lain sesuai kebutuhan aplikasi Anda
        return redirect()->route('employee-form.index');

    }

    public function destroy($id)
    {

    }
}