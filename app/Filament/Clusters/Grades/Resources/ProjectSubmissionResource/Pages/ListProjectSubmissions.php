<?php

namespace App\Filament\Clusters\Grades\Resources\ProjectSubmissionResource\Pages;

use App\Filament\Clusters\Grades\Resources\ProjectSubmissionResource;
use Filament\Resources\Pages\ListRecords;

class ListProjectSubmissions extends ListRecords
{
    protected static string $resource = ProjectSubmissionResource::class;

    protected function getHeaderActions(): array
    {
        return [

        ];
    }
}
