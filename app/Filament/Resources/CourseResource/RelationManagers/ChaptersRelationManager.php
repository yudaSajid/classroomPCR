<?php

namespace App\Filament\Resources\CourseResource\RelationManagers;

use App\Filament\Resources\AssignmentResource;
use App\Models\Chapter;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Facades\DB;

class ChaptersRelationManager extends RelationManager
{
    protected static string $relationship = 'chapters';

    public function form(Form $form): Form
    {
        $courseId = $this->ownerRecord->id;
        // Dapatkan nomor yang sudah ada di database
        $existingOrderNumbers = DB::table('chapters')->pluck('chapter_number')->toArray();

        // Buat rentang angka dari 1 hingga 20
        $allOrderNumbers = range(1, 20);

        // Filter angka yang belum ada di database dan buat array untuk pilihan
        $options = [];
        foreach ($allOrderNumbers as $number) {
            if (in_array($number, $existingOrderNumbers)) {
                $options[$number] = "$number ✔ Choose another"; // Menambahkan tanda checklist
            } else {
                $options[$number] = "$number";
            }
        }

        return $form
            ->schema([
                Section::make()->schema([
                    Forms\Components\Select::make('course_id')
                        ->required()
                        ->relationship('course', 'course_name')
                        ->default($courseId)
                        ->live(),
                    Forms\Components\Select::make('chapter_number')
                        ->required()
                        ->options(function (Forms\Get $get) use ($options) {
                            $courseId = $get('course_id');

                            if ($courseId) {
                                // Get all existing chapter numbers for the selected course
                                $existingChapters = Chapter::query()
                                    ->where('course_id', $courseId)
                                    ->pluck('chapter_number')
                                    ->toArray();

                                // Filter out existing chapters from all possibilities
                                $availableChapters = array_diff(array_keys($options), $existingChapters);

                                // Create options for the available chapter numbers
                                $filteredOptions = [];
                                foreach ($availableChapters as $chapterNumber) {
                                    if (in_array($chapterNumber, $existingChapters)) {
                                        $filteredOptions[$chapterNumber] = "$chapterNumber ✔ Choose another";
                                    } else {
                                        $filteredOptions[$chapterNumber] = "$chapterNumber";
                                    }
                                }

                                return $filteredOptions;
                            }

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

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('titles')
            ->columns([
                Tables\Columns\TextColumn::make('chapter_number')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('titles')
                    ->searchable(),
                Tables\Columns\TextColumn::make('assignments_count')
                    ->counts('assignments')
                    ->label('Assignments')
                    ->alignCenter()
                    ->url(fn ($record) => $record->assignments->isNotEmpty() ? route('filament.admin.resources.assignments.edit', ['record' => $record->assignments->first()->id]) : null)
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\Action::make('addAssignment')
                    ->label('Assignment')
                    // ->url(fn ($record) => AssignmentResource::getUrl('create', ['chapter_id' => $record->id]))
                    ->url(fn (Chapter $record): string => route('filament.admin.resources.chapters.edit', ['record' => $record]))
                    ->openUrlInNewTab()
                    ->icon('heroicon-o-plus'),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
