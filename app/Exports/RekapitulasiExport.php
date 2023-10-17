<?php
namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;


class RekapitulasiExport implements FromView, WithStyles
{
    use Exportable;

    protected $judul;
    protected $terlambatData;

    public function __construct($judul, $terlambatData)
    {
        $this->judul = $judul;
        $this->terlambatData = $terlambatData;
    }

    public function view(): View
    {
        return view('content.Employee.data-laporan.excel.excelRekapitulasi', [
            'bulan' => $this->judul[0],
            'terlambatData' => $this->terlambatData,
        ]);
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Gaya untuk seluruh sel dalam tabel
            1 => ['font' => ['bold' => true]],
            'A2:L2' => ['border' => ['top' => 'thin', 'bottom' => 'thin', 'left' => 'thin', 'right' => 'thin']],
            'A3:L' . (count($this->terlambatData) + 2) => ['border' => ['top' => 'thin', 'bottom' => 'thin', 'left' => 'thin', 'right' => 'thin']],
        ];
    }
}