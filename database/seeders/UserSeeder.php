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
            'email' => 'ayeuna_project',
            'role' => 'admin',
            'password' => Hash::make('ayeuna_project'),
            'tps' => '000',
            'kelurahan' => 'admin',
            'kecamatan' => 'admin',
        ]);
    }
}
