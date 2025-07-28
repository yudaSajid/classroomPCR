<?php

namespace App\Filament\Student\Resources;

use App\Filament\Student\Resources\CourseDetailResource\Pages;
use App\Livewire\Courses\Grade;
use App\Livewire\Courses\Information;
use App\Livewire\Courses\Leaderboard; // ALIASKAN NAMA INI
use App\Livewire\Courses\LearnLayout;
use App\Livewire\Courses\Point;
use App\Livewire\Courses\Review;
use App\Livewire\Forum\Index;
use App\Livewire\Projects\ListProject;
use App\Models\Course;
use Filament\Forms\Form;
use Filament\Infolists\Components\Group;
use Filament\Infolists\Components\Livewire;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\Tabs;
use Filament\Infolists\Components\View;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class CourseDetailResource extends Resource
{
    protected static ?string $model = Course::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static bool $shouldRegisterNavigation = false;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Tabs::make('Tabs')
                    ->tabs([
                        Tabs\Tab::make('Overview')
                            ->icon('heroicon-m-briefcase')
                            ->schema([
                                Section::make([
                                    Group::make()->schema([
                                        View::make('infolists.components.detail-test'),
                                    ])->columnSpan(3),

                                    Group::make()->schema([
                                        Livewire::make(Information::class, fn ($record) => ['courseID' => $record->id])->lazy(),
                                        Livewire::make(Point::class, fn ($record) => ['courseID' => $record->id])->lazy(),
                                        Livewire::make(Grade::class, fn ($record) => ['courseID' => $record->id])->lazy(),
                                    ])->columns(1),
                                ])->columns(4)->columnSpanFull(),
                            ]),
                        Tabs\Tab::make('Material')
                            ->icon('heroicon-m-book-open')
                            ->schema([
                                Livewire::make(LearnLayout::class, fn ($record) => ['courseID' => $record->id])->lazy(),
                            ]),
                        Tabs\Tab::make('Forum')
                            ->icon('heroicon-m-chat-bubble-left-right')
                            ->schema([
                                Livewire::make(Index::class, fn ($record) => ['courseID' => $record->id])->lazy(),
                            ]),
                        Tabs\Tab::make('Leaderboard')
                            ->icon('heroicon-m-trophy')
                            ->schema([
                                Livewire::make(Leaderboard::class, fn ($record) => ['courseID' => $record->id])->lazy(),
                            ]),
                        Tabs\Tab::make('Review')
                            ->icon('heroicon-m-sparkles')
                            ->schema([
                                Livewire::make(Review::class, fn ($record) => ['courseID' => $record->id])->lazy(),
                            ]),
                        Tabs\Tab::make('Project')
                            ->icon('heroicon-m-puzzle-piece')
                            ->schema([
                                Livewire::make(ListProject::class, fn ($record) => ['courseID' => $record->id])->lazy(),
                            ]),
                        
                    ])->columnSpanFull(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCourseDetails::route('/'),
            'create' => Pages\CreateCourseDetail::route('/create'),
            'view' => Pages\ViewCourseDetail::route('/{record}'),
            'edit' => Pages\EditCourseDetail::route('/{record}/edit'),
        ];
    }
}