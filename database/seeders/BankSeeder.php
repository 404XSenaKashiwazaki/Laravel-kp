<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class BankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('bank')->insert([
            [
                'uuid' => Str::uuid(),
                'name' => 'BRI',
                'nomor' => 253464575765878,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
