<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Jabatan;

class JabatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jabatanData = [
            null,
            'FINANCE ACCOUNTING AND TAX MANAGER',
            'DIREKTUR',
            'ACTING SALES SUPERVISOR',
            'JUNIOR SALES SUPERVISOR',
            'ADMIN BILLING GR',
            'ADMIN FINANCE',
            'ADMIN HEAD',
            'KASIR UNIT',
            'PDS GR',
            'CUSTOMER RELATION COORDINATOR',
            'ADMIN BPKB DAN STNK',
            'ADMIN UNIT',
            'FOREMAN CAT',
            'ACCOUNTING BODY PAINT',
            'ADMIN PARTSMAN',
            'HEAD OF HRD AND GAL',
            'HEAD CUSTOMER FIRST DEALER',
            'RENTAL CONSULTANT',
            'SERVICE HEAD GR',
            'BRANCH MANAGER',
            'GM FINANCE AND ACCOUNTING',
            'IT',
            'FLEET AND RENTAL DIVISION',
            'DRIVER',
            'OFFICE BOY',
            'MESSENGER',
            'PDS',
            'WASHER',
            'MAINTENANCE',
            'SECURITY',
            'PRESIDEN DIREKTUR',
            'PARTSMAN',
            'FOREMAN',
            'PEMBAGI TUGAS MEKANIK',
            'TECHNICIAN LEADER',
            'MEKANIK',
            'VALLET SERVICE',
            'SERVICE ADVISOR',
            'MATERIAL AND TOOL',
            'MRA',
            'DOORMAN',
            'HEAD OF TAX',
            'KASIR GR',
            'KASIR GR DAN UNIT',
            'THS',
            'SUPERVISOR FINANCE ADMIN',
            'ADMIN VARIASI',
            'SPV GR OTOXPERT',
            'ACCOUNTING AND TAX',
            'ACCOUNTING GR',
            'ACCOUNTING UNIT',
            'HEAD OF ACCOUNTING',
            'SENIOR SALES SUPERVISOR',
            'MARKETING VARIASI',
            'TEKNISI VARIASI',
            'FOREMAN OTOXPERT',
            'STORE SUPERVISOR CAFE',
            'SERVICE HEAD BODY PAINT',
            'DESAIN GRAFIS',
            'PURCHASING',
            'SALES SUPERVISOR',
            'GENERAL AFFAIRS AND LEGAL',
            'MARKETING SUPPORT',
            'BRANDING AND DIGITAL',
            'MANAGER CAFE',
            'CASHIER CAFE',
            'WAITERS CAFE',
            'COOK CAFE',
            'STEWARD CAFE',
            'BARISTA CAFE',
            'FLEET CONSULTANT',
            'SPV GR',
            'KOORDINATOR TEKNISI VARIASI',
            'TRAINEE CONSULTANT',
            'JUNIOR CONSULTANT',
            'EXECUTIVE CONSULTANT',
            'SENIOR CONSULTANT',
            'TRAINEE COUNTER CONSULTANT',
            'JUNIOR COUNTER CONSULTANT',
            'EXECUTIVE COUNTER CONSULTANT',
            'SENIOR COUNTER CONSULTANT',
            'HEAD OF IT',
            'HRD RECRUITMENT',
            'HRD KEKARYAWANAN',
            'FINANCE COORDINATOR CAFE',
            'KITCHEN COORDINATOR CAFE',
            'BARISTA COORDINATOR CAFE',
            'SERVICE COORDINATOR CAFE',
            'ADMIN TAX',
            'ADMIN BILLING BODY PAINT',
            'SERVICE ADVISOR BODY PAINT',
            'FOREMAN BODI',
            'KASIR BODY PAINT',
            'MRA BODY PAINT',
            'PARTSMAN BODY PAINT',
        ];

        foreach ($jabatanData as $jabatan) {
            Jabatan::create(['name' => $jabatan]);
        }
    }
}
