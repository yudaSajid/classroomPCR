<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UsersImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        $user = User::create([
            'name' => $row['name'],
            'email' => $row['email'],
            'password' => Hash::make($row['email']), // Using email as password
        ]);

        // Assign student_user role
        $user->assignRole('student_user');

        return $user;
    }
}
