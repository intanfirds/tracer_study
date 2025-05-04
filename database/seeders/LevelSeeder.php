<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Level;

class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Level::insert([
            ['kode_level' => 'ADM', 'nama' => 'Admin'],
            ['kode_level' => 'ALM', 'nama' => 'Alumni'],
            ['kode_level' => 'INS', 'nama' => 'Instansi'],
        ]);
    }
}
