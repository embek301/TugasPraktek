<?php

namespace Database\Seeders;

use App\Models\Golongan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GolonganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            'I A',
            'I B',
            'I C',
            'I D',
            'I E',
            'I F',
            'II A',
            'II B',
            'II C',
            'II D',
            'II E',
            'II F',
            'III A',
            'III B',
            'III C',
            'III D',
            'III E',
            'III F',
            'IV A',
            'IV B',
            'IV C',
            'IV D',
            'IV E',
            'IV F',
            'V',


        ];

        foreach ($data as $name) {
            Golongan::create([
                'name' => $name,
            ]);
        }
    }
}