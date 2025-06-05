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
                'alumni_id' => 3,
                'kategori_id' => 1,
                'tanggal_pertama_kerja' => Carbon::parse('2020-01-10'),
                'masa_tunggu' => 4,
                'tanggal_mulai_kerja_instansi_saat_ini' => Carbon::parse('2020-05-01'),
                'profesi' => 'Fullstack Developer',
                'tanggal_pengisian' => Carbon::now(),
                'status_pengisian' => 'Sudah Diisi'
            ],
            [
                'alumni_id' => 4,
                'kategori_id' => 4,
                'tanggal_pertama_kerja' => Carbon::parse('2023-01-15'),
                'masa_tunggu' => 2,
                'tanggal_mulai_kerja_instansi_saat_ini' => Carbon::parse('2023-02-01'),
                'profesi' => 'Mahasiswa S2 Teknologi Informasi',
                'tanggal_pengisian' => Carbon::now(),
                'status_pengisian' => 'Sudah Diisi'
            ],
            [
                'alumni_id' => 5,
                'kategori_id' => 2,
                'tanggal_pertama_kerja' => Carbon::parse('2023-06-20'),
                'masa_tunggu' => 6,
                'tanggal_mulai_kerja_instansi_saat_ini' => Carbon::parse('2023-07-01'),
                'profesi' => 'Analis Keuangan',
                'tanggal_pengisian' => Carbon::now(),
                'status_pengisian' => 'Sudah Diisi'
            ],
            [
                'alumni_id' => 6,
                'kategori_id' => 1,
                'tanggal_pertama_kerja' => Carbon::parse('2020-03-01'),
                'masa_tunggu' => 3,
                'tanggal_mulai_kerja_instansi_saat_ini' => Carbon::parse('2020-06-01'),
                'profesi' => 'Mobile Developer',
                'tanggal_pengisian' => Carbon::now(),
                'status_pengisian' => 'Sudah Diisi'
            ],
            [
                'alumni_id' => 7,
                'kategori_id' => 3,
                'tanggal_pertama_kerja' => null,
                'masa_tunggu' => null,
                'tanggal_mulai_kerja_instansi_saat_ini' => null,
                'profesi' => null,
                'tanggal_pengisian' => Carbon::now(),
                'status_pengisian' => 'Sudah Diisi'
            ],
            [
                'alumni_id' => 8,
                'kategori_id' => 2,
                'tanggal_pertama_kerja' => Carbon::parse('2022-09-01'),
                'masa_tunggu' => 5,
                'tanggal_mulai_kerja_instansi_saat_ini' => Carbon::parse('2022-10-01'),
                'profesi' => 'Supervisor Produksi',
                'tanggal_pengisian' => Carbon::now(),
                'status_pengisian' => 'Sudah Diisi'
            ],
            [
                'alumni_id' => 9,
                'kategori_id' => 1,
                'tanggal_pertama_kerja' => Carbon::parse('2022-11-01'),
                'masa_tunggu' => 4,
                'tanggal_mulai_kerja_instansi_saat_ini' => Carbon::parse('2023-03-01'),
                'profesi' => 'UI/UX Designer',
                'tanggal_pengisian' => Carbon::now(),
                'status_pengisian' => 'Sudah Diisi'
            ],
            [
                'alumni_id' => 10,
                'kategori_id' => 2,
                'tanggal_pertama_kerja' => Carbon::parse('2020-06-01'),
                'masa_tunggu' => 2,
                'tanggal_mulai_kerja_instansi_saat_ini' => Carbon::parse('2020-08-01'),
                'profesi' => 'Analis Kebijakan',
                'tanggal_pengisian' => Carbon::now(),
                'status_pengisian' => 'Sudah Diisi'
            ],
            [
                'alumni_id' => 13,
                'kategori_id' => 1,
                'tanggal_pertama_kerja' => Carbon::parse('2021-10-01'),
                'masa_tunggu' => 6,
                'tanggal_mulai_kerja_instansi_saat_ini' => Carbon::parse('2022-04-01'),
                'profesi' => 'Mobile Developer',
                'tanggal_pengisian' => Carbon::now(),
                'status_pengisian' => 'Sudah Diisi'
            ],
            [
                'alumni_id' => 14,
                'kategori_id' => 2,
                'tanggal_pertama_kerja' => Carbon::parse('2020-12-01'),
                'masa_tunggu' => 3,
                'tanggal_mulai_kerja_instansi_saat_ini' => Carbon::parse('2021-03-01'),
                'profesi' => 'HRD Officer',
                'tanggal_pengisian' => Carbon::now(),
                'status_pengisian' => 'Sudah Diisi'
            ],
            [
                'alumni_id' => 15,
                'kategori_id' => 3,
                'tanggal_pertama_kerja' => null,
                'masa_tunggu' => null,
                'tanggal_mulai_kerja_instansi_saat_ini' => null,
                'profesi' => null,
                'tanggal_pengisian' => Carbon::now(),
                'status_pengisian' => 'Sudah Diisi'
            ],
            [
                'alumni_id' => 16,
                'kategori_id' => 1,
                'tanggal_pertama_kerja' => Carbon::parse('2023-04-01'),
                'masa_tunggu' => 2,
                'tanggal_mulai_kerja_instansi_saat_ini' => Carbon::parse('2023-06-01'),
                'profesi' => 'Network Engineer',
                'tanggal_pengisian' => Carbon::now(),
                'status_pengisian' => 'Sudah Diisi'
            ],
            [
                'alumni_id' => 17,
                'kategori_id' => 2,
                'tanggal_pertama_kerja' => Carbon::parse('2021-01-01'),
                'masa_tunggu' => 1,
                'tanggal_mulai_kerja_instansi_saat_ini' => Carbon::parse('2021-02-01'),
                'profesi' => 'Staf Administrasi',
                'tanggal_pengisian' => Carbon::now(),
                'status_pengisian' => 'Sudah Diisi'
            ],
            [
                'alumni_id' => 18,
                'kategori_id' => 3,
                'tanggal_pertama_kerja' => null,
                'masa_tunggu' => null,
                'tanggal_mulai_kerja_instansi_saat_ini' => null,
                'profesi' => null,
                'tanggal_pengisian' => Carbon::now(),
                'status_pengisian' => 'Sudah Diisi'
            ],
            [
                'alumni_id' => 19,
                'kategori_id' => 1,
                'tanggal_pertama_kerja' => Carbon::parse('2022-08-01'),
                'masa_tunggu' => 5,
                'tanggal_mulai_kerja_instansi_saat_ini' => Carbon::parse('2023-01-01'),
                'profesi' => 'Frontend Developer',
                'tanggal_pengisian' => Carbon::now(),
                'status_pengisian' => 'Sudah Diisi'
            ],
        ]);
    }
}
