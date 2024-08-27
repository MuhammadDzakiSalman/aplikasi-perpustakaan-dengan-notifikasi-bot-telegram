<?php

namespace Database\Seeders;

use App\Models\Pustakawan;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PustakawanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Pustakawan::create([
            'username' => 'reniiryanti',
            'password' => bcrypt('reniiryanti'), // It's important to hash passwords
        ],);
    }
}
