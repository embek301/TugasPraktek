<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Hak;

class HakSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'Staff-1',
            'Staff-2',
            'Staff-3',
            'Spv Sales',
            'Kacab',
            'Management',
            'Hrd',
            'Head',
            'Kabeng',
            'Admin',
        ];

        foreach ($data as $name) {
            Hak::create([
                'name' => $name,
            ]);
        }
    }
}