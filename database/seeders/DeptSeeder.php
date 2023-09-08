<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Dept; // Make sure to import the Dept model

class DeptSeeder extends Seeder
{
    public function run()
    {
        $departments = [
            null,
            'MANAGEMENT',
            'HRD dan GAL',
            'SERVICE',
            'INFORMATION SYSTEM AND TECHNOLOGY',
            'CUSTOMER FIRST DEALER',
            'MARKETING',
            'ADMIN DAN UMUM',
            'VARIASI',
            'F AND B SERVICE',

        ];

        foreach ($departments as $name) {
            Dept::create([
                'name' => $name,
            ]);
        }
    }
}
