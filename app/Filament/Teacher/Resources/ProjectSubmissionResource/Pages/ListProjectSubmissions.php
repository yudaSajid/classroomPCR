<?php

namespace App\Filament\Teacher\Resources\ProjectSubmissionResource\Pages;

use App\Filament\Teacher\Resources\ProjectSubmissionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListProjectSubmissions extends ListRecords
{
    protected static string $resource = ProjectSubmissionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
