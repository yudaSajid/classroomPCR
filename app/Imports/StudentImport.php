<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Hash;

class StudentImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // Create user first
        $user = User::create([
            'name' => $row['name'],
            'email' => $row['email'],
            'password' => Hash::make($row['email'])
        ]);

        // Remove any existing roles and assign only student_user role
        $user->roles()->detach();
        $user->assignRole('student_user');

        return $user;
    }
}
