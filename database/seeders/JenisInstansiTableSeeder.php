<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\JenisInstansi;

class JenisInstansiTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        JenisInstansi::insert([
            [
                'nama_jenis_instansi' => 'Pendidikan Tinggi',
            ],
            [
                'nama_jenis_instansi' => 'Instansi Pemerintahan',
            ],
            [
                'nama_jenis_instansi' => 'Perusahaan Swasta',
            ],
            [
                'nama_jenis_instansi' => 'BUMN',
            ],
            [
                'nama_jenis_instansi' => 'Lainnya',
            ]
        ]);
    }
}
