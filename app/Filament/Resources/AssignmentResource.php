<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AssignmentResource\Pages;
use App\Models\Assignment;
use App\Models\Chapter;
use Filament\Forms;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class AssignmentResource extends Resource
{
    protected static ?string $model = Assignment::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';

    protected static ?string $navigationGroup = 'Course Management';

    protected static ?string $navigationParentItem = 'Courses';

    protected static ?string $navigationLabel = 'Assignment';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()->schema([
                    Forms\Components\TextInput::make('title')
                        ->required()
                        ->maxLength(255),
                    Fieldset::make('Please be careful!')->schema([
                        Forms\Components\TextInput::make('deadline')
                            ->numeric()
                            ->default(null)
                            ->suffix('days')
                            ->helperText('After students open the assignment'),
                        Forms\Components\Select::make('chapter_id')
                            ->required()
                            ->relationship('chapter', 'titles')
                            ->options(function () {
                                return Chapter::with('course')->get()->mapWithKeys(function ($chapter) {
                                    return [$chapter->id => $chapter->title_with_course];
                                });
                            }),
                        // ->default(fn (?Assignment $record) => request()->query('chapter_id')),
                    ]),

                    Forms\Components\RichEditor::make('description')
                        ->required()
                        ->columnSpanFull(),
                ]),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->groups([
                'chapter.titles',
                'deadline',
            ])
            ->columns([
                Tables\Columns\TextColumn::make('chapter.titles')
                    ->searchable(),
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('deadline')
                    ->numeric()
                    ->sortable()
                    ->badge()
                    ->suffix(' days'),
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
                SelectFilter::make('chapter')
                    ->relationship('chapter', 'titles')
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAssignments::route('/'),
            'create' => Pages\CreateAssignment::route('/create'),
            'edit' => Pages\EditAssignment::route('/{record}/edit'),
        ];
    }
}
