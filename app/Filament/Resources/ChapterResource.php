<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ChapterResource\Pages;
use App\Filament\Resources\ChapterResource\RelationManagers\AssignmentsRelationManager;
use App\Filament\Resources\ChapterResource\RelationManagers\MaterialsRelationManager;
use App\Models\Chapter;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class ChapterResource extends Resource
{
    protected static ?string $model = Chapter::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';

    protected static ?string $navigationGroup = 'Course Management';

    protected static ?string $navigationParentItem = 'Courses';

    public static function form(Form $form): Form
    {

        return $form
            ->schema([
                Section::make()->schema([
                    Forms\Components\Select::make('course_id')
                        ->required()
                        ->relationship('course', 'course_name')
                        ->live(),
                    Forms\Components\Select::make('chapter_number')
                        ->required()
                        ->options(function (Forms\Get $get, ?Chapter $record) {
                            $courseId = $get('course_id');

                            if ($courseId) {
                                // Get all existing chapter numbers for the selected course
                                $existingChapters = Chapter::query()
                                    ->where('course_id', $courseId)
                                    ->pluck('chapter_number')
                                    ->toArray();

                                // Create options for the available chapter numbers
                                $allOrderNumbers = range(1, 20);
                                $options = [];

                                foreach ($allOrderNumbers as $number) {
                                    if (in_array($number, $existingChapters) && (! $record || $number != $record->chapter_number)) {
                                        $options[$number] = "$number ✔ Choose another";
                                    } else {
                                        $options[$number] = "$number";
                                    }
                                }

                                // Add the current chapter number if in edit mode
                                if ($record) {
                                    $options[$record->chapter_number] = $record->chapter_number;
                                }

                                return $options;
                            }

                            // Default options if no course is selected
                            $allOrderNumbers = range(1, 20);
                            $options = array_combine($allOrderNumbers, $allOrderNumbers);

                            return $options;
                        }),

                    Forms\Components\TextInput::make('titles')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\RichEditor::make('description')
                        ->required()
                        ->maxLength(255)->columnSpan(3),
                ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->groups([
                'course.course_name',
            ])
            ->defaultGroup('course.course_name')
            ->columns([
                Tables\Columns\TextColumn::make('course.course_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('chapter_number')
                    ->numeric()
                    ->sortable()
                    ->badge(),
                Tables\Columns\TextColumn::make('titles')
                    ->searchable()
                    ->description(fn (Chapter $record): string => Str::limit(strip_tags($record->description), 100)),
                TextColumn::make('assignments_count')
                    ->counts('assignments')
                    ->label('Assignments')
                    ->alignCenter(),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
                SelectFilter::make('course')
                    ->relationship('course', 'course_name')
                    ->searchable()
                    ->preload(),
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
            MaterialsRelationManager::class,
            AssignmentsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListChapters::route('/'),
            'create' => Pages\CreateChapter::route('/create'),
            'edit' => Pages\EditChapter::route('/{record}/edit'),
        ];
    }
}
