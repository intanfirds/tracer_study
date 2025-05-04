<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\KategoriProfesi;

class KategoriProfesiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        KategoriProfesi::insert([
            [
                'kode_kategori' => 'KP001',
                'nama' => 'Software Engineer',
                'keterangan' => 'Pengembang perangkat lunak.'
            ],
            [
                'kode_kategori' => 'KP002',
                'nama' => 'Trainer / Guru / Dosen (IT)',
                'keterangan' => 'Mengajar dan melatih dalam bidang teknologi informasi.'
            ],
            [
                'kode_kategori' => 'KP003',
                'nama' => 'Data Analyst',
                'keterangan' => 'Analisis data dan pelaporan.'
            ],
        ]);
    }
}
