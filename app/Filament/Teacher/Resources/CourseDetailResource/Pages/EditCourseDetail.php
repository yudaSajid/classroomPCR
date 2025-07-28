<?php

namespace App\Filament\Teacher\Resources\CourseDetailResource\Pages;

use App\Filament\Teacher\Resources\CourseDetailResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCourseDetail extends EditRecord
{
    protected static string $resource = CourseDetailResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
