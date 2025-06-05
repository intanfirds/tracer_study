<?php

namespace Database\Seeders;

use App\Models\SurveyKepuasanLulusan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SurveyKepuasanLulusanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SurveyKepuasanLulusan::insert([
            [
                'alumni_id' => 1,
                'instansi_id' => 1,
                'tanggal' => now(),
                'kerjasama_tim' => 'Baik',
                'keahlian_bidang_it' => 'Sangat Baik',
                'kemampuan_berbahasa_asing' => 'Cukup',
                'kemampuan_berkomunikasi' => 'Kurang',
                'pengembangan_diri' => 'Baik',
                'kepemimpinan' => 'Baik',
                'etos_kerja' => 'Baik',
                'saran_untuk_kurikulum_prodi' => 'Cukup baik',
                'kemampuan_tdk_terpenuhi' => 'Baik',
                'status_pengisian' => 'Selesai',
            ],
            [
                'alumni_id' => 4,
                'instansi_id' => 2,
                'tanggal' => now(),
                'kerjasama_tim' => 'Baik',
                'keahlian_bidang_it' => 'Sangat Baik',
                'kemampuan_berbahasa_asing' => 'Baik',
                'kemampuan_berkomunikasi' => 'Baik',
                'pengembangan_diri' => 'Kurang',
                'kepemimpinan' => 'Baik',
                'etos_kerja' => 'Cukup',
                'saran_untuk_kurikulum_prodi' => 'Baik',
                'kemampuan_tdk_terpenuhi' => 'Baik',
                'status_pengisian' => 'Selesai',
            ],
            [
                'alumni_id' => 5,
                'instansi_id' => 3,
                'tanggal' => now(),
                'kerjasama_tim' => 'Baik',
                'keahlian_bidang_it' => 'Baik',
                'kemampuan_berbahasa_asing' => 'Baik',
                'kemampuan_berkomunikasi' => 'Baik',
                'pengembangan_diri' => 'Baik',
                'kepemimpinan' => 'Baik',
                'etos_kerja' => 'Baik',
                'saran_untuk_kurikulum_prodi' => 'Baik',
                'kemampuan_tdk_terpenuhi' => 'Baik',
                'status_pengisian' => 'Selesai',
            ],
            [
                'alumni_id' => 6,
                'instansi_id' => 4,
                'tanggal' => now(),
                'kerjasama_tim' => 'Baik',
                'keahlian_bidang_it' => 'Cukup',
                'kemampuan_berbahasa_asing' => 'Kurang',
                'kemampuan_berkomunikasi' => 'Baik',
                'pengembangan_diri' => 'Baik',
                'kepemimpinan' => 'Cukup',
                'etos_kerja' => 'Baik',
                'saran_untuk_kurikulum_prodi' => 'Perlu peningkatan',
                'kemampuan_tdk_terpenuhi' => 'Cukup',
                'status_pengisian' => 'Selesai',
            ],
            [
                'alumni_id' => 8,
                'instansi_id' => 5,
                'tanggal' => now(),
                'kerjasama_tim' => 'Sangat Baik',
                'keahlian_bidang_it' => 'Sangat Baik',
                'kemampuan_berbahasa_asing' => 'Baik',
                'kemampuan_berkomunikasi' => 'Sangat Baik',
                'pengembangan_diri' => 'Baik',
                'kepemimpinan' => 'Sangat Baik',
                'etos_kerja' => 'Sangat Baik',
                'saran_untuk_kurikulum_prodi' => 'Perlu peningkatan',
                'kemampuan_tdk_terpenuhi' => 'Baik',
                'status_pengisian' => 'Selesai',
            ],
        ]);
    }
}
