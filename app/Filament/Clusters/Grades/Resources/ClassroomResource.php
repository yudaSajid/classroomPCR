<?php

namespace App\Filament\Clusters\Grades\Resources;

use App\Filament\Clusters\Grades;
use App\Filament\Clusters\Grades\Resources\ClassroomResource\Pages;
use App\Filament\Resources\ClassroomResource\RelationManagers\UsersRelationManager;
use App\Livewire\Classrooms\ListAssignment;
use App\Models\Classroom;
use Filament\Forms;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Split;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Infolists\Components\Livewire;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ClassroomResource extends Resource
{
    protected static ?string $model = Classroom::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $cluster = Grades::class;

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
            ->modifyQueryUsing(function (Builder $query) {
                $userID = Auth::user()->id;
                $query->whereHas('classroomUsers', function ($query) use ($userID) {
                    $query->where('user_id', $userID);
                });
            })
            ->defaultGroup('program.program_name')
            ->columns([
                Tables\Columns\TextColumn::make('program.program_name')
                    ->badge()
                    ->sortable(),

                Tables\Columns\TextColumn::make('class_name')
                    ->searchable()
                    ->sortable()
                    ->description(fn (Classroom $record): string => $record->class_code),
                TextColumn::make('courses.course_name')
                    ->badge()
                    ->separator(',')
                    ->searchable(),

                // TextColumn::make('teacher_names')
                // ->label('Teachers')
                // ->getStateUsing(function (Model $record) {
                //     // Query untuk mendapatkan semua nama user dengan role 'teacher_user'
                //     $teachers = $record->users()->whereHas('roles', function ($query) {
                //         $query->where('name', 'teacher_user');
                //     })->get()->pluck('name')->toArray();

                //     // Menggabungkan semua nama user menjadi string, dipisahkan dengan koma
                //     return !empty($teachers) ? implode(', ', $teachers) : 'No Teachers';
                // }),
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

            ])
            ->actions([
                ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\Action::make('View Assignments')
                        ->infolist([
                            TextEntry::make('class_name'),
                            Livewire::make(ListAssignment::class, fn ($record) => ['classroomId' => $record->id])->lazy(),
                        ])->slideOver(),

                    //                 ViewAction::make()
                    // ->form([
                    //     TextInput::make('class_name')
                    //         ->required()
                    //         ->maxLength(255),
                    //     // ...
                    // ])
                ]),

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
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListClassrooms::route('/'),
            // 'create' => Pages\CreateClassroom::route('/create'),
            'edit' => Pages\EditClassroom::route('/{record}/edit'),
        ];
    }
}
