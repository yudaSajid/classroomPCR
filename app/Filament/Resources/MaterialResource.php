<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MaterialResource\Pages;
use App\Filament\Resources\MaterialResource\RelationManagers\UserMaterialStatusRelationManager;
use App\Models\Chapter;
use App\Models\Material;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;

class MaterialResource extends Resource
{
    protected static ?string $model = Material::class;

    protected static ?string $navigationGroup = 'Course Management';

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';

    protected static ?string $navigationParentItem = 'Courses';

    public static function form(Form $form): Form
    {

        return $form
            ->schema([
                Section::make([
                    Forms\Components\Select::make('chapter_id')
                        ->required()
                        ->searchable()
                        ->preload()
                        ->options(function () {
                            return Chapter::with('course')->get()->mapWithKeys(function ($chapter) {
                                return [$chapter->id => $chapter->title_with_course];
                            });
                        })
                        ->optionsLimit(10),
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

                ])->columnSpan(1),
                Section::make()->schema([
                    Forms\Components\Radio::make('material_type')
                        ->options([
                            'pdf' => 'Pdf',
                            'youtube' => 'Youtube',
                            'text' => 'Text',
                        ])
                        ->inline()
                        ->default('pdf')
                        ->required()
                        ->reactive(),
                    Forms\Components\TextInput::make('duration')
                        ->label('Duration')
                        ->numeric()
                        ->required()
                        ->minValue(0)
                        ->suffix('minutes'),
                    Toggle::make('is_code')
                        ->label('Code Playground')
                        ->onIcon('heroicon-m-code-bracket')
                        ->offIcon('heroicon-m-eye-slash')
                        ->onColor('success')
                        ->offColor('danger'),
                    FileUpload::make('pdf_link')
                        ->label('Upload PDF')
                        ->preserveFilenames()
                        ->downloadable()
                        ->acceptedFileTypes(['application/pdf'])
                        ->maxSize(20480) // 20MB in kilobytes
                        ->columnSpanFull()
                        ->visible(fn($get) => $get('material_type') === 'pdf'),
                    TextInput::make('material_link')
                        ->maxLength(65535)
                        ->columnSpanFull()
                        ->url()
                        ->visible(fn($get) => $get('material_type') !== 'pdf'),

                ])->columnSpan(1),
                Section::make('Text')->schema([
                    Forms\Components\RichEditor::make('material_text')
                        ->maxLength(65535)
                        ->columnSpanFull(),
                ]),
            ])->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->groups([
                'material_type',
                'chapter.titles',
            ])
            ->columns([
                Tables\Columns\TextColumn::make('chapter.title_with_course')
                    ->searchable(),
                Tables\Columns\TextColumn::make('material_name')
                    ->searchable()
                    ->description(fn(Material $record): string => 'Order : ' . $record->order_number)
                    ->sortable(),
                TextColumn::make('material_type')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
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
            UserMaterialStatusRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMaterials::route('/'),
            'create' => Pages\CreateMaterial::route('/create'),
            'edit' => Pages\EditMaterial::route('/{record}/edit'),
        ];
    }
}
