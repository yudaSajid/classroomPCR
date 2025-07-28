<?php

namespace App\Filament\Resources\UserEducationResource\Pages;

use App\Filament\Resources\UserEducationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUserEducation extends EditRecord
{
    protected static string $resource = UserEducationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
