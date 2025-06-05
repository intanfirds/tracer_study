<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::insert([
            [
                'level_id' => 1,
                'nama' => 'Admin Satu',
                'email' => 'adminsatu@gmail.com',
                'password' => Hash::make('password123'),
            ],
            [
                'level_id' => 1,
                'nama' => 'Admin Dua',
                'email' => 'admindua@gmail.com',
                'password' => Hash::make('admin456'),
            ],
            [
                'level_id' => 1,
                'nama' => 'Admin Tiga',
                'email' => 'chopperlefox@gmail.com',
                'password' => Hash::make('admin789'),
            ],
        ]);
    }
}
