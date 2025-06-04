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
                'alumni_id' => 4,
                'nama_instansi' => 'PT Mega Digital',
                'nama_atasan' => 'Eko Prasetyo',
                'jenis_instansi_id' => 3,
                'lokasi_instansi' => 'Surabaya',
                'jabatan' => 'Full Stack Developer',
                'skala' => 'Nasional',
                'email_atasan' => 'eko@megadigital.com',
                'no_hp_atasan' => '085811114444'
            ],
            [
                'level_id' => 3,
                'alumni_id' => 5,
                'nama_instansi' => 'Institut Teknologi Nasional',
                'nama_atasan' => 'Prof. Sudirman',
                'jenis_instansi_id' => 1,
                'lokasi_instansi' => 'Yogyakarta',
                'jabatan' => 'Mahasiswa Pascasarjana',
                'skala' => 'Nasional',
                'email_atasan' => 'sudirman@itnas.ac.id',
                'no_hp_atasan' => '085833335555'
            ],
            [
                'level_id' => 3,
                'alumni_id' => 6,
                'nama_instansi' => 'Dinas Pariwisata',
                'nama_atasan' => 'Slamet Riyadi',
                'jenis_instansi_id' => 2,
                'lokasi_instansi' => 'Semarang',
                'jabatan' => 'PNS',
                'skala' => 'Daerah',
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
                'skala' => 'Nasional',
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
                'skala' => 'Daerah',
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
            [
                'level_id' => 3,
                'alumni_id' => 12,
                'nama_instansi' => 'Universitas Digital Nusantara',
                'nama_atasan' => 'Dr. Rudi Santoso',
                'jenis_instansi_id' => 1,
                'lokasi_instansi' => 'Bandung',
                'jabatan' => 'Mahasiswa S2 Informatika',
                'skala' => 'Nasional',
                'email_atasan' => 'rudi@udn.ac.id',
                'no_hp_atasan' => '085811112222'
            ],
            [
                'level_id' => 3,
                'alumni_id' => 15,
                'nama_instansi' => 'Universitas Ekonomi Bangsa',
                'nama_atasan' => 'Prof. Lina Puspita',
                'jenis_instansi_id' => 1,
                'lokasi_instansi' => 'Jakarta',
                'jabatan' => 'Mahasiswa Pascasarjana Ekonomi',
                'skala' => 'Nasional',
                'email_atasan' => 'lina@ueb.ac.id',
                'no_hp_atasan' => '085800001111'
            ],
            [
                'level_id' => 3,
                'alumni_id' => 20,
                'nama_instansi' => 'Institut Data Science Indonesia',
                'nama_atasan' => 'Dr. Andini Paramita',
                'jenis_instansi_id' => 1,
                'lokasi_instansi' => 'Yogyakarta',
                'jabatan' => 'Mahasiswa S2 Data Science',
                'skala' => 'Nasional',
                'email_atasan' => 'andini@idsi.ac.id',
                'no_hp_atasan' => '085822226666'
            ]
        ]);
    }
}
