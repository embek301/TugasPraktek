<?php

namespace App\Http\Controllers\DataLaporan;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Cabang;
use App\Models\Penilai2;
use App\Models\Terlambat;
use Illuminate\Http\Request;
use App\Exports\RekapitulasiExport;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
use Illuminate\Support\Facades\Log;

class LaporanRekapitulasi extends Controller
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
        $pageTitle = 'Data Laporan Izin Rekapitulasi';
        $user = auth()->user();
        $userName = $user->who;
        $isPenilai2 = Penilai2::where('name', $userName)->exists();
        $cabs = Cabang::orderBy('name', 'asc')->get();
        // Tidak mengambil data di sini, biarkan tabel kosong
        $terlambatData = [];

        // Contoh inisialisasi variabel tanggalAwal
        $tanggalAwal = ''; // Anda dapat mengisi nilai default sesuai kebutuhan
        $tanggalAkhir = '';
        $cabang = '';
        return view('content.Employee.data-laporan.rekapitulasi', compact('pageTitle', 'isPenilai2', 'terlambatData', 'cabs', 'tanggalAwal', 'tanggalAkhir', 'cabang'));

    }


    // Dalam controller Anda

    public function filterDataRekapitulasi(Request $request)
    {
        $tanggalAwal = $request->input('tanggal_awal');
        $tanggalAkhir = $request->input('tanggal_akhir');
        $cabang = $request->input('cabang');

        $terlambatData = DB::table('izin-terlambat')
            ->join('users', 'izin-terlambat.nik', '=', 'users.nik')
            ->select(
                'izin-terlambat.nik',
                'izin-terlambat.nama',
                'users.jabatan',
                'users.dept',
                'users.cab',
                DB::raw('COUNT(IF(`izin-terlambat`.`jenis` = "Izin Terlambat", `izin-terlambat`.`jenis`, NULL)) as telat'),
                DB::raw('COUNT(IF(`izin-terlambat`.`jenis` = "Izin Pulang Awal", `izin-terlambat`.`jenis`, NULL)) as pulang'),
                DB::raw('COUNT(IF(`izin-terlambat`.`jenis` = "Izin No Clock In", `izin-terlambat`.`jenis`, NULL)) as clockin'),
                DB::raw('COUNT(IF(`izin-terlambat`.`jenis` = "Izin No Clock Out", `izin-terlambat`.`jenis`, NULL)) as clockout'),
                DB::raw('SUM(CASE WHEN `izin-terlambat`.`jenis` LIKE "%Izin Sakit%" THEN `izin-terlambat`.`hari` ELSE 0 END) as sakit'),
                DB::raw('COUNT(IF(`izin-terlambat`.`jenis` LIKE "%Izin Cuti%", `izin-terlambat`.`jenis`, NULL)) as cuti')

            )
            ->where('izin-terlambat.approval2', 'Diterima')
            ->whereBetween('izin-terlambat.tanggal', [$tanggalAwal, $tanggalAkhir])
            ->where('users.cab', $cabang)
            ->groupBy('izin-terlambat.nik', 'izin-terlambat.nama', 'users.jabatan', 'users.dept', 'users.cab')
            ->get();
        // dd($terlambatData);
        return response()->json(['data' => $terlambatData]);
    }

    public function exportExcelRekapitulasi(Request $request)
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
        // Set the locale to Bahasa Indonesia
        setlocale(LC_TIME, 'id_ID');
        $startDate = date('d', strtotime($tanggalAwal)) . ' ' . translateMonthToIndonesian(date('F', strtotime($tanggalAwal)));
        $endDate = date('d', strtotime($tanggalAkhir)) . ' ' . translateMonthToIndonesian(date('F', strtotime($tanggalAkhir)));
        $bulan = 'Tanggal ' . $startDate . ' - ' . $endDate . ' ' . date('Y', strtotime($tanggalAkhir));

        // Validasi form sebelum ekspor
        if ($tanggalAwal === '' || $tanggalAkhir === '' || $cabang === '') {
            return response()->json(['error' => 'Silakan isi semua field filter terlebih dahulu.']);
        }

        // Query untuk mengambil data
        $terlambatData = DB::table('izin-terlambat')
            ->join('users', 'izin-terlambat.nik', '=', 'users.nik')
            ->select(
                'izin-terlambat.nik',
                'izin-terlambat.nama',
                'users.jabatan',
                'users.dept',
                'users.cab',
                DB::raw('COUNT(IF(`izin-terlambat`.`jenis` = "Izin Terlambat", `izin-terlambat`.`jenis`, NULL)) as telat'),
                DB::raw('COUNT(IF(`izin-terlambat`.`jenis` = "Izin Pulang Awal", `izin-terlambat`.`jenis`, NULL)) as pulang'),
                DB::raw('COUNT(IF(`izin-terlambat`.`jenis` = "Izin No Clock In", `izin-terlambat`.`jenis`, NULL)) as clockin'),
                DB::raw('COUNT(IF(`izin-terlambat`.`jenis` = "Izin No Clock Out", `izin-terlambat`.`jenis`, NULL)) as clockout'),
                DB::raw('SUM(CASE WHEN `izin-terlambat`.`jenis` LIKE "%Izin Sakit%" THEN `izin-terlambat`.`hari` ELSE 0 END) as sakit'),
                DB::raw('COUNT(IF(`izin-terlambat`.`jenis` LIKE "%Izin Cuti%", `izin-terlambat`.`jenis`, NULL)) as cuti')
            )
            ->where('izin-terlambat.approval2', 'Diterima')
            ->whereBetween('izin-terlambat.tanggal', [$tanggalAwal, $tanggalAkhir])
            ->where('users.cab', $cabang)
            ->groupBy('izin-terlambat.nik', 'izin-terlambat.nama', 'users.jabatan', 'users.dept', 'users.cab')
            ->get();

        // Atur judul pada Excel
        $pageTitle = 'Data Laporan Rekapitulasi Izin ';
        $judul = [$bulan];
        $judulString = implode(' ', $judul);
        $filename = $pageTitle.$cabang . ' ' . $judulString . '.xlsx';
        // dd($filename);
        // Buat file Excel dengan tampilan yang sudah dibuat
        return Excel::download(new RekapitulasiExport($judul, $terlambatData), $filename);
    }



    public function exportPDFRekapitulasi(Request $request)
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


        $terlambatData = DB::table('izin-terlambat')
            ->join('users', 'izin-terlambat.nik', '=', 'users.nik')
            ->select(
                'izin-terlambat.nik',
                'izin-terlambat.nama',
                'users.jabatan',
                'users.dept',
                'users.cab',
                DB::raw('COUNT(IF(`izin-terlambat`.`jenis` = "Izin Terlambat", `izin-terlambat`.`jenis`, NULL)) as telat'),
                DB::raw('COUNT(IF(`izin-terlambat`.`jenis` = "Izin Pulang Awal", `izin-terlambat`.`jenis`, NULL)) as pulang'),
                DB::raw('COUNT(IF(`izin-terlambat`.`jenis` = "Izin No Clock In", `izin-terlambat`.`jenis`, NULL)) as clockin'),
                DB::raw('COUNT(IF(`izin-terlambat`.`jenis` = "Izin No Clock Out", `izin-terlambat`.`jenis`, NULL)) as clockout'),
                DB::raw('SUM(CASE WHEN `izin-terlambat`.`jenis` LIKE "%Izin Sakit%" THEN `izin-terlambat`.`hari` ELSE 0 END) as sakit'),
                DB::raw('COUNT(IF(`izin-terlambat`.`jenis` LIKE "%Izin Cuti%", `izin-terlambat`.`jenis`, NULL)) as cuti')
            )
            ->where('izin-terlambat.approval2', 'Diterima')
            ->whereBetween('izin-terlambat.tanggal', [$tanggalAwal, $tanggalAkhir])
            ->where('users.cab', $cabang)
            ->groupBy('izin-terlambat.nik', 'izin-terlambat.nama', 'users.jabatan', 'users.dept', 'users.cab')
            ->get();

        $pageTitle = 'Data Laporan izin rekapitulasi ';
        // dd($pageTitle);
        $judul = [$bulan];
        // dd($judul);
        $judulString = implode(' ', $judul);
        $jenisLaporan = $pageTitle . $cabang . ' ' . $judulString;
        $filename = $jenisLaporan . '.pdf';
        $pdf = PDF::loadView('content.Employee.data-laporan.pdf.pdfRekapitulasi', compact('terlambatData', 'bulan', 'jenisLaporan'))->setPaper('a4');


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