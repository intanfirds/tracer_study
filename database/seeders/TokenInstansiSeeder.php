<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TokenInstansi;

class TokenInstansiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TokenInstansi::insert([
            [
                'token' => '123456789032', // 12 characters
                'instansi_id' => 1,
                'expired_at' => now()->addDays(30),
                'is_used' => true,
            ],
            [
                'token' => '098765432132', // 12 characters
                'instansi_id' => 2,
                'expired_at' => now()->addDays(30),
                'is_used' => true,
            ],
            [
                'token' => '987654321032', // 12 characters random number
                'instansi_id' => 3,
                'expired_at' => now()->addDays(30),
                'is_used' => true,
            ],
            [
                'token' => '876543210932', // 12 characters
                'instansi_id' => 4,
                'expired_at' => now()->addDays(30),
                'is_used' => true,
            ],
            [
                'token' => '765432109832', // 12 characters
                'instansi_id' => 5,
                'expired_at' => now()->addDays(30),
                'is_used' => true,
            ],
            [
                'token' => '654321098732', // 12 characters
                'instansi_id' => 6,
                'expired_at' => now()->addDays(30),
                'is_used' => false,
            ],
            [
                'token' => '543210987632', // 12 characters
                'instansi_id' => 7,
                'expired_at' => now()->addDays(30),
                'is_used' => false,
            ],
            [
                'token' => '432109876532', // 12 characters
                'instansi_id' => 8,
                'expired_at' => now()->addDays(30),
                'is_used' => false,
            ],
            [
                'token' => '321098765432', // 12 characters
                'instansi_id' => 9,
                'expired_at' => now()->addDays(30),
                'is_used' => false,
            ],
            [
                'token' => '210987654332', // 12 characters
                'instansi_id' => 10,
                'expired_at' => now()->addDays(30),
                'is_used' => false,
            ],
            [
                'token' => '109876543221', // 12 characters
                'instansi_id' => 11,
                'expired_at' => now()->addDays(30),
                'is_used' => false,
            ],
            [
                'token' => '098765432121', // 12 characters
                'instansi_id' => 12,
                'expired_at' => now()->addDays(30),
                'is_used' => false,
            ],
            [
                'token' => '987654321021', // 12 characters
                'instansi_id' => 13,
                'expired_at' => now()->addDays(30),
                'is_used' => false,
            ],
        ]);
    }
}
