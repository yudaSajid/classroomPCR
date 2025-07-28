<?php

namespace App\Filament\Student\Resources\CourseDetailResource\Pages;

use App\Filament\Student\Resources\CourseDetailResource;
use App\Livewire\Courses\CourseDetail;
use Filament\Resources\Pages\ViewRecord;

class ViewCourseDetail extends ViewRecord
{
    protected static string $resource = CourseDetailResource::class;

    protected function getHeaderWidgets(): array
    {
        $courseDetail = new CourseDetail; // Create an instance

        if ($courseDetail->canView()) { // Call canView on the instance
            return [
                $courseDetail,
            ];
        }

        return []; // Return empty array if user cannot view details
    }
}
