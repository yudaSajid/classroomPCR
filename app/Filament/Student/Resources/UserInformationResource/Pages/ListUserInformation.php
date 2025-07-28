<?php

namespace App\Filament\Student\Resources\UserInformationResource\Pages;

use App\Filament\Student\Resources\UserInformationResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListUserInformation extends ListRecords
{
    protected static string $resource = UserInformationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
