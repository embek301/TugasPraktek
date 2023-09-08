<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Penilai2;

class Penilai2Seeder extends Seeder
{
    public function run()
    {
        $data = [
            null,
            'SEGARYANTO TEJO',
            'SULIAWATI TEDJO',
            'RIZKY TOVANY',
            'DADANG WIDIYANTO',
            'RACHMANTO ARDIANSYAH',
            'NENDRA SULAKSANA',
            'STEFANUS WIJAYA',
            'KUSNUL HIDAYAH',
            'SANUSI',
            'R. DWI KUNCORO',
            'LIDYAWATI TEDJO',
            'GATOT TRISDIYANTO',
            'LILIK MOELJANI',
            'ERNI DWIANA DEWI',
            'SAYUTIN TEDJO',
            'KEPALA DEPARTEMEN',
            'MUDJI ASDUKI',
            'SEPTRIANDA JAYA',
            'SJAROFITIANI',
            'RUDY UTOMO',
            'AMELIA JESSIKA HALIM',
            'SEPTINI SHOMAWATI',
            'DRS. HARDJO SUBIANTO',
            'ALIMIN',
            'RICHARD WIBISONO',
            'WAHYU AIDIN HIDAYAT',
            'ADI SISWANTO',
            'YUNIASTONO',
            'SUPRIYANTO',
            'VERY ACHMADI',
            'ARIS MUNANDAR',
            'YUDI BRAHMIANTO',
            'ERIKH PRIA SETIAWAN',
            'WISNU NUGROHO ARI PURWANTO',
            'ARIF NUR TAUFIK',
            'JEFFRY ADIWYANTO',
            'SUWITO',
            'MUHAMMAD NOER',
            'EKO PURWANTO',
            'WISNU NUGROHO',
            'ARIF NUR TAUFIK',
            'EDY SUPRIADI',
            'CHRISTOPEL',
            'JONI SUDARMOKO',
            'WAWAN SETIAWAN, SE',
            'NATASYA PUSPITA',
            'RACHMAD WAHYUDI',
            'HERI SUGIARTO',
            'IKA HARI PRASTYANINGSIH',
            'DEDY SETIAWAN',
            'RONNY ABDUL ROCHIM',
            'CATUR IRWANTONO',
            'EDIE SUSANTO',
            'NOVIA ASTUTI',
            'AGUNG YUWONO',
            'OKTA AGUS MUJIANTO',
            'DEBBY ERDIASHA',
            'RETNO DWI KAVITASARI',
            'PRISMA CAHYA MARTIKASARI',
            'YEREMIA JHON KENNEDY KAITJILY',
            'ANGGITA NILAM SARI',
            'HARIONO',
            'MUHAMMAD EDI PRASTYO',
            'MUHAMMAD FARIS',
            'RAHMAD YUDHA PRATAMA',
            'SRI KUSWARYANTI',
            'FRANSISKUS HENDRIANTO WICAKSONO',
            'NJO FEN ING',
        ];

        foreach ($data as $name) {
            Penilai2::create([
                'name' => $name,
            ]);
        }
    }
}
