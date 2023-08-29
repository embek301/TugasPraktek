<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Penilai3;

class Penilai3Seeder extends Seeder
{
    public function run()
    {
        $data = [
            'SEGARYANTO TEJO',
            'SULIAWATI TEDJO',
            'RACHMANTO ARDIANSYAH',
            'NENDRA SULAKSANA',
            'R. DWI KUNCORO',
            'LIDYAWATI TEDJO',
            'KUSNUL HIDAYAH',
            'RUDY UTOMO',
            'DADANG WIDIYANTO',
            'HARDJO SUBIANTO',
            'ERNI DWIANA DEWI',
            'AMELIA JESSIKA HALIM',
            'LILIK MOELJANI',
            'RICHARD WIBISONO',
            'RIZKY TOVANY',
            'SEPTRIANDA JAYA',
            'EDY SUPRIADI',
            'NATASYA PUSPITA',
            'ANGGITA NILAM SARI',
            'NJO FEN ING',
            'FRANSISKUS HENDRIANTO WICAKSONO',
        ];

        foreach ($data as $name) {
            Penilai3::create([
                'name' => $name,
            ]);
        }
    }
}