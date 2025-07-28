<?php

namespace App\Filament\Resources\UserEducationResource\Pages;

use App\Filament\Resources\UserEducationResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListUserEducation extends ListRecords
{
    protected static string $resource = UserEducationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
