<?php

namespace App\Livewire;

use App\Models\Classroom;
use App\Models\Point;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\Action;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class PointsHistory extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    public Classroom $classroom;

    public function mount($classroomId): void
    {
        $this->classroom = Classroom::findOrFail($classroomId);
    }

    public function table(Table $table): Table
    {
        return $table
            ->description('Riwayat pemberian point kepada student')
            ->query(
                Point::query()
                    ->where('giver_id', Auth::id())
                    ->whereHas('user', function ($query) {
                        $query->whereHas('classrooms', function ($q) {
                            $q->where('classrooms.id', $this->classroom->id);
                        });
                    })
                    ->latest()
            )
            ->columns([
                TextColumn::make('user.name')
                    ->label('Student Name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('points')
                    ->label('Points Awarded')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('reason')
                    ->label('Reason')
                    ->searchable(),
                TextColumn::make('created_at')
                    ->label('Date Awarded')
                    ->dateTime()
                    ->sortable(),
            ])
            ->headerActions([
                Action::make('addPoints')
                    ->label('Add Points')
                    ->icon('heroicon-o-plus-circle')
                    ->color('primary')
                    ->form([
                        CheckboxList::make('student_ids')
                            ->label('Select Students')
                            ->options(
                                $this->classroom->users()->whereDoesntHave('roles', function ($query) {
                                    $query->where('name', 'teacher_user');
                                })->pluck('users.name', 'users.id')->toArray()
                            )
                            ->required()
                            ->columns(2)
                            ->bulkToggleable(),
                        TextInput::make('points')
                            ->label('Points')
                            ->numeric()
                            ->required()
                            ->minValue(1),
                        Textarea::make('reason')
                            ->label('Reason')
                            ->required()
                            ->maxLength(255),
                    ])
                    ->action(function (array $data) {
                        try {
                            DB::transaction(function () use ($data) {
                                foreach ($data['student_ids'] as $studentId) {
                                    Point::create([
                                        'user_id' => $studentId,
                                        'giver_id' => Auth::id(),
                                        'points' => $data['points'],
                                        'reason' => $data['reason'],
                                        'assignment_id' => null, // Or link to a relevant entity if needed
                                    ]);
                                }
                            });

                            Notification::make()
                                ->title('Points awarded successfully')
                                ->success()
                                ->send();

                        } catch (\Exception $e) {
                            Notification::make()
                                ->title('An error occurred')
                                ->body($e->getMessage())
                                ->danger()
                                ->send();
                        }
                    }),
            ]);
    }

    public function render()
    {
        return view('livewire.points-history');
    }
}
