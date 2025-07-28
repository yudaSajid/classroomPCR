<?php

namespace App\Filament\Clusters\Grades\Resources\ClassroomResource\Pages;

use App\Filament\Clusters\Grades\Resources\ClassroomResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListClassrooms extends ListRecords
{
    protected static string $resource = ClassroomResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
