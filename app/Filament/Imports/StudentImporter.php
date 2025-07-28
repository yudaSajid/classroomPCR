<?php

namespace App\Filament\Imports;

use App\Models\User;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Exception;

class StudentImporter extends Importer
{
    protected static ?string $model = User::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('name')
                ->label('Name')
                ->rules(['string', 'max:255']),
            ImportColumn::make('email')
                ->label('Email')
                ->rules(['email', 'unique:users,email']),
        ];
    }

    public function resolveRecord(): ?User
    {
        try {
            $user = User::create([
                'name' => $this->data['name'],
                'email' => $this->data['email'],
                'password' => Hash::make($this->data['email']),
            ]);

            $user->assignRole('student_user');

            Log::info('User created and role assigned', [
                'user_id' => $user->id,
                'email' => $user->email
            ]);

            return $user;
        } catch (Exception $e) {
            Log::error('Import failed:', [
                'error' => $e->getMessage(),
                'data' => $this->data
            ]);
            throw $e;
        }
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Import completed: ' . number_format($import->successful_rows) . ' students imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' failed.';
        }

        return $body;
    }
}
