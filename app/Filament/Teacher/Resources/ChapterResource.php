<?php

namespace App\Filament\Teacher\Resources;

use App\Filament\Teacher\Resources\ChapterResource\Pages;
use App\Filament\Teacher\Resources\ChapterResource\RelationManagers;
use App\Filament\Teacher\Resources\ChapterResource\RelationManagers\AssignmentsRelationManager;
use App\Filament\Teacher\Resources\ChapterResource\RelationManagers\MaterialsRelationManager;
use App\Filament\Teacher\Resources\ChapterResource\RelationManagers\QuizzesRelationManager;
use App\Models\Chapter;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class ChapterResource extends Resource
{
    protected static ?string $model = Chapter::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static bool $shouldRegisterNavigation = false;
    public static function form(Form $form): Form
    {
        $courseId = request()->query('course_id');

        return $form
        ->schema([
            Section::make()->schema([
                Forms\Components\Select::make('course_id')
                    ->required()
                    ->relationship('course', 'course_name')
                    ->searchable()
                    ->default($courseId)
                    ->disabled(filled($courseId))
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
                    ->searchable()
                    ->sortable()
                    ->label('Course'),
                Tables\Columns\TextColumn::make('chapter_number')
                    ->numeric()
                    ->sortable()
                    ->badge()
                    ->color('success'),
                Tables\Columns\TextColumn::make('titles')
                    ->searchable()
                    ->wrap()
                    ->description(fn (Chapter $record): string => Str::limit(strip_tags($record->description), 100)),
                Tables\Columns\TextColumn::make('materials_count')
                    ->counts('materials')
                    ->label('Materials')
                    ->alignCenter()
                    ->badge()
                    ->color('info'),
                Tables\Columns\TextColumn::make('assignments_count')
                    ->counts('assignments')
                    ->label('Assignments')
                    ->alignCenter()
                    ->badge()
                    ->color('warning'),
                Tables\Columns\TextColumn::make('quizzes_count')
                    ->counts('quizzes')
                    ->label('Quizzes')
                    ->alignCenter()
                    ->badge()
                    ->color('danger'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->modifyQueryUsing(function (Builder $query) {
                if (request()->has('course_id')) {
                    $query->where('course_id', request()->query('course_id'));
                }
            })
            ->filters([
                Tables\Filters\TrashedFilter::make(),
                Tables\Filters\SelectFilter::make('course_id')
                    ->relationship('course', 'course_name')
                    ->searchable()
                    ->preload()
                    ->label('Course'),
                Tables\Filters\Filter::make('has_materials')
                    ->query(fn (Builder $query): Builder => $query->has('materials'))
                    ->label('Has Materials')
                    ->toggle(),
                Tables\Filters\Filter::make('has_assignments')
                    ->query(fn (Builder $query): Builder => $query->has('assignments'))
                    ->label('Has Assignments')
                    ->toggle(),
                Tables\Filters\Filter::make('has_quizzes')
                    ->query(fn (Builder $query): Builder => $query->has('quizzes'))
                    ->label('Has Quizzes')
                    ->toggle(),
            ])
            ->filtersFormColumns(3)
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
            ])
            ->defaultSort('chapter_number', 'asc');
    }

    public static function getRelations(): array
    {
        return [
            MaterialsRelationManager::class,
            AssignmentsRelationManager::class,
            QuizzesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListChapters::route('/'),
            'create' => Pages\CreateChapter::route('/create'),
            'view' => Pages\ViewChapter::route('/{record}'),
            'edit' => Pages\EditChapter::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
