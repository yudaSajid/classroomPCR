<?php

namespace App\Filament\Resources\ClassroomUserResource\Pages;

use App\Filament\Resources\ClassroomUserResource;
use App\Filament\Resources\ClassroomResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditClassroomUser extends EditRecord
{
    protected static string $resource = ClassroomResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
