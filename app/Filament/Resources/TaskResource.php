<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TaskResource\Pages;
use App\Models\Task;
use Filament\Forms;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class TaskResource extends Resource
{
    protected static ?string $model = Task::class;

    protected static ?string $navigationIcon = 'heroicon-o-code-bracket-square';

    protected static ?string $navigationGroup = 'Course Management';

    protected static ?string $navigationParentItem = 'Challenges';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()->schema([
                    Forms\Components\Select::make('challenge_id')
                        ->required()
                        ->relationship('challenge', 'challenge_name'),
                    Forms\Components\TextInput::make('task_name')
                        ->required(),
                    Forms\Components\FileUpload::make('task_photo')
                        ->image()
                        ->optimize('webp')
                        ->imageEditor()
                        ->directory('task')
                        ->imageEditorEmptyFillColor('#ffffff'),
                    RichEditor::make('task_description')
                        ->required()
                        ->columnSpanFull(),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->groups([
                'challenge.challenge_name',
            ])
            ->columns([
                Tables\Columns\ImageColumn::make('task_photo')
                    ->searchable()
                    ->circular(),
                Tables\Columns\TextColumn::make('challenge.challenge_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('task_name')
                    ->searchable()
                    ->description(fn (Task $record): string => Str::limit(strip_tags($record->task_description), 100)),
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
            'index' => Pages\ListTasks::route('/'),
            'create' => Pages\CreateTask::route('/create'),
            'edit' => Pages\EditTask::route('/{record}/edit'),
        ];
    }
}
