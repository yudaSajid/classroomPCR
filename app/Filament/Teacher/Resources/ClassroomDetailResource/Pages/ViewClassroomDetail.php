<?php

namespace App\Filament\Teacher\Resources\ClassroomDetailResource\Pages;

use App\Filament\Teacher\Resources\ClassroomDetailResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewClassroomDetail extends ViewRecord
{
    protected static string $resource = ClassroomDetailResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\EditAction::make(),
        ];
    }
}
