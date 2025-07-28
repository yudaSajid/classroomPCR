<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ClassroomCourseResource\Pages;
use App\Models\ClassroomCourse;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;

class ClassroomCourseResource extends Resource
{
    protected static ?string $model = ClassroomCourse::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Classroom Management';

    protected static ?string $navigationParentItem = 'Classrooms';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()->schema([

                    Forms\Components\Select::make('classroom_id')
                        ->relationship('classroom', 'class_name')
                        ->required()
                        ->searchable(),
                    Forms\Components\Select::make('course_id')
                        ->relationship('course', 'course_name')
                        ->required()
                        ->searchable(),
                ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('classroom.class_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('course.course_name')
                    ->searchable(),
                ToggleColumn::make('is_active')
                    ->onColor('success')
                    ->offColor('danger')
                    ->onIcon('heroicon-m-bolt')
                    ->offIcon('heroicon-m-bolt-slash'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListClassroomCourses::route('/'),
            'create' => Pages\CreateClassroomCourse::route('/create'),
            'edit' => Pages\EditClassroomCourse::route('/{record}/edit'),
        ];
    }
}
