<?php

namespace App\Filament\Actions;

use App\Imports\UsersImport;
use Filament\Tables\Actions\Action;
use Filament\Forms\Components\FileUpload;
use Maatwebsite\Excel\Facades\Excel;
use Filament\Notifications\Notification;

class ImportStudentsAction extends Action
{
    public static function getDefaultName(): ?string
    {
        return 'importStudents';
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->label('Import Students')
            ->form([
                FileUpload::make('excel_file')
                    ->label('Excel File')
                    ->acceptedFileTypes(['application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'])
                    ->maxSize(5120)
                    ->required()
            ])
            ->action(function (array $data): void {
                Excel::import(new UsersImport, $data['excel_file']);

                Notification::make()
                    ->title('Import successful')
                    ->success()
                    ->send();
            });
    }
}
