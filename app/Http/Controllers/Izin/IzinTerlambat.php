<?php


namespace App\Http\Controllers\Izin;

use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Terlambat;
use App\Models\User;
use Carbon\Carbon;






class IzinTerlambat extends Controller
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
        $pageTitle = 'Form Izin Terlambat';
        // Check if the current hour is within the allowed time frame (08:00 - 15:59)
        $isWithinAllowedTime = ($currentHour >= 8 && $currentHour < 16);

        return view('content.Employee.izin.terlambat', compact('pageTitle', 'users', 'dateInGMTPlus7', 'isWithinAllowedTime'));

    }


    public function create()
    {

    }
    public function store(Request $request)
    {  
        // Mendapatkan tanggal saat ini dalam format YYMM
        $dateInGMTPlus7 = now()->setTimezone('Asia/Jakarta')->format('ym');
        
        // Mengambil ID terakhir dari tabel Terlambat dengan prefix dan tanggal yang sesuai
        $lastId = Terlambat::where('id_terlambat', 'like', 'ASR' . $dateInGMTPlus7 . '%')->max('id_terlambat');

        if ($lastId) {
            // Mendapatkan 4 digit terakhir dari ID terakhir
            $lastFourDigits = intval(substr($lastId, -4));

            // Menambahkan 1 ke 4 digit terakhir
            $nextFourDigits = $lastFourDigits + 1;
        } else {
            // Jika tidak ada ID sebelumnya, mulailah dengan 1
            $nextFourDigits = 1;
        }

        // Format angka berikutnya dengan leading zeros (4 digit)
        $formattedNextNumber = str_pad($nextFourDigits, 4, '0', STR_PAD_LEFT);

        // Menghasilkan ID berikutnya
        $nextId = 'ASR' . $dateInGMTPlus7 . $formattedNextNumber;

        // Buat instance baru dari model Terlambat
        $terlambat = new Terlambat;
        $terlambat->id_terlambat = $nextId;
        $terlambat->nik = auth()->user()->nik;
        $terlambat->nama = auth()->user()->who;
        $terlambat->tanggal = $request->tanggal;
        $terlambat->jam = $request->waktu;
        $terlambat->alasan = $request->alasanTerlambat;
        $terlambat->jenis = "Izin Terlambat";
        // Simpan data Terlambat ke dalam database
        $terlambat->save();
        Alert::success('Berhasil Ditambahkan', 'Data Izin Berhasil Ditambahkan ');
        // Redirect atau melakukan tindakan lain sesuai kebutuhan aplikasi Anda
        return redirect()->route('employee-form.index');
    }

    public function edit(string $id_terlambat)
    {
        $users = User::all();
        $pageTitle = 'Approval';
        $izinTerlambat = Terlambat::where('id_terlambat', $id_terlambat)->first();
        $dateInGMTPlus7 = now()->setTimezone('Asia/Jakarta');
        return view('content.Employee.izin.approval-1.acc', compact('pageTitle', 'izinTerlambat', 'dateInGMTPlus7','users'));

    }


    public function update(Request $request, string $id_terlambat)
    {

    }

    public function destroy($id_terlambat)
    {

    }
}