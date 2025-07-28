<?php

namespace App\Filament\Teacher\Resources\ChapterResource\Pages;

use App\Filament\Teacher\Resources\ChapterResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListChapters extends ListRecords
{
    protected static string $resource = ChapterResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
