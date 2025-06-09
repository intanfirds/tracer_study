<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TokenAlumni;

class TokenAlumniSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TokenAlumni::insert([
            [
                'email' => 'kayla.amelia@example.com',
                'token' => '123456789032', // 12 characters
                'alumni_id' => 1,
                'expires_at' => now()->addDays(30),
                'used_at' => now(),
            ],
            [
                'email' => 'intanfir27@gmail.com',
                'token' => '123456789932', // 12 characters
                'alumni_id' => 2,
                'expires_at' => now()->addDays(30),
                'used_at' => null,
            ],
            [
                'email' => 'scarlletaja27@gmail.com',
                'token' => '098765432132', // 12 characters
                'alumni_id' => 3,
                'expires_at' => now()->addDays(30),
                'used_at' => now(),
            ],
            [
                'email' => 'nadia.permatasari@example.com',
                'token' => '987654321032', // 12 characters random number
                'alumni_id' => 4,
                'expires_at' => now()->addDays(30),
                'used_at' => now(),
            ],
            [
                'email' => 'dina.prameswari@example.com',
                'token' => '876543210932', // 12 characters
                'alumni_id' => 5,
                'expires_at' => now()->addDays(30),
                'used_at' => now(),
            ],
            [
                'email' => 'rama.wiratama@example.com',
                'token' => '765432109832', // 12 characters
                'alumni_id' => 6,
                'expires_at' => now()->addDays(30),
                'used_at' => now(),
            ],
            [
                'email' => 'putri.maharani@example.com',
                'token' => '654321098732', // 12 characters
                'alumni_id' => 7,
                'expires_at' => now()->addDays(30),
                'used_at' => now(),
            ],
            [
                'email' => 'budi.hidayat@example.com',
                'token' => '543210987632', // 12 characters
                'alumni_id' => 8,
                'expires_at' => now()->addDays(30),
                'used_at' => now(),
            ],
            [
                'email' => 'siti.zahra@example.com',
                'token' => '432109876532', // 12 characters
                'alumni_id' => 9,
                'expires_at' => now()->addDays(30),
                'used_at' => now(),
            ],
            [
                'email' => 'dewi.safitri@example.com',
                'token' => '321098765432', // 12 characters
                'alumni_id' => 10,
                'expires_at' => now()->addDays(30),
                'used_at' => now(),
            ],
            [
                'email' => 'galih.pangestu@example.com',
                'token' => '210987654332', // 12 characters
                'alumni_id' => 11,
                'expires_at' => now()->addDays(30),
                'used_at' => null,
            ],
            [
                'email' => 'rina.lestari@example.com',
                'token' => '109876543221', // 12 characters
                'alumni_id' => 12,
                'expires_at' => now()->addDays(30),
                'used_at' => null,
            ],
            [
                'email' => 'agus.santoso@example.com',
                'token' => '098765432121', // 12 characters
                'alumni_id' => 13,
                'expires_at' => now()->addDays(30),
                'used_at' => now(),
            ],
            [
                'email' => 'lisa.dewi@example.com',
                'token' => '987654321021', // 12 characters
                'alumni_id' => 14,
                'expires_at' => now()->addDays(30),
                'used_at' => now(),
            ],
            [
                'email' => 'andi.wijaya@example.com',
                'token' => '876543210921', // 12 characters
                'alumni_id' => 15,
                'expires_at' => now()->addDays(30),
                'used_at' => now(),
            ],
            [
                'email' => 'riko.putra@example.com',
                'token' => '765432109821', // 12 characters
                'alumni_id' => 16,
                'expires_at' => now()->addDays(30),
                'used_at' => now(),
            ],
            [
                'email' => 'lia.wardhani@example.com',
                'token' => '654321098721', // 12 characters
                'alumni_id' => 17,
                'expires_at' => now()->addDays(30),
                'used_at' => now(),
            ],
            [
                'email' => 'bagas.utama@example.com',
                'token' => '543210987621', // 12 characters
                'alumni_id' => 18,
                'expires_at' => now()->addDays(30),
                'used_at' => now(),
            ],
            [
                'email' => 'mega.putri@example.com',
                'token' => '432109876521', // 12 characters
                'alumni_id' => 19,
                'expires_at' => now()->addDays(30),
                'used_at' => now(),
            ],
            [
                'email' => 'putri.lestari@example.com',
                'token' => '321098765421', // 12 characters
                'alumni_id' => 20,
                'expires_at' => now()->addDays(30),
                'used_at' => null,
            ],
        ]);
    }
}