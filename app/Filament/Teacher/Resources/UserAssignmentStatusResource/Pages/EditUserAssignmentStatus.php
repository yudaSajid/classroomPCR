<?php

namespace App\Filament\Teacher\Resources\UserAssignmentStatusResource\Pages;

use App\Filament\Teacher\Resources\UserAssignmentStatusResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUserAssignmentStatus extends EditRecord
{
    protected static string $resource = UserAssignmentStatusResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
