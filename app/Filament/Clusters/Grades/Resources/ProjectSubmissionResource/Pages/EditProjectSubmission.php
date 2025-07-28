<?php

namespace App\Filament\Clusters\Grades\Resources\ProjectSubmissionResource\Pages;

use App\Filament\Clusters\Grades\Resources\ProjectSubmissionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProjectSubmission extends EditRecord
{
    protected static string $resource = ProjectSubmissionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
