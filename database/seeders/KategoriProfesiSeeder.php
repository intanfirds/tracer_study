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
                'kode_kategori' => 'IT',
                'nama' => 'Bidang Infokom',
                'keterangan' => 'Profesi yang bergerak di bidang teknologi informasi dan komunikasi.',
            ],
            [
                'kode_kategori' => 'NON-IT',
                'nama' => 'Bidang Non-Infokom',
                'keterangan' => 'Profesi yang tidak terkait langsung dengan bidang teknologi informasi dan komunikasi.',
            ],
            [
                'kode_kategori' => 'BELUM',
                'nama' => 'Belum Bekerja',
                'keterangan' => 'Individu yang saat ini belum memiliki pekerjaan.',
            ],
            [
                'kode_kategori' => 'PEND-IT',
                'nama' => 'Pendidikan Infokom',
                'keterangan' => 'Sedang melanjutkan pendidikan di bidang teknologi informasi dan komunikasi.',
            ],
            [
                'kode_kategori' => 'PEND-NON-IT',
                'nama' => 'Pendidikan Non-Infokom',
                'keterangan' => 'Sedang melanjutkan pendidikan di luar bidang teknologi informasi dan komunikasi.',
            ],
        ]);
    }
}
