<?php

namespace App\Filament\Teacher\Resources\ClassroomDetailResource\Pages;

use App\Filament\Teacher\Resources\ClassroomDetailResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditClassroomDetail extends EditRecord
{
    protected static string $resource = ClassroomDetailResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
