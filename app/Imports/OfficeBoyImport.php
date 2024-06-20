<?php

namespace App\Imports;

use App\Models\OfficeBoy;
use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Hash;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class OfficeBoyImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        $user = User::create([
            'name' => $row['nama_lengkap'],
            'email' => $row['email'],
            'password' => Hash::make($row['password']),
            'role' => 'office_boy'
        ]);

        $tanggal_lahir = Date::excelToDateTimeObject($row['tanggal_lahir'])->format('Y-m-d');

        $officeBoy = new OfficeBoy([
            'nik' => $row['nik'],
            'nama_lengkap' => $row['nama_lengkap'],
            'user_id' => $user->id,
            'tahun_masuk' => $row['tahun_masuk'],
            'tempat_lahir' => $row['tempat_lahir'],
            'tanggal_lahir' => $tanggal_lahir,
            'status' => $row['status'],
            'no_telepon' => $row['no_telepon'],
            'password' => Hash::make($row['password']), // You may change this according to your logic
            'status_profile' => $row['status_profile'],
            'foto_profil' => $row['foto_profil']
        ]);

        $officeBoy->save();
    }
}