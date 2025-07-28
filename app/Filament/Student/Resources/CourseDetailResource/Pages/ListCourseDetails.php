<?php

namespace App\Filament\Student\Resources\CourseDetailResource\Pages;

use App\Filament\Student\Resources\CourseDetailResource;
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
