<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Ayeuna Project',
            'email' => '@Y3Un4_!24#BdG',
            'role' => 'admin',
            'password' => Hash::make('@Y3Un4_!24#BdG'),
            'tps' => '000',
            'kelurahan' => 'admin',
            'kecamatan' => 'admin',
        ]);
    }
}
