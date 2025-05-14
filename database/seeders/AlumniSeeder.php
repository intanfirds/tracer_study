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
                'alumni_id' => 1,
                'level_id' => 2,
                'nama' => 'Kayla',
                'NIM' => '2341760103',
                'tahun_lulus' => '2022',
                'password' => Hash::make('123456'),
                'prodi_id' => 1,
                'no_hp' => null,
                'email' => null,
                'foto' => null,
            ],
            [
                'alumni_id' => 2,
                'level_id' => 2,
                'nama' => 'Intan Firdausi',
                'NIM' => '2341760185',
                'tahun_lulus' => '2020',
                'password' => Hash::make('123456'),
                'prodi_id' => 2,
                'no_hp' => null,
                'email' => null,
                'foto' => null,
            ],
            [
                'alumni_id' => 3,
                'level_id' => 2,
                'nama' => 'Kaka',
                'NIM' => '2341760005',
                'tahun_lulus' => '2019',
                'password' => Hash::make('123456'),
                'prodi_id' => 1,
                'no_hp' => null,
                'email' => null,
                'foto' => null,
            ]
        ]);
    }
}
