<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Alumni;
use Illuminate\Support\Facades\Hash;

class AlumniSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Alumni::insert([
            [
                'level_id' => 2,
                'nama' => 'Putri',
                'NIM' => '2341760103',
                'password' => Hash::make('alumni123'),
                'program_studi' => 'D4 Sistem Informasi Bisnis',
                'no_hp' => '085711112222',
                'email' => 'putri@gmail.com',
            ],
            [
                'level_id' => 2,
                'nama' => 'Putra',
                'NIM' => '2341760104',
                'password' => Hash::make('alumni456'),
                'program_studi' => 'D4 Teknik Informatika',
                'no_hp' => '085733334444',
                'email' => 'putra@gmail.com',
            ],
        ]);
    }
}
