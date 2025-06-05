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
                'nama_instansi' => 'PT Digital Solusi',
                'nama_atasan' => 'Agus Santoso',
                'jenis_instansi_id' => 3,
                'lokasi_instansi' => 'Jakarta',
                'jabatan' => 'Software Engineer',
                'skala' => 'Nasional',
                'email_atasan' => 'agus@digitalsolusi.com',
                'no_hp_atasan' => '085800112233'
            ],
            [   
                'level_id' => 3,
                'alumni_id' => 2,
                'nama_instansi' => 'PT Inovasi Teknologi',
                'nama_atasan' => 'Budi Setiawan',
                'jenis_instansi_id' => 3,
                'lokasi_instansi' => 'Bandung',
                'jabatan' => 'Data Scientist',
                'skala' => 'Nasional',
                'email_atasan' => 'budi@inovati.com',
                'no_hp_atasan' => '085800334455'
            ],
            [
                'level_id' => 3,
                'alumni_id' => 4,
                'nama_instansi' => 'Universitas Teknologi Indonesia',
                'nama_atasan' => 'Dr. Rina Wijaya',
                'jenis_instansi_id' => 1,
                'lokasi_instansi' => 'Jakarta',
                'jabatan' => 'Dosen Teknologi Informasi',
                'skala' => 'Nasional',
                'email_atasan' => 'rina@ut.ac.id',
                'no_hp_atasan' => '085800112233'
            ],
            [
                'level_id' => 3,
                'alumni_id' => 5,
                'nama_instansi' => 'PT Keuangan Digital',
                'nama_atasan' => 'Siti Aminah',
                'jenis_instansi_id' => 2,
                'lokasi_instansi' => 'Jakarta',
                'jabatan' => 'Analis Keuangan',
                'skala' => 'Nasional',
                'email_atasan' => 'siti@keuangandigital.com',
                'no_hp_atasan' => '085822223333'
            ],
            [
                'level_id' => 3,
                'alumni_id' => 6,
                'nama_instansi' => 'Dinas Pariwisata',
                'nama_atasan' => 'Slamet Riyadi',
                'jenis_instansi_id' => 2,
                'lokasi_instansi' => 'Semarang',
                'jabatan' => 'PNS',
                'skala' => 'Nasional',
                'email_atasan' => 'slamet@disparjateng.go.id',
                'no_hp_atasan' => '085855551111'
            ],
            [
                'level_id' => 3,
                'alumni_id' => 8,
                'nama_instansi' => 'PT Cloud Teknologi',
                'nama_atasan' => 'Wahyu Herlambang',
                'jenis_instansi_id' => 3,
                'lokasi_instansi' => 'Jakarta',
                'jabatan' => 'DevOps Engineer',
                'skala' => 'Wirausaha',
                'email_atasan' => 'wahyu@cloudtek.com',
                'no_hp_atasan' => '085822221111'
            ],
            [
                'level_id' => 3,
                'alumni_id' => 9,
                'nama_instansi' => 'PT Kreasi Visual',
                'nama_atasan' => 'Rina Kartika',
                'jenis_instansi_id' => 3,
                'lokasi_instansi' => 'Jakarta',
                'jabatan' => 'UI/UX Designer',
                'skala' => 'Nasional',
                'email_atasan' => 'rina@kreasivisual.com',
                'no_hp_atasan' => '085800334455'
            ],
            [
                'level_id' => 3,
                'alumni_id' => 10,
                'nama_instansi' => 'Kemenkeu',
                'nama_atasan' => 'Andi Nugroho',
                'jenis_instansi_id' => 2,
                'lokasi_instansi' => 'Jakarta',
                'jabatan' => 'Analis Kebijakan',
                'skala' => 'Nasional',
                'email_atasan' => 'andi@kemenkeu.go.id',
                'no_hp_atasan' => '085899998888'
            ],
            [
                'level_id' => 3,
                'alumni_id' => 13,
                'nama_instansi' => 'Startup Mobile App',
                'nama_atasan' => 'Dewi Rahma',
                'jenis_instansi_id' => 3,
                'lokasi_instansi' => 'Bandung',
                'jabatan' => 'Mobile Developer',
                'skala' => 'Nasional',
                'email_atasan' => 'dewi@startupmobile.com',
                'no_hp_atasan' => '085822223333'
            ],
            [
                'level_id' => 3,
                'alumni_id' => 14,
                'nama_instansi' => 'PT Human Capital',
                'nama_atasan' => 'Putri Lestari',
                'jenis_instansi_id' => 3,
                'lokasi_instansi' => 'Semarang',
                'jabatan' => 'HRD Officer',
                'skala' => 'Nasional',
                'email_atasan' => 'putri@humancapital.com',
                'no_hp_atasan' => '085877766655'
            ],
            [
                'level_id' => 3,
                'alumni_id' => 16,
                'nama_instansi' => 'PT Networkindo',
                'nama_atasan' => 'Bagus Setiawan',
                'jenis_instansi_id' => 3,
                'lokasi_instansi' => 'Yogyakarta',
                'jabatan' => 'Network Engineer',
                'skala' => 'Nasional',
                'email_atasan' => 'bagus@networkindo.com',
                'no_hp_atasan' => '085811117777'
            ],
            [
                'level_id' => 3,
                'alumni_id' => 17,
                'nama_instansi' => 'Kantor Desa Sukamaju',
                'nama_atasan' => 'Hendra Gunawan',
                'jenis_instansi_id' => 2,
                'lokasi_instansi' => 'Bogor',
                'jabatan' => 'Staf Administrasi',
                'skala' => 'Nasional',
                'email_atasan' => 'hendra@pemdes.sukamaju.go.id',
                'no_hp_atasan' => '085866660000'
            ],
            [
                'level_id' => 3,
                'alumni_id' => 19,
                'nama_instansi' => 'PT Creative Web',
                'nama_atasan' => 'Aditya Rahman',
                'jenis_instansi_id' => 3,
                'lokasi_instansi' => 'Jakarta',
                'jabatan' => 'Frontend Developer',
                'skala' => 'Nasional',
                'email_atasan' => 'aditya@creativeweb.com',
                'no_hp_atasan' => '085899996666'
            ],
        ]);
    }
}
