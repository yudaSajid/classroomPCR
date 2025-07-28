<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserEducationResource\Pages;
use App\Models\Program;
use App\Models\Semester;
use App\Models\UserEducation;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class UserEducationResource extends Resource
{
    protected static ?string $model = UserEducation::class;

    protected static ?string $navigationIcon = 'heroicon-o-identification';

    protected static ?string $navigationGroup = 'User Management';

    protected static ?string $navigationParentItem = 'Users';

    public static function form(Form $form): Form
    {
        return $form

            ->schema([
                Section::make()->schema([
                    Group::make()->schema([
                        Forms\Components\Select::make('user_id')
                            ->required()
                            ->relationship('user', 'name'),
                        Forms\Components\TextInput::make('student_id_number')
                            ->required()
                            ->numeric()
                            ->maxLength(255),
                    ])->columns(2),
                    Fieldset::make('Academic Class')->schema([
                        Forms\Components\Select::make('department_id')
                            ->required()
                            ->relationship('department', 'department_name')
                            ->reactive()
                            ->afterStateUpdated(fn (callable $set) => $set('program_id', null)),
                        Forms\Components\Select::make('program_id')
                            ->label('Program')
                            ->options(function (callable $get) {
                                $departmentId = $get('department_id');
                                if (! $departmentId) {
                                    return Program::all()->pluck('program_name', 'id');
                                }

                                return Program::where('department_id', $departmentId)->pluck('program_name', 'id');
                            })
                            ->required(),

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
                            ]),
                    ])->columns(3),

                    Fieldset::make('Batch')->schema([
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
                        Forms\Components\Select::make('semester_id')
                            ->searchable()
                            ->preload()
                            ->options(function () {
                                return Semester::with('period')->get()->mapWithKeys(function ($semester) {
                                    return [$semester->id => $semester->period_and_semester_name];
                                });
                            })
                            ->required()
                            ->optionsLimit(10),
                    ])->columns(2),
                ]),

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
                Tables\Columns\TextColumn::make('user.name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('student_id_number')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('department.department_name')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('program.program_name')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('activeBatchSemester.period_and_semester_name')
                    ->sortable()
                    ->searchable()
                    ->label('Semester'),
                Tables\Columns\TextColumn::make('enrollment_year')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('class_alphabet')
                    ->searchable(),
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUserEducation::route('/'),
            'create' => Pages\CreateUserEducation::route('/create'),
            'edit' => Pages\EditUserEducation::route('/{record}/edit'),
        ];
    }
}
