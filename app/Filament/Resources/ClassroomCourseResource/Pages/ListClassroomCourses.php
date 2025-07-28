<?php

namespace App\Filament\Resources\ClassroomCourseResource\Pages;

use App\Filament\Resources\ClassroomCourseResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListClassroomCourses extends ListRecords
{
    protected static string $resource = ClassroomCourseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
