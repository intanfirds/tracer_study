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
            /*[
                'level_id' => 2,
                'nama' => 'Putri',
                'NIM' => '2341760103',
                'password' => Hash::make('alumni123'),
                'prodi_id' => 1,
                'no_hp' => '085711112222',
                'email' => 'putri@gmail.com',
            ],
            [
                'level_id' => 2,
                'nama' => 'Putra',
                'NIM' => '2341760104',
                'password' => Hash::make('alumni456'),
                'prodi_id' => 2,
                'no_hp' => '085733334444',
                'email' => 'putra@gmail.com',
            ],*/
            [
                'level_id' => 2,
                'nama' => 'Intan Firdausi',
                'NIM' => '2341760185',
                'password' => Hash::make('12345'),
                'prodi_id' => 2,
                'no_hp' => '085755556666',
                'email' => 'intanfir27@gmail.com',
            ],
        ]);
    }
}
