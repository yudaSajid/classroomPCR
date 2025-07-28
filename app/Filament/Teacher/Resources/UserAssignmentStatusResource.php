<?php

namespace App\Filament\Teacher\Resources;

use App\Enums\Status;
use App\Filament\Teacher\Resources\UserAssignmentStatusResource\Pages;
use App\Filament\Teacher\Resources\UserAssignmentStatusResource\RelationManagers;
use App\Models\UserAssignmentStatus;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Actions\Action;
use Filament\Forms\Components\TextInput;

class UserAssignmentStatusResource extends Resource
{
    protected static ?string $model = UserAssignmentStatus::class;
    protected static ?string $navigationLabel = 'Assignment Scoring';
    protected static ?string $navigationGroup = 'Grading';
    protected ?string $heading = 'Assignment Scoring';


    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-check';



    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(function ($query) {
                return $query->whereHas('assignment.chapter.course.classrooms.classroomUsers', function ($subQuery) {
                    $subQuery->where('user_id', auth()->id());
                });
            })
            ->columns([
                // Update the classroom column to use correct relationship path
                Tables\Columns\TextColumn::make('assignment.chapter.course.classrooms.class_name')
                    ->label('Class')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color('success')
                    ->description(
                        fn($record) =>
                        $record->assignment?->chapter?->course?->classrooms->first()?->enrollment_year ?? '-'
                    ),

                Tables\Columns\TextColumn::make('assignment.title')
                    ->label('Assignment')
                    ->searchable()
                    ->sortable()
                    ->tooltip(fn($record) => strip_tags(html_entity_decode($record->assignment?->description)))
                    ->description(fn($record) => "Due: " . ($record->assignment?->deadline ? \Carbon\Carbon::parse($record->assignment?->deadline)->format('d M Y') : null))
                    ->wrap(),

                Tables\Columns\TextColumn::make('assignment.chapter.course.course_name')
                    ->label('Course')
                    ->searchable()
                    ->sortable()
                    ->badge(),

                Tables\Columns\TextColumn::make('user.name')
                    ->label('Student')
                    ->searchable()
                    ->sortable()
                    ->description(fn($record) => $record->user?->email),

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

                Tables\Columns\IconColumn::make('is_completed')
                    ->label('Completed')
                    ->boolean()
                    ->alignCenter(),

                Tables\Columns\TextColumn::make('score')
                    ->numeric()
                    ->sortable()
                    ->alignCenter()
                    ->placeholder('Not Graded')
                    ->color(fn(string $state): string => match (true) {
                        $state >= 85 => 'success',
                        $state >= 70 => 'info',
                        $state >= 50 => 'warning',
                        default => 'danger',
                    }),

                Tables\Columns\IconColumn::make('link')
                    ->icon('heroicon-o-link') // Menggunakan ikon eksternal link dari Heroicons
                    ->url(fn($record) => $record->link) // Mengarahkan ke URL yang diambil dari field `link`
                    ->openUrlInNewTab()
                    ->tooltip('Open link in new tab') // Tambahkan tooltip jika diperlukan
                    ->color('primary')
                    ->label('Link'), // Kosongkan label jika tidak ingin menampilkan teks

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Submitted At')
                    ->dateTime()
                    ->sortable()
                    ->tooltip(fn($record) => $record->created_at ? $record->created_at->format('d M Y H:i') : '-')
                    ->since(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                // Update the classroom filter to use correct relationship path
                Tables\Filters\SelectFilter::make('classroom')
                    ->relationship('assignment.chapter.course.classrooms', 'class_name')
                    ->preload()
                    ->multiple()
                    ->label('Filter by Class')
                    ->searchable(),

                Tables\Filters\SelectFilter::make('course')
                    ->relationship('assignment.chapter.course', 'course_name')
                    ->preload()
                    ->searchable()
                    ->multiple()
                    ->label('Filter by Course'),

                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'in_review' => 'In Review',
                        'completed' => 'Completed',
                    ])
                    ->multiple(),

                Tables\Filters\TernaryFilter::make('is_completed')
                    ->label('Completion Status'),

                Tables\Filters\Filter::make('score_range')
                    ->form([
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('score_from')
                                    ->numeric()
                                    ->label('Min Score')
                                    ->minValue(0)
                                    ->maxValue(100),
                                Forms\Components\TextInput::make('score_to')
                                    ->numeric()
                                    ->label('Max Score')
                                    ->minValue(0)
                                    ->maxValue(100),
                            ]),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['score_from'],
                                fn(Builder $query, $score): Builder => $query->where('score', '>=', $score),
                            )
                            ->when(
                                $data['score_to'],
                                fn(Builder $query, $score): Builder => $query->where('score', '<=', $score),
                            );
                    }),

                Tables\Filters\Filter::make('created_at')
                    ->form([
                        Forms\Components\DatePicker::make('created_from')
                            ->label('Submitted From'),
                        Forms\Components\DatePicker::make('created_until')
                            ->label('Submitted Until'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn(Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['created_until'],
                                fn(Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    }),
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
                            'is_completed' => true, // Set is_completed menjadi true
                        ]);
                    })
                    ->visible(fn($record) => $record->status === 'pending'),
                // Tables\Actions\EditAction::make()
                //     ->modalWidth('lg'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateHeading('No Assignment Submissions')
            ->emptyStateDescription('Once students submit their assignments, they will appear here.')
            ->emptyStateIcon('heroicon-o-clipboard-document-check');
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
