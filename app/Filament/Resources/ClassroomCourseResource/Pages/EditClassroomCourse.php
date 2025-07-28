<?php

namespace App\Filament\Resources\ClassroomCourseResource\Pages;

use App\Filament\Resources\ClassroomCourseResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditClassroomCourse extends EditRecord
{
    protected static string $resource = ClassroomCourseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
