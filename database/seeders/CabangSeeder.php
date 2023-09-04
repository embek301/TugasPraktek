<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cabang;

class CabangSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name' => 'PUCANG',
                'admin_unit' => 'FIFIN ANILAH',
                'pic' => 'KUSNUL HIDAYAH',
                'head' => 'RACHMANTO ARDIANSYAH',
                'kabeng' => 'RIZKY TOVANY',
            ],
            [
                'name' => 'JENGGOLO',
                'admin_unit' => 'CHRISTINE PRISKYLA',
                'pic' => 'WAHYU AIDIN HIDAYAT',
                'head' => 'RUDY UTOMO',
                'kabeng' => 'RIZKY TOVANY',
            ],
            [
                'name' => 'TAMAN',
                'admin_unit' => 'ERDIAN AJIE LAKSONO',
                'pic' => 'SAYUTIN TEDJO',
                'head' => 'NENDRA SULAKSANA',
                'kabeng' => 'EDY SUPRIADI',
            ],
            [
                'name' => 'HO',
                'admin_unit' => 'FIFIN ANILAH',
                'pic' => 'KUSNUL HIDAYAH',
                'head' => 'SEGARYANTO TEJO',
                'kabeng' => 'RIZKY TOVANY',
            ],
            // Add more data entries if needed
        ];

        foreach ($data as $entry) {
            Cabang::create($entry);
        }
    }
}