<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PermintaanPengisian;

class PermintaanPengisianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PermintaanPengisian::insert([
            [
                'admin_id' => 1,
                'instansi_id' => 1,
                'tanggal_dikirim' => '2024-12-12'
            ],
            [
                'admin_id' => 1,
                'instansi_id' => 2,
                'tanggal_dikirim' => '2025-04-30'
            ],
        ]);
    }
}
