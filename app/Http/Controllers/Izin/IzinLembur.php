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
use App\Mail\IzinLemburNotification;
use Illuminate\Support\Facades\DB;



class IzinLembur extends Controller
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
        $idLembur = 'ASR' . $dateInGMTPlus7->format('y') . $dateInGMTPlus7->format('m') . '0001';
        $pageTitle = 'Form Izin Lembur';

        // Check if the current hour is within the allowed time frame (08:00 - 15:59)
        $isWithinAllowedTime = ($currentHour >= 16);
        $user = auth()->user();
        $userName = $user->who;
        $isPenilai2 = Penilai2::where('name', $userName)->exists();
        return view('content.Employee.izin.lembur', compact('pageTitle', 'users', 'dateInGMTPlus7', 'idLembur', 'isWithinAllowedTime','isPenilai2'));
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
            $jamLembur = $request->waktu;
            $jamLemburFormatted = $jamLembur . ':00:00'; // Format "HH:mm:ss"
            $terlambat->jam = $jamLemburFormatted;
            $terlambat->tgl_awal = $request->tgl_lembur;
            $terlambat->alasan = $request->alasanLembur;

            // Mengatur nilai "last" berdasarkan jabatan pengguna
            if (auth()->user()->jabatan === 'MEKANIK') {
                // Mengambil pengguna dengan hak=9 dan cabang yang sama dengan pengguna saat ini
                $lastUser = User::where('hak', 9)
                    ->where('cab', auth()->user()->cab)
                    ->first();
                // dd($lastUser);
                // Setel "last" menjadi nama pengguna dengan hak=9 dan cabang yang sama
                if ($lastUser) {
                    $terlambat->last = $lastUser->who;

                    // Mengirim email ke pengguna hak=9
                    $this->sendEmailToHak9User($lastUser, $terlambat);
                } else {
                    // Handle jika tidak ada pengguna dengan hak=9 dan cabang yang sama
                    return back()->with('error', 'Tidak ada pengguna yang sesuai dengan kriteria.');
                }
            } else {
                // Untuk selain jabatan "mekanik", tetapkan "last" sesuai dengan penilai2
                $terlambat->last = auth()->user()->penilai2;
                $penilai2Name= $terlambat->last;
                $penilai2Mail = User::where('who', $penilai2Name)->value('email');
                $this->sendEmailToPenilai2($penilai2Mail, $terlambat);
            }

            $terlambat->jenis = "Izin Lembur";
            // dd($terlambat);
            // $penilai2Name = auth()->user()->penilai2;
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

    // Fungsi untuk mengirim email ke pengguna hak=9
    private function sendEmailToHak9User($user, $terlambat)
    {
        // Ganti nilai MAIL_FROM_ADDRESS dengan alamat email pengguna yang saat ini masuk
        config(['mail.from.address' => auth()->user()->email]);

        // Send an email notification to the pengguna hak=9
        Mail::to($user->email)->send(new IzinLemburNotification($terlambat));
        
        // Setel kembali MAIL_FROM_ADDRESS ke nilai default setelah pengiriman email
        config(['mail.from.address' => env('MAIL_FROM_ADDRESS')]);
    }
    private function sendEmailToPenilai2($user, $terlambat)
    {
        // Ganti nilai MAIL_FROM_ADDRESS dengan alamat email pengguna yang saat ini masuk
        config(['mail.from.address' => auth()->user()->email]);


        Mail::to($user)->send(new IzinLemburNotification($terlambat));

        // Setel kembali MAIL_FROM_ADDRESS ke nilai default setelah pengiriman email
        config(['mail.from.address' => env('MAIL_FROM_ADDRESS')]);
    }

}