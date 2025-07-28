<?php

namespace App\Filament\Teacher\Resources\CourseDetailResource\Pages;

use App\Filament\Teacher\Resources\CourseDetailResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewCourseDetail extends ViewRecord
{
    protected static string $resource = CourseDetailResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
