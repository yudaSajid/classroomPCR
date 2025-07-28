<?php

namespace App\Filament\Teacher\Resources;

use App\Filament\Teacher\Resources\ClassroomDetailResource\Pages;
use App\Filament\Teacher\Resources\ClassroomDetailResource\RelationManagers;
use App\Livewire\ClassroomStudentStats;
use App\Livewire\ManageClassroomCourse;
use App\Models\Classroom;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\Grid;
use Filament\Infolists\Components\Tabs;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\Livewire;
use Filament\Support\Colors\Color;
use App\Models\Course;
use App\Models\ClassroomCourse;
use Filament\Infolists\Components\Actions\Action;
use Filament\Notifications\Notification;
use Illuminate\Support\Str;
use App\Livewire\PointsHistory;

class ClassroomDetailResource extends Resource
{
    protected static ?string $model = Classroom::class;
    protected static bool $skipAuthorizationWhenRegistered = true; // Add this line

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static bool $shouldRegisterNavigation = false;
    // matikan breadcrumbs
    protected static bool $breadcrumbs = false;

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Tabs::make('Classroom Details')
                    ->tabs([
                        Tabs\Tab::make('Overview')
                            ->icon('heroicon-m-information-circle')
                            ->schema([
                                Grid::make(2)
                                    ->schema([
                                        Section::make('Classroom Information')
                                            ->icon('heroicon-o-academic-cap')
                                            ->columnSpan(1)
                                            ->schema([
                                                TextEntry::make('class_name')
                                                    ->label('Class Name')
                                                    ->size(TextEntry\TextEntrySize::Large)
                                                    ->weight('bold'),
                                                TextEntry::make('class_code')
                                                    ->label('Class Code')
                                                    ->badge()
                                                    ->color(Color::Amber),
                                                TextEntry::make('enrollment_year')
                                                    ->label('Year')
                                                    ->icon('heroicon-m-calendar'),
                                                TextEntry::make('program.program_name')
                                                    ->label('Program')
                                                    ->icon('heroicon-m-academic-cap'),
                                            ]),

                                        Section::make('Quick Stats')
                                            ->icon('heroicon-o-chart-bar')
                                            ->columnSpan(1)
                                            ->schema([
                                                TextEntry::make('courses_count')
                                                    ->label('Total Courses')
                                                    ->icon('heroicon-m-book-open')
                                                    ->color(Color::Purple)
                                                    ->size(TextEntry\TextEntrySize::Large)
                                                    ->state(fn (Classroom $record): int =>
                                                        $record->courses()->count()
                                                    ),
                                                TextEntry::make('classroomUsers_count')
                                                    ->label('Total Students')
                                                    ->icon('heroicon-m-users')
                                                    ->color(Color::Blue)
                                                    ->size(TextEntry\TextEntrySize::Large)
                                                    ->state(fn (Classroom $record): int =>
                                                        $record->classroomUsers()->studentOnly()->count()
                                                    ),
                                            ]),
                                    ]),

                                Section::make('Description')
                                    ->icon('heroicon-o-document-text')
                                    ->collapsible()
                                    ->schema([
                                        TextEntry::make('class_description')
                                            ->markdown()
                                            ->columnSpanFull(),
                                    ]),

                                Grid::make(2)
                                    ->schema([
                                        Section::make('Courses')
                                            ->icon('heroicon-o-book-open')
                                            ->collapsible()
                                            ->columnSpan(1)
                                            ->schema([
                                                TextEntry::make('courses')
                                                    ->label('')
                                                    ->listWithLineBreaks()
                                                    ->bulleted()
                                                    ->state(function (Classroom $record): array {
                                                        return $record->courses()
                                                            ->orderBy('course_name')
                                                            ->pluck('course_name')
                                                            ->toArray();
                                                    }),
                                            ]),

                                        Section::make('Students')
                                            ->icon('heroicon-o-users')
                                            ->collapsible()
                                            ->columnSpan(1)
                                            ->schema([
                                                TextEntry::make('students')
                                                    ->label('')
                                                    ->listWithLineBreaks()
                                                    ->bulleted()
                                                    ->state(function (Classroom $record): array {
                                                        return $record->classroomUsers()
                                                            ->studentOnly()
                                                            ->join('users', 'classroom_users.user_id', '=', 'users.id')
                                                            ->orderBy('users.name')
                                                            ->pluck('users.name')
                                                            ->toArray();
                                                    }),
                                            ]),
                                    ]),
                            ]),

                        Tabs\Tab::make('Students Performance')
                            ->icon('heroicon-m-academic-cap')
                            ->schema([
                                Livewire::make(ClassroomStudentStats::class,
                                fn ($record) => ['classroomId' => $record->id])
                                ->lazy(),

                            ]),

                        Tabs\Tab::make('Points Plus')
                            ->icon('heroicon-m-star')
                            ->schema([
                                Grid::make(1)
                                    ->schema([
                                        Section::make('Points Overview')
                                            ->icon('heroicon-o-star')
                                            ->schema([
                                                TextEntry::make('total_points')
                                                    ->label('Total Points Earned from Students in this Class')
                                                    ->icon('heroicon-m-star')
                                                    ->color(Color::Fuchsia)
                                                    ->size(TextEntry\TextEntrySize::Large)
                                                    ->state(fn (Classroom $record): int =>
                                                        $record->classroomUsers()
                                                            ->join('users', 'classroom_users.user_id', '=', 'users.id')
                                                            ->join('points', 'users.id', '=', 'points.user_id')
                                                            ->sum('points.points') ?? 0
                                                    ),
                                            ]),

                                        Section::make('Points History')

                                            ->collapsible()
                                            ->schema([
                                                Livewire::make(PointsHistory::class, fn ($record) => ['classroomId' => $record->id])->lazy(),
                                            ]),
                                    ]),
                            ]),

                        Tabs\Tab::make('Activity Log')
                            ->icon('heroicon-m-clock')
                            ->schema([
                                Section::make()
                                    ->schema([
                                        TextEntry::make('created_at')
                                            ->label('Created At')
                                            ->dateTime()
                                            ->icon('heroicon-m-calendar'),
                                        TextEntry::make('updated_at')
                                            ->label('Last Updated')
                                            ->since()
                                            ->icon('heroicon-m-clock'),
                                    ]),
                            ]),

                        Tabs\Tab::make('Courses Management')
                            ->icon('heroicon-m-book-open')
                            ->schema([
                                Grid::make()
                                    ->schema([
                                        Section::make('Add Course to Classroom')
                                            ->icon('heroicon-o-plus-circle')
                                            ->description('Assign an existing course to this classroom')
                                            ->schema([
                                                Livewire::make(ManageClassroomCourse::class,
                                                fn ($record) => ['classroomId' => $record->id])
                                                ->lazy(),
                                            ]),


                                    ]),
                            ]),
                    ])->columnSpanFull(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListClassroomDetails::route('/'),
            // 'create' => Pages\CreateClassroomDetail::route('/create'),
            'view' => Pages\ViewClassroomDetail::route('/{record}'),
            // 'edit' => Pages\EditClassroomDetail::route('/{record}/edit'),
        ];
    }
}
