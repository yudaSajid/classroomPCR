<?php

namespace App\Filament\Teacher\Resources\ClassroomDetailResource\Pages;

use App\Filament\Teacher\Resources\ClassroomDetailResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListClassroomDetails extends ListRecords
{
    protected static string $resource = ClassroomDetailResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
