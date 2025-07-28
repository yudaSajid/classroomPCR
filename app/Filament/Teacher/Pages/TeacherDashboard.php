<?php

namespace App\Filament\Teacher\Pages;

use Filament\Pages\Page;
use Filament\Support\Colors\Color;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\Grid;
use Filament\Infolists\Components\ViewEntry;
use Filament\Infolists\Infolist;

class TeacherDashboard extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-home';

    protected static string $view = 'filament.teacher.pages.teacher-dashboard';

    protected static ?string $title = 'Teacher Dashboard';

    protected static ?string $slug = 'teacher-dashboard';

    protected static ?string $navigationGroup = 'Dashboard';

    protected static ?int $navigationSort = 1;

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make('Quick Access')
                    ->description('Jump directly to key management areas.')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                ViewEntry::make('shortcuts')
                            ->view('filament.teacher.pages.components.dashboard-shortcuts')
                            ->viewData([
                                'shortcuts' => [
                                    [
                                        'label' => 'Manage Classrooms',
                                        'icon' => 'heroicon-o-academic-cap',
                                        'color' => 'blue',
                                        'url' => \App\Filament\Teacher\Resources\ClassroomDetailResource::getUrl('index'),
                                    ],
                                    [
                                        'label' => 'Manage Courses',
                                        'icon' => 'heroicon-o-book-open',
                                        'color' => 'green',
                                        'url' => \App\Filament\Teacher\Resources\CourseResource::getUrl('index'),
                                    ],
                                    [
                                        'label' => 'Manage Badges',
                                        'icon' => 'heroicon-o-trophy',
                                        'color' => 'amber',
                                        'url' => \App\Filament\Teacher\Pages\BadgePage::getUrl(),
                                    ],
                                    [
                                        'label' => 'Grade Assignments',
                                        'icon' => 'heroicon-o-pencil-square',
                                        'color' => 'red',
                                        'url' => \App\Filament\Teacher\Resources\AssignmentResource::getUrl('index'),
                                    ],
                                ],
                            ]),
                            ]),
                    ]),
            ]);
    }

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
