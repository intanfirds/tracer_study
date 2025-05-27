<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            ProgramStudiSeeder::class,
            LevelSeeder::class,
            AlumniSeeder::class,
            AdminSeeder::class,
            JenisInstansiTableSeeder::class,
            InstansiSeeder::class,
            KategoriProfesiSeeder::class,
            PermintaanPengisianSeeder::class,
            DetailProfesiAlumniSeeder::class,
            SurveyKepuasanLulusanSeeder::class,
            TokenAlumni::class,
            TokenInstansi::class,
        ]);
    }
}
