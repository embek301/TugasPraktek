<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Dept; // Make sure to import the Dept model

class DeptSeeder extends Seeder
{
    public function run()
    {
        $departments = [
            ['name' => 'MANAGEMENT'],
            ['name' => 'HRD dan GAL'],
            ['name' => 'SERVICE'],
            ['name' => 'INFORMATION SYSTEM AND TECHNOLOGY'],
            ['name' => 'CUSTOMER FIRST DEALER'],
            ['name' => 'MARKETING'],
            ['name' => 'ADMIN DAN UMUM'],
            ['name' => 'VARIASI'],
            ['name' => 'F AND B SERVICE'],
        ];

        foreach ($departments as $department) {
            Dept::create($department);
        }
    }
}