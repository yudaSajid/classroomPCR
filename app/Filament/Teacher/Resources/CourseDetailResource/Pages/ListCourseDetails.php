<?php

namespace App\Filament\Teacher\Resources\CourseDetailResource\Pages;

use App\Filament\Teacher\Resources\CourseDetailResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCourseDetails extends ListRecords
{
    protected static string $resource = CourseDetailResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
