<?php

namespace App\Http\Controllers\DataLaporan;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Cabang;
use App\Models\Penilai2;
use App\Models\Terlambat;
use Illuminate\Http\Request;
use App\Exports\NoClockInExport;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
use Illuminate\Support\Facades\Log;

class LaporanClockIn extends Controller
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
        $pageTitle = 'Data Laporan Izin No Clock In';
        $user = auth()->user();
        $userName = $user->who;
        $isPenilai2 = Penilai2::where('name', $userName)->exists();
        $cabs = Cabang::orderBy('name', 'asc')->get();
        // Tidak mengambil data di sini, biarkan tabel kosong
        $terlambatData = [];
        // dd($user);
        // Contoh inisialisasi variabel tanggalAwal
        $tanggalAwal = ''; // Anda dapat mengisi nilai default sesuai kebutuhan
        $tanggalAkhir = '';
        $cabang = '';
        return view('content.Employee.data-laporan.izin-no-clock-in', compact('pageTitle', 'isPenilai2', 'terlambatData', 'cabs', 'tanggalAwal', 'tanggalAkhir', 'cabang'));

    }


    // Dalam controller Anda

    public function filterDataClockIn(Request $request)
    {
        $tanggalAwal = $request->input('tanggal_awal');
        $tanggalAkhir = $request->input('tanggal_akhir');
        $cabang = $request->input('cabang'); // Terima nilai cabang dari permintaan

        // Query data berdasarkan tanggal awal, tanggal akhir, dan cabang
        $terlambatData = Terlambat::join('users', 'users.who', '=', 'izin-terlambat.nama')
            ->select('izin-terlambat.*', 'users.jabatan', 'users.dept', 'users.cab')
            ->where('izin-terlambat.jenis', 'Izin No Clock In')
            ->whereNotNull('izin-terlambat.approval2')
            ->whereBetween('izin-terlambat.tanggal', [$tanggalAwal, $tanggalAkhir])
            ->where('users.cab', $cabang) // Filter berdasarkan cabang
            ->orderBy('izin-terlambat.tanggal', 'desc')
            ->get();


        // Kembalikan data dalam format JSON
        return response()->json(['data' => $terlambatData]);
    }


    public function exportExcelClockIn(Request $request)
    {
        $pageTitle = 'Data Laporan Izin No Clock In ';
        $tanggalAwal = $request->input('tanggal_awal');
        $tanggalAkhir = $request->input('tanggal_akhir');
        $cabang = $request->input('cabang');
        function translateMonthToIndonesian($englishMonth)
        {
            $monthTranslations = [
                'January' => 'Januari',
                'February' => 'Februari',
                'March' => 'Maret',
                'April' => 'April',
                'May' => 'Mei',
                'June' => 'Juni',
                'July' => 'Juli',
                'August' => 'Agustus',
                'September' => 'September',
                'October' => 'Oktober',
                'November' => 'November',
                'December' => 'Desember',
            ];

            return $monthTranslations[$englishMonth];
        }
        // Set the locale to Bahasa Indonesia
        setlocale(LC_TIME, 'id_ID');
        $startDate = date('d', strtotime($tanggalAwal)) . ' ' . translateMonthToIndonesian(date('F', strtotime($tanggalAwal)));
        $endDate = date('d', strtotime($tanggalAkhir)) . ' ' . translateMonthToIndonesian(date('F', strtotime($tanggalAkhir)));
        $bulan = 'Tanggal ' . $startDate . ' - ' . $endDate . ' ' . date('Y', strtotime($tanggalAkhir));

        // Validasi form sebelum ekspor
        if ($tanggalAwal === '' || $tanggalAkhir === '' || $cabang === '') {
            alert('Silakan isi semua field filter terlebih dahulu.');
            return;
        }

        // Query untuk mengambil data
        $terlambatData = Terlambat::join('users', 'users.who', '=', 'izin-terlambat.nama')
            ->select('izin-terlambat.*', 'users.jabatan', 'users.dept', 'users.cab')
            ->where('izin-terlambat.jenis', 'Izin No Clock In')
            ->whereNotNull('izin-terlambat.approval2')
            ->whereBetween('izin-terlambat.tanggal', [$tanggalAwal, $tanggalAkhir])
            ->where('users.cab', $cabang)
            ->orderBy('izin-terlambat.tanggal', 'desc')
            ->get();

        // Atur judul pada Excel
        $judul = [$bulan];
        $judulString = implode(' ', $judul);
        $filename = $pageTitle . $cabang . ' ' . $judulString . '.xlsx';

        // Buat file Excel dengan tampilan yang sudah dibuat
        return Excel::download(new NoClockInExport($judul, $terlambatData), $filename);
    }



    public function exportPDFClockIn(Request $request)
    {
        $tanggalAwal = $request->input('tanggal_awal');
        $tanggalAkhir = $request->input('tanggal_akhir');
        $cabang = $request->input('cabang');

        function translateMonthToIndonesian($englishMonth)
        {
            $monthTranslations = [
                'January' => 'Januari',
                'February' => 'Februari',
                'March' => 'Maret',
                'April' => 'April',
                'May' => 'Mei',
                'June' => 'Juni',
                'July' => 'Juli',
                'August' => 'Agustus',
                'September' => 'September',
                'October' => 'Oktober',
                'November' => 'November',
                'December' => 'Desember',
            ];

            return $monthTranslations[$englishMonth];
        }
        setlocale(LC_TIME, 'id_ID');

        $startDate = date('d', strtotime($tanggalAwal)) . ' ' . translateMonthToIndonesian(date('F', strtotime($tanggalAwal)));
        $endDate = date('d', strtotime($tanggalAkhir)) . ' ' . translateMonthToIndonesian(date('F', strtotime($tanggalAkhir)));
        $bulan = 'Tanggal ' . $startDate . ' - ' . $endDate . ' ' . date('Y', strtotime($tanggalAkhir));

        $terlambatData = Terlambat::join('users', 'users.who', '=', 'izin-terlambat.nama')
            ->select('izin-terlambat.*', 'users.jabatan', 'users.dept', 'users.cab')
            ->where('izin-terlambat.jenis', 'Izin No Clock In')
            ->whereNotNull('izin-terlambat.approval2')
            ->whereBetween('izin-terlambat.tanggal', [$tanggalAwal, $tanggalAkhir])
            ->where('users.cab', $cabang)
            ->orderBy('izin-terlambat.tanggal', 'desc')
            ->get();
        $pageTitle = 'Data Laporan Izin No Clock In ';
        $judul = [$bulan];
        $judulString = implode(' ', $judul);
        $jenisLaporan = $pageTitle . $cabang . ' ' . $judulString;
        $filename = $jenisLaporan . '.pdf';
        $pdf = PDF::loadView('content.Employee.data-laporan.pdf.pdfNoClockIn', compact('terlambatData', 'bulan', 'jenisLaporan'))->setPaper('a4');


        return $pdf->stream($filename);
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