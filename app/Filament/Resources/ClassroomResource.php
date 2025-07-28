<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ClassroomResource\Pages;
use App\Filament\Resources\ClassroomResource\RelationManagers\TeachersRelationManager;
use App\Filament\Resources\ClassroomResource\RelationManagers\UsersRelationManager;
use App\Models\Classroom;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Split;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ClassroomResource extends Resource
{
    protected static ?string $model = Classroom::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    protected static ?string $activeNavigationIcon = 'heroicon-s-academic-cap';

    protected static ?string $navigationLabel = 'Classrooms';

    protected static ?string $pluralLabel = 'Classrooms';

    protected static ?string $navigationGroup = 'Classroom Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Split::make([
                    Section::make()->schema([
                        Forms\Components\TextInput::make('class_name')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Ex: 20 TI A')
                            ->rules([
                                'required',
                                'regex:/^[0-9]{2} [A-Z]{2,3} [A-Z]$/',
                            ])
                            ->helperText('Format harus seperti "20 TI A", dimana "20" adalah tahun, "TI" adalah kode program, dan "A" adalah kode kelas.'),

                        Forms\Components\RichEditor::make('class_description')
                            ->required(),
                    ]),
                    Group::make()->schema([

                        Section::make('Education Information')->schema([
                            Forms\Components\Select::make('enrollment_year')
                                ->label('Year')
                                ->options(function () {
                                    $currentYear = date('Y');

                                    return collect(range($currentYear - 10, $currentYear))
                                        ->mapWithKeys(fn ($year) => [$year => $year])
                                        ->toArray();
                                })
                                ->required()
                                ->placeholder('Select year'),
                            Forms\Components\Select::make('class_alphabet')
                                ->required()
                                ->options([
                                    'A' => 'A',
                                    'B' => 'B',
                                    'C' => 'C',
                                    'D' => 'D',
                                    'E' => 'E',
                                    'F' => 'F',
                                    'G' => 'G',
                                    'S' => 'S',
                                ]),
                            Forms\Components\Select::make('program_id')
                                ->relationship('program', 'program_name')
                                ->required(),
                        ]),
                        Section::make('Course List')->schema([
                            Forms\Components\Select::make('courses')
                                ->relationship('courses', 'course_name')
                                ->multiple()
                                ->searchable(),
                        ]),
                    ]),
                ])->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->groups([
                'program.program_name',
                'enrollment_year',
            ])
            ->defaultGroup('program.program_name')
            ->columns([
                Tables\Columns\TextColumn::make('program.program_name')
                    ->badge()
                    ->sortable(),
                Tables\Columns\TextColumn::make('class_code')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('class_name')
                    ->searchable()
                    ->sortable()
                    ->description(fn (Classroom $record): string => $record->enrollment_year),
                TextColumn::make('courses.course_name')
                    ->badge()
                    ->separator(',')
                    ->searchable(),
                // TextColumn::make('users_count')
                //     ->counts('users')
                //     ->label('Students')
                //     ->alignCenter(),
                ImageColumn::make('users.avatar')
                    ->circular()
                    ->stacked()
                    ->limit(3)
                    ->label('Students')
                    ->limitedRemainingText(),
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
                SelectFilter::make('program_id')
                    ->relationship('program', 'program_name')
                    ->searchable(),
                Filter::make('created_at')
                    ->form([
                        DatePicker::make('created_from'),
                        DatePicker::make('created_until'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['created_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    }),
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
            UsersRelationManager::class,
            TeachersRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListClassrooms::route('/'),
            'create' => Pages\CreateClassroom::route('/create'),
            'edit' => Pages\EditClassroom::route('/{record}/edit'),
        ];
    }
}
