<?php

namespace App\Filament\Teacher\Resources\QuizResource\Pages;

use App\Filament\Teacher\Resources\QuizResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewQuizzes extends ViewRecord
{
    protected static string $resource = QuizResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
