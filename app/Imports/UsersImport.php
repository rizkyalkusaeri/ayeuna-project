<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UsersImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new User(
            [
                'name' => $row['nama'] ?? 'examp',
                'email' =>  $row['nik'],
                'role' => 'user',
                'password' => Hash::make($row['nik']),
                'tps' => $row['tps'],
                'kelurahan' => $row['kelurahan'],
                'kecamatan' => $row['kecamatan'],
            ]
        );
    }
}
