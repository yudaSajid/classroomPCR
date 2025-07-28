<?php

namespace App\Filament\Resources\ClassroomUserResource\Pages;

use App\Filament\Resources\ClassroomUserResource;
use App\Filament\Resources\ClassroomResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListClassroomUsers extends ListRecords
{
    protected static string $resource = ClassroomResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
