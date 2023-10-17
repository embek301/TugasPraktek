<?php


namespace App\Http\Controllers\Izin;

use App\Mail\CutiTidakTerencanaMail;
use App\Mail\CutiTerencanaMail;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Terlambat;
use App\Models\User;
use Carbon\Carbon;
use App\Models\Penilai2;
use App\Mail\IzinTerlambatNotification;
use App\Mail\IzinPulangAwalNotification;
use App\Mail\noClockOutNotification;
use App\Mail\noClockInNotification;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use App\Mail\IzinSakitNotification;
use App\Mail\IzinLemburNotification;

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
        $penilai2Names = Penilai2::pluck('name')->toArray();
        $dateInGMTPlus7 = Carbon::now()->setTimezone('Asia/Jakarta');
        $currentHour = $dateInGMTPlus7->format('H'); // Get the current hour in 24-hour format
        $pageTitle = 'Form Izin Terlambat';
        // Check if the current hour is within the allowed time frame (08:00 - 15:59)
        $isWithinAllowedTime = ($currentHour > 8 && $currentHour <= 16);
        $user = auth()->user();
        $userName = $user->who;
        $isPenilai2 = Penilai2::where('name', $userName)->exists();
        return view('content.Employee.izin.terlambat', compact('pageTitle', 'users', 'dateInGMTPlus7', 'isWithinAllowedTime', 'penilai2Names','isPenilai2'));

    }


    public function create()
    {
    }
    public function store(Request $request)
    {
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
            $terlambat->tanggal = $request->tanggal;
            $terlambat->jam = $request->waktu;
            $terlambat->alasan = $request->alasanTerlambat;
            $penilai2Name = auth()->user()->penilai2;
            $terlambat->last = $penilai2Name;
            $terlambat->jenis = "Izin Terlambat";
            $penilai2Mail = User::where('who', $penilai2Name)->value('email');

            if ($penilai2Mail) {
                // Ganti nilai MAIL_FROM_ADDRESS dengan alamat email pengguna yang saat ini masuk
                config(['mail.from.address' => auth()->user()->email]);
                // Send an email notification to the penilai2
                Mail::to($penilai2Mail)->send(new IzinTerlambatNotification($terlambat));
                // Setel kembali MAIL_FROM_ADDRESS ke nilai default setelah pengiriman email
                config(['mail.from.address' => env('MAIL_FROM_ADDRESS')]);
            } else {
                // Handle the case where no penilai2 email is found
            }

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

        // Sekarang $currentCabang akan memiliki nilai cabang yang sesuai dengan $whoValue
        $departemen = $pengguna ? $pengguna->dept : 'Nilai Default atau Lainnya';

        if ($departemen == 'service') {
            $kabeng = User::where('hak', 9)
                ->where('cab', $currentCabang)
                ->first();
        } else {
            // Find the user with hak=9 and the same cabang as the current user
            $kabeng = User::where('hak', 9)
                ->where('cab', $currentCabang)
                ->first();

            if ($kabeng) {
                // Pengguna dengan hak=9 dan cabang yang sesuai ditemukan
                $kabeng = $kabeng->who;
            } else {
                // Handle jika pengguna dengan hak=9 dan cabang yang sesuai tidak ditemukan
                // $kabeng akan tetap memiliki nilai default
            }
        }

        $penilai2Name = $user ? $user->penilai2 : '';
        $user = auth()->user();
        $userName = $user->who;
        $isPenilai2 = Penilai2::where('name', $userName)->exists();

        return view('content.Employee.izin.approval-1.acc', compact('pageTitle', 'izinTerlambat', 'dateInGMTPlus7', 'users', 'penilai2Name', 'kabeng', 'isPenilai2', 'jabatanUser', 'departemen'));
    }

    public function update(Request $request, string $id_terlambat)
    {
        // Validasi permintaan
        // Temukan izin terlambat berdasarkan $id_terlambat
        $terlambat = Terlambat::find($id_terlambat);

        if (!$terlambat) {
            // Tambahkan penanganan jika izin terlambat tidak ditemukan
            return redirect()->back()->with('error', 'Data Izin Terlambat tidak ditemukan.');
        }

        // Update kolom-kolom pada izin terlambat
        // $terlambat->status = $request->status;
        $jenisIzin = $terlambat->jenis;
        $terlambat->id_terlambat = $request->idTerlambat;
        $terlambat->jenis = $jenisIzin;
        $terlambat->last = 'HRD';
        $terlambat->tgl_app1 = $request->tgl_app1;
        $terlambat->tgl_app2 = $request->tanggal_persetujuan;
        $terlambat->alasan2 = $request->alasan2;
        $terlambat->approval2 = $request->status2;
        
        // Jika hak adalah 7, atur alasan1 dan approval1 dari database
        if (auth()->user()->hak == 7) {
            $terlambat->alasan1 = $request->alasan1;
            $terlambat->approval1 = $request->approval1;
            $terlambat->tgl_app2 = $request->tgl_app2;
        } else {
            $terlambat->alasan1 = $request->alasanDiterima;
            $terlambat->approval1 = $request->status;
            $terlambat->alasan3 = $request->alasan3;
            $terlambat->approval3 = $request->approval3;
        }
        // dd($terlambat);
        $HRD = 'HRD';
        $hrdEmail = User::where('who', $HRD)->value('email');

        if ($jenisIzin === 'Izin Terlambat') {
            $emailNotification = new IzinTerlambatNotification($terlambat);
        } elseif ($jenisIzin === 'Izin Pulang Awal') {
            $emailNotification = new IzinPulangAwalNotification($terlambat);
        } elseif ($jenisIzin === 'Izin No Clock In') {
            $emailNotification = new noClockInNotification($terlambat);
        } elseif ($jenisIzin === 'Izin No Clock Out') {
            $emailNotification = new noClockOutNotification($terlambat);
        } elseif ($jenisIzin === 'Izin Sakit') {
            $emailNotification = new IzinSakitNotification($terlambat);
        } elseif ($jenisIzin === 'Izin Lembur') {
            $emailNotification = new IzinLemburNotification($terlambat);
        } elseif ($jenisIzin === 'Izin Cuti Tidak Terencana') {
            $emailNotification = new CutiTidakTerencanaMail($terlambat);
        } elseif ($jenisIzin === 'Izin Cuti Terencana') {
            $emailNotification = new CutiTerencanaMail($terlambat);
        } else {
            // Handle jenis izin lainnya jika diperlukan
        }

        // Mengganti nilai MAIL_FROM_ADDRESS dengan alamat email pengguna yang saat ini masuk
        config(['mail.from.address' => auth()->user()->email]);

        // Mengirim email notifikasi
        Mail::to($hrdEmail)->send($emailNotification);

        // Mengembalikan nilai MAIL_FROM_ADDRESS ke nilai default setelah pengiriman email
        config(['mail.from.address' => env('MAIL_FROM_ADDRESS')]);
        $terlambat->save();

        // Tampilkan pesan sukses
        Alert::success('Berhasil di Approve', 'Data Izin Berhasil di Approve ');

        // Redirect ke rute yang sesuai
        return redirect()->route('employee-form.index');

    }


    public function destroy($id_terlambat)
    {

    }
}