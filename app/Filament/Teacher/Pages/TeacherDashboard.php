<?php

namespace App\Filament\Teacher\Pages;

use Filament\Pages\Page;

class TeacherDashboard extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-home';

    protected static string $view = 'filament.teacher.pages.teacher-dashboard';

    protected static ?string $title = 'Teacher Dashboard';

    protected static ?string $slug = 'teacher-dashboard';

    protected static ?string $navigationGroup = 'Dashboard';

    protected static ?int $navigationSort = -1;

    public function getHeaderWidgets(): array
    {
        return [
            // Add any widgets you want to display on the dashboard header
        ];
    }

    public function getFooterWidgets(): array
    {
        return [
            // Add any widgets you want to display on the dashboard footer
        ];
    }
}
