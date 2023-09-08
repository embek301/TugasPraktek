<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'nik' => 'admin',
            'who' => 'Admin User',
            'username' => 'admin',
            'password' => bcrypt('ASRI'), // Change this to your desired password
            'penilai2' => 1, // Set the appropriate 'penilai2' value based on your data
            'penilai3' => 1, // Set the appropriate 'penilai3' value based on your data
            'penilai4' => 1, // Set the appropriate 'penilai4' value based on your data
            'dept' => 1, // Set the appropriate 'dept' value based on your data
            'cab' => 1, // Set the appropriate 'cab' value based on your data
            'hak' => 10, // Set the 'hak' value that corresponds to admin access
            'golongan' => 1, // Set the appropriate 'golongan' value based on your data
            'grade' => '',
            'tanggal_masuk' => now(), // You can set a specific date if needed
            'jabatan' => 1, // Set the appropriate 'jabatan' value based on your data
            'email' => 'admin@example.com',
            'aktif' => '0',
            'status' => '',
            'tgl_kontrak' => null, // You can set a specific date if needed
        ]);
    }
}
