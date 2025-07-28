<?php

namespace App\Filament\Clusters\Grades\Resources;

use App\Filament\Clusters\Grades;
use App\Filament\Clusters\Grades\Resources\ProjectSubmissionResource\Pages;
use App\Models\ProjectSubmission;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class ProjectSubmissionResource extends Resource
{
    protected static ?string $model = ProjectSubmission::class;

    protected static ?int $navigationSort = 2;

    protected static ?string $navigationGroup = 'Grading';

    protected static ?string $cluster = Grades::class;

    protected static ?string $navigationLabel = 'Project';

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
            ->columns([
                Tables\Columns\TextColumn::make('user')
                    ->label('User')
                    ->formatStateUsing(function ($record) {
                        // Mengambil user name
                        $userName = $record->user->name;

                        // Mengambil class_name dari kelas pertama jika ada
                        $className = $record->user->classrooms->first()->class_name ?? 'N/A'; // Ganti 'N/A' jika tidak ada kelas

                        return $userName.'<br><small>'.$className.'</small>';
                    })
                    ->html() // Ini untuk mengizinkan penggunaan HTML di kolom
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('project.project_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('project.project_name')
                    ->label('Project')
                    ->formatStateUsing(function ($record) {
                        return $record->project->project_name.'<br><small>'.$record->project->course->course_name.'</small>';
                    })
                    ->html() // Ini untuk mengizinkan penggunaan HTML di kolom
                    ->searchable()
                    ->sortable(),
                Tables\Columns\IconColumn::make('submission_link')
                    ->icon('heroicon-o-link') // Menggunakan ikon eksternal link dari Heroicons
                    ->url(fn ($record) => $record->submission_link) // Mengarahkan ke URL yang diambil dari field `link`
                    ->openUrlInNewTab()
                    ->tooltip('Open link in new tab') // Tambahkan tooltip jika diperlukan
                    ->color('primary')
                    ->label('Link'), // Kosongkan label jika tidak ingin menampilkan teks
                Tables\Columns\TextColumn::make('submission_score')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
                SelectFilter::make('class_name')
                    ->relationship('project.course.classrooms', 'class_name') // Menghubungkan dengan relasi
                    ->searchable() // Membuat filter dapat dicari
                    ->multiple()
                    ->preload(), // Memuat data sebelum pengguna memilih
            ])
            ->actions([
                Action::make('addGrade')
                    ->label('Add Grade') // Label untuk aksi
                    ->icon('heroicon-o-pencil') // Gunakan ikon dari Heroicons
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
                    }),
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
