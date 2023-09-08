<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call([
            CabangSeeder::class,
            DeptSeeder::class,
            GolonganSeeder::class,
            HakSeeder::class,
            JabatanSeeder::class,
            Penilai2Seeder::class,
            Penilai3Seeder::class,
            Penilai4Seeder::class,
            UserSeeder::class
        ]);
    }
}
