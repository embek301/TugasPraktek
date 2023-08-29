<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Penilai4;

class Penilai4Seeder extends Seeder
{
    public function run()
    {
        $data = [
            'SEGARYANTO TEJO',
            'SULIAWATI TEDJO',
            'NENDRA SULAKSANA',
            'RACHMANTO ARDIANSYAH',
            'RUDY UTOMO',
            'AMELIA JESSIKA HALIM',
            'LILIK MOELJANI',
            'RIZKY TOVANY',
            'DADANG WIDIYANTO',
            'R. DWI KUNCORO',
            'SEPTRIANDA JAYA',
            'NJO FEN ING',
            'EDY SUPRIADI',
        ];

        foreach ($data as $name) {
            Penilai4::create([
                'name' => $name,
            ]);
        }
    }
}