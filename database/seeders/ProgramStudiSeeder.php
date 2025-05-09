<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ProgramStudi;

class ProgramStudiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProgramStudi ::insert([
            [
                'nama_prodi' => 'D-IV Teknik Informatika',
            ],
            [
                'nama_prodi' => 'D-IV Sistem Informasi Bisnis',
            ],
        ]);
    }
}
