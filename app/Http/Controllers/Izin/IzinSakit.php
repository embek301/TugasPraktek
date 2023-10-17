<?php


namespace App\Http\Controllers\Izin;

use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Terlambat;
use App\Models\User;
use App\Models\Penilai2;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use App\Mail\IzinSakitNotification;




class IzinSakit extends Controller
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
        $idSakit = 'ASR' . $dateInGMTPlus7->format('y') . $dateInGMTPlus7->format('m') . '0001';
        $pageTitle = 'Form Izin Sakit';

        // Check if the current hour is within the allowed time frame (08:00 - 15:59)
        $isWithinAllowedTime = ($currentHour <= 23);
        $user = auth()->user();
        $userName = $user->who;
        $isPenilai2 = Penilai2::where('name', $userName)->exists();
        return view('content.Employee.izin.sakit', compact('pageTitle', 'users', 'dateInGMTPlus7', 'idSakit', 'isWithinAllowedTime','isPenilai2'));
    }

    public function create()
    {

    }
    public function store(Request $request)
    {
        // Validasi file surat dokter
        $request->validate([
            'surat_dokter' => 'required|file|mimes:jpg,pdf,docx',
        ]);

        try {
            DB::beginTransaction();

            // Mendapatkan tanggal saat ini dalam format YYMM
            $dateInGMTPlus7 = now()->setTimezone('Asia/Jakarta')->format('ym');

            // Mengunci tabel Terlambat untuk menghindari konflik nomor urut
            DB::table('izin-terlambat')->lockForUpdate()->get();

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
            $terlambat->tanggal = $request->tanggal_pengajuan;
            $terlambat->alasan = $request->keterangan;
            $penilai2Name = auth()->user()->penilai2;
            $terlambat->last = $penilai2Name;
            $terlambat->jenis = "Izin Sakit";
            $terlambat->tgl_awal = $request->tgl_awal;
            $terlambat->tgl_akhir = $request->tgl_akhir;
            $terlambat->hari = $request->jumlah;
            $penilai2Mail = User::where('who', $penilai2Name)->value('email');
            // dd($terlambat);
            $suratDokter = $request->file('surat_dokter');

            // Pastikan file surat dokter telah diunggah
            if ($suratDokter) {
                $originalFileName = $suratDokter->getClientOriginalName();
                $fileName = $originalFileName;
                $suratDokter->move(public_path('uploads'), $fileName);

                // Simpan nama file ke dalam kolom 'file' pada model Terlambat
                $terlambat->file = $fileName;
            } else {
                // Handle kesalahan jika file surat dokter tidak diunggah
                return back()->with('error', 'File surat dokter tidak diunggah.');
            }
            // dd($terlambat);
            if ($penilai2Mail) {
                // Ganti nilai MAIL_FROM_ADDRESS dengan alamat email pengguna yang saat ini masuk
                config(['mail.from.address' => auth()->user()->email]);
                // Send an email notification to the penilai2
                Mail::to($penilai2Mail)->send(new IzinSakitNotification($terlambat));
                // Setel kembali MAIL_FROM_ADDRESS ke nilai default setelah pengiriman email
                config(['mail.from.address' => env('MAIL_FROM_ADDRESS')]);
            } else {
                // Handle the case where no penilai2 email is found
            }
            // dd($terlambat);
            $terlambat->save();
            DB::commit();
            Alert::success('Berhasil Ditambahkan', 'Data Izin Berhasil Ditambahkan ');
            // Redirect atau melakukan tindakan lain sesuai kebutuhan aplikasi Anda
            return redirect()->route('employee-form.index');
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi kesalahan
            dd($e);
            DB::rollback();

            // Handle kesalahan, misalnya, tampilkan pesan kesalahan kepada pengguna
            // atau log pesan kesalahan untuk ditinjau kemudian
            return back()->with('error', 'Terjadi kesalahan saat menyimpan data.');
        }
    }

    public function edit(string $id)
    {

    }

    public function update(Request $request, string $id)
    {

    }

    public function destroy($id)
    {

    }
}