<?php

namespace App\Filament\Clusters\Grades\Resources;

use App\Enums\Status;
use App\Filament\Clusters\Grades;
use App\Models\UserAssignmentStatus;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use App\Filament\Clusters\Grades\Resources\UserAssignmentStatusResource\Pages;


class UserAssignmentStatusResource extends Resource
{
    protected static ?string $model = UserAssignmentStatus::class;

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationGroup = 'Grading';

    public static function canCreate(): bool
    {
        return false;
    }

    protected static ?string $cluster = Grades::class;

    protected static ?string $navigationLabel = 'Assignment';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('assignment_id')
                    ->required()
                    ->maxLength(36),
                Forms\Components\TextInput::make('user_id')
                    ->required()
                    ->maxLength(36),
                Forms\Components\TextInput::make('status')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\Textarea::make('notes')
                    ->columnSpanFull(),
                Forms\Components\Toggle::make('is_completed')
                    ->required(),
                Forms\Components\TextInput::make('score')
                    ->numeric()
                    ->default(null),
                Forms\Components\TextInput::make('link')
                    ->maxLength(255)
                    ->default(null),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->groups([
                'assignment.chapter.course.classrooms.class_name',
            ])
            ->columns([
                Tables\Columns\TextColumn::make('assignment.title')
                    ->label('Assignment')
                    ->formatStateUsing(function ($record) {
                        return $record->assignment->title.'<br><small>'.$record->assignment->chapter->course->course_name.'</small>';
                    })
                    ->html() // Ini untuk mengizinkan penggunaan HTML di kolom
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('user.name')
                    ->label('Student')
                    ->searchable(),

                Tables\Columns\TextColumn::make('status')
                    ->formatStateUsing(function ($state) {
                        return Status::toSelectArray()[$state] ?? $state;
                    })
                    ->badge()
                    ->colors([
                        'warning' => Status::Pending,   // Menggunakan enum sebagai kunci warna
                        'info' => Status::Approved,      // Menggunakan enum sebagai kunci warna
                        'danger' => Status::Reject,      // Menggunakan enum sebagai kunci warna
                    ])
                    ->searchable(),
                Tables\Columns\TextColumn::make('score')
                    ->numeric()
                    ->sortable()
                    ->formatStateUsing(fn ($state) => $state ? number_format($state, 1) : '-')
                    ->badge()
                    ->color(fn ($state) => match (true) {
                        $state >= 85 => 'success',
                        $state >= 70 => 'warning',
                        $state !== null => 'danger',
                        default => 'gray',
                    })
                    ->alignCenter(),
                Tables\Columns\IconColumn::make('link')
                    ->icon('heroicon-o-link') // Menggunakan ikon eksternal link dari Heroicons
                    ->url(fn ($record) => $record->link) // Mengarahkan ke URL yang diambil dari field `link`
                    ->openUrlInNewTab()
                    ->tooltip('Open link in new tab') // Tambahkan tooltip jika diperlukan
                    ->color('primary')
                    ->label('Link'), // Kosongkan label jika tidak ingin menampilkan teks
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
                SelectFilter::make('course_name')
                    ->relationship('assignment.chapter.course', 'course_name') // Menghubungkan dengan relasi
                    ->searchable() // Membuat filter dapat dicari
                    ->multiple()
                    ->preload(), // Memuat data sebelum pengguna memilih
                SelectFilter::make('class_name')
                    ->relationship('assignment.chapter.course.classrooms', 'class_name') // Menghubungkan dengan relasi
                    ->searchable() // Membuat filter dapat dicari
                    ->multiple()
                    ->preload(), // Memuat data sebelum pengguna memilih
            ])
            ->actions([
                Action::make('addGrade')
                    ->label('Add Grade')
                    ->icon('heroicon-o-academic-cap')
                    ->color('success')
                    ->modalHeading('Add Student Grade')
                    ->modalDescription('Enter the grade and notes for this assignment.')
                    ->modalIcon('heroicon-o-academic-cap')
                    ->form([
                        TextInput::make('score')
                            ->required()
                            ->numeric(),
                        Forms\Components\Textarea::make('notes')
                            ->label('Notes')
                            ->required(), // Menandakan bahwa field ini wajib diisi
                    ])
                    ->action(function ($record, $data) {
                        $record->update([
                            'score' => $data['score'],
                            'notes' => $data['notes'],
                            'status' => 'approved', // Set status menjadi "Approved"
                        ]);
                    })
                    ->visible(fn ($record) => $record->status === 'pending'),
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
            'index' => Pages\ListUserAssignmentStatuses::route('/'),
            'create' => Pages\CreateUserAssignmentStatus::route('/create'),
            'edit' => Pages\EditUserAssignmentStatus::route('/{record}/edit'),
            
        ];
    }
}
