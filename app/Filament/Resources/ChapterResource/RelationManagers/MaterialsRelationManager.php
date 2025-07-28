<?php

namespace App\Filament\Resources\ChapterResource\RelationManagers;

use App\Models\Chapter;
use App\Models\Material;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;

class MaterialsRelationManager extends RelationManager
{
    protected static string $relationship = 'materials';

    public function form(Form $form): Form
    {
        $Id = $this->ownerRecord->id;

        return $form
            ->schema([
                Section::make([
                    Forms\Components\Hidden::make('chapter_id')
                        ->required()
                        ->default($Id),
                    Forms\Components\TextInput::make('material_name')
                        ->required()
                        ->maxLength(255),

                    Forms\Components\Select::make('order_number')
                        ->required()
                        ->options(function (Forms\Get $get, ?Material $record) {
                            $chapterId = $get('chapter_id');

                            if ($chapterId) {
                                // Get all existing material numbers for the selected chapter
                                $existingMaterials = Material::query()
                                    ->where('chapter_id', $chapterId)
                                    ->pluck('order_number')
                                    ->toArray();

                                // Create options for the available material numbers
                                $allOrderNumbers = range(1, 20);
                                $options = [];

                                foreach ($allOrderNumbers as $number) {
                                    if (in_array($number, $existingMaterials) && (! $record || $number != $record->order_number)) {
                                        $options[$number] = "$number ✔ Choose another";
                                    } else {
                                        $options[$number] = "$number";
                                    }
                                }

                                // Add the current material number if in edit mode
                                if ($record) {
                                    $options[$record->order_number] = $record->order_number;
                                }

                                return $options;
                            }

                            // Default options if no course is selected
                            $allOrderNumbers = range(1, 20);
                            $options = array_combine($allOrderNumbers, $allOrderNumbers);

                            return $options;
                        }),
                    Toggle::make('is_code')
                        ->label('Code Playground')
                        ->onIcon('heroicon-m-code-bracket')
                        ->offIcon('heroicon-m-eye-slash')
                        ->onColor('success')
                        ->offColor('danger'),
                ])->columnSpan(1),
                Section::make()->schema([
                    Forms\Components\Radio::make('material_type')
                        ->options([
                            'pdf' => 'Pdf',
                            'youtube' => 'Youtube',
                            'text' => 'Text',
                        ])
                        ->inline()
                        ->required()
                        ->reactive(),

                    Forms\Components\TextInput::make('duration')
                        ->label('Duration')
                        ->numeric()
                        ->required()
                        ->minValue(0)
                        ->suffix('minutes'),

                    FileUpload::make('pdf_link')
                        ->label('Upload PDF')
                        ->preserveFilenames()
                        ->acceptedFileTypes(['application/pdf'])
                        ->columnSpanFull()
                        ->visible(fn ($get) => $get('material_type') === 'pdf'),
                    TextInput::make('material_link')
                        ->maxLength(65535)
                        ->columnSpanFull()
                        ->url()
                        ->visible(fn ($get) => $get('material_type') !== 'pdf'),

                ])->columnSpan(1),
                Section::make('Text')->schema([
                    Forms\Components\RichEditor::make('material_text')
                        ->maxLength(65535)
                        ->columnSpanFull(),
                ]),
            ])->columns(2);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('material_name')
            ->columns([
                Tables\Columns\TextColumn::make('material_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('chapter.title_with_course')
                    ->searchable(),
                TextColumn::make('material_type')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'youtube' => 'danger',
                        'text' => 'info',
                        'pdf' => 'success',
                    }),
                TextColumn::make('duration')
                    ->badge(),
                ToggleColumn::make('is_code')
                    ->onIcon('heroicon-m-code-bracket')
                    ->offIcon('heroicon-m-eye-slash')
                    ->onColor('success')
                    ->offColor('danger'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
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
