<?php

namespace App\Filament\Teacher\Resources;

use App\Filament\Teacher\Resources\ProjectSubmissionResource\Pages;
use App\Filament\Teacher\Resources\ProjectSubmissionResource\RelationManagers;
use App\Models\ProjectSubmission;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class ProjectSubmissionResource extends Resource
{
    protected static ?string $model = ProjectSubmission::class;

    protected static ?int $navigationSort = 2;

    protected static ?string $navigationGroup = 'Grading';
    protected ?string $heading = 'Project Scoring';

    protected static ?string $navigationLabel = 'Project Scoring';
    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-check';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('user_id')
                    ->required()
                    ->maxLength(36),
                Forms\Components\TextInput::make('project_id')
                    ->required()
                    ->maxLength(26),
                Forms\Components\TextInput::make('submission_link')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('submission_notes')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('submission_score')
                    ->numeric()
                    ->default(null),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->groups([
                'project.course.classrooms.class_name',
            ])
            ->modifyQueryUsing(function ($query) {
                return $query->whereHas('project.course.classrooms.classroomUsers', function ($subQuery) {
                    $subQuery->where('user_id', auth()->id());
                });
            })
            ->columns([
                Tables\Columns\TextColumn::make('user')
                    ->label('User')
                    ->formatStateUsing(function ($record) {
                        // Mengambil user name
                        $userName = $record->user->name;

                        // Mengambil class_name dari kelas pertama jika ada
                        $className = $record->user->classrooms->first()->class_name ?? 'N/A'; // Ganti 'N/A' jika tidak ada kelas

                        return $userName . '<br><small>' . $className . '</small>';
                    })
                    ->html() // Ini untuk mengizinkan penggunaan HTML di kolom
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('project.project_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('project.project_name')
                    ->label('Project')
                    ->formatStateUsing(function ($record) {
                        return $record->project->project_name . '<br><small>' . $record->project->course->course_name . '</small>';
                    })
                    ->html() // Ini untuk mengizinkan penggunaan HTML di kolom
                    ->searchable()
                    ->sortable(),
                Tables\Columns\IconColumn::make('submission_link')
                    ->icon('heroicon-o-link') // Menggunakan ikon eksternal link dari Heroicons
                    ->url(fn($record) => $record->submission_link) // Mengarahkan ke URL yang diambil dari field `link`
                    ->openUrlInNewTab()
                    ->tooltip('Open link in new tab') // Tambahkan tooltip jika diperlukan
                    ->color('primary')
                    ->label('Link'), // Kosongkan label jika tidak ingin menampilkan teks

                Tables\Columns\TextColumn::make('submission_score')
                    ->numeric()
                    ->sortable()
                    ->alignCenter()
                    ->placeholder('Not Graded')
                    ->color(fn($state): string => match (true) {
                        $state === null => 'gray',
                        $state >= 85 => 'success',
                        $state >= 70 => 'info',
                        $state >= 50 => 'warning',
                        default => 'danger',
                    }),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Submitted At')
                    ->dateTime()
                    ->sortable()
                    ->tooltip(fn($record) => $record->created_at ? $record->created_at->format('d M Y H:i') : '-')
                    ->since(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                // Class Filter
                SelectFilter::make('class_name')
                    ->relationship('project.course.classrooms', 'class_name')
                    ->searchable()
                    ->multiple()
                    ->preload()
                    ->label('Filter by Class'),

                // Date Range Filter
                Tables\Filters\Filter::make('created_at')
                    ->form([
                        Forms\Components\DatePicker::make('created_at')
                            ->label('Submitted Date')
                            ->placeholder('Select date'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                !empty($data['created_at']),
                                fn(Builder $query): Builder => $query->whereDate('created_at', $data['created_at'])
                            );
                    })
                    ->indicateUsing(function (array $data): ?string {
                        if (!empty($data['created_at'])) {
                            return 'Submitted on ' . $data['created_at'];
                        }
                        return null;
                    }),

                // Grading Status Filter
                Tables\Filters\SelectFilter::make('submission_score')
                    ->options([
                        'null' => 'Not Graded',
                        'not_null' => 'Graded',
                    ])
                    ->label('Grading Status')
                    ->placeholder('Select status'),

                // Course Filter
                Tables\Filters\SelectFilter::make('course')
                    ->relationship('project.course', 'course_name')
                    ->preload()
                    ->searchable()
                    ->multiple()
                    ->label('Course')
                    ->placeholder('Select courses'),

                // Project Filter
                Tables\Filters\SelectFilter::make('project')
                    ->relationship('project', 'project_name')
                    ->preload()
                    ->multiple()
                    ->searchable()
                    ->label('Project')
                    ->placeholder('Select projects'),
            ])
            ->filtersFormColumns(3)
            ->actions([
                Action::make('addGrade')
                    ->label('Add Grade')
                    ->icon('heroicon-o-academic-cap')
                    ->color('success')
                    ->modalHeading('Add Student Grade')
                    ->modalDescription('Enter the grade and notes for this assignment.')
                    ->modalIcon('heroicon-o-academic-cap')
                    ->form([
                        TextInput::make('submission_score')
                            ->required()
                            ->numeric(),
                        Forms\Components\Textarea::make('submission_notes')
                            ->label('Notes')
                            ->required(), // Menandakan bahwa field ini wajib diisi
                    ])
                    ->action(function ($record, $data) {
                        $record->update([
                            'submission_score' => $data['submission_score'],
                            'submission_notes' => $data['submission_notes'],
                        ]);
                    })
                    ->visible(fn($record) => is_null($record->submission_score)),
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
            'index' => Pages\ListProjectSubmissions::route('/'),
            // 'create' => Pages\CreateProjectSubmission::route('/create'),
            // 'edit' => Pages\EditProjectSubmission::route('/{record}/edit'),
        ];
    }
}
