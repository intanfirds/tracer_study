<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Instansi;

class InstansiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Instansi::insert([
            [
                'level_id' => 3,
                'alumni_id' => 1,
                'nama_instansi' => 'PT Teknologi Hijau',
                'nama_atasan' => 'Bambang',
                'jenis_instansi_id' => 3,
                'lokasi_instansi' => 'Jakarta',
                'jabatan' => 'Manager',
                'skala' => 'Nasional',
                'email_atasan' => 'bambang@gmail.com',
                'no_hp_atasan' => '085811119999',
            ],
            [
                'level_id' => 3,
                'alumni_id' => 2,
                'nama_instansi' => 'Universitas A',
                'nama_atasan' => 'Jarwo',
                'jenis_instansi_id' => 1,
                'lokasi_instansi' => 'Bandung',
                'jabatan' => 'Koordinator Program Studi',
                'skala' => 'Nasional',
                'email_atasan' => 'jarwo@gmail.com',
                'no_hp_atasan' => '085877775555',
            ],
        ]);
    }
}
