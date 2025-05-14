<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Models\DetailProfesiAlumni;

class DetailProfesiAlumniSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DetailProfesiAlumni::insert([
            [
                'alumni_id' => 1,
                'kategori_id' => 1,
                'tanggal_pertama_kerja' => Carbon::parse('2022-07-01'),
                'masa_tunggu' => 3,
                'tanggal_mulai_kerja_instansi_saat_ini' => Carbon::parse('2022-10-01'),
                'profesi' => 'Backend Developer',
                'tanggal_pengisian' => Carbon::now(),
                'status_pengisian' => 'Sudah Diisi'
            ],
            [
                'alumni_id' => 2,
                'kategori_id' => 2,
                'tanggal_pertama_kerja' => Carbon::parse('2021-08-15'),
                'masa_tunggu' => 2,
                'tanggal_mulai_kerja_instansi_saat_ini' => Carbon::parse('2021-09-01'),
                'profesi' => 'Dosen Pemograman',
                'tanggal_pengisian' => Carbon::now(),
                'status_pengisian' => 'Sudah Diisi'
            ],
        ]);
    }
}
