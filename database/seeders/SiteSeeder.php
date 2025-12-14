<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SiteSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('site')->insert([
            [
                'uuid' => Str::uuid(),
                'name' => 'Company Profile',
                'deskripsi' => 'Website resmi company profile',
                'gambar' => 'site/693c66e602ec2.jpeg',
                'tentang' => 'Website ini digunakan sebagai media informasi resmi perusahaan, berisi profil, layanan, dan kontak.',
                'alamat' => 'Jl. Merdeka No. 123, Jakarta',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
