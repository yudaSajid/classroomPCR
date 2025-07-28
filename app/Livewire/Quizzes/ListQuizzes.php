<?php

namespace App\Livewire\Quizzes;

use App\Models\Quiz;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class ListQuizzes extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    public $courseID;

    public function mount($courseID)
    {
        $this->courseID = $courseID;
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(Quiz::query()->where('course_id', $this->courseID)) // Menambahkan filter berdasarkan courseID
            ->columns([
                Tables\Columns\TextColumn::make('course.course_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('chapter.titles')
                    ->searchable(),
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
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
                Action::make('takeQuiz')
                    ->label('Take Quiz')
                    ->action(fn (Quiz $record) => $this->redirect(route('quiz.take', $record->id))) // Redirect ke halaman quiz

                    ->openUrlInNewTab(), // Membuka di tab baru
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    //
                ]),
            ]);
    }

    public function render(): View
    {
        return view('livewire.quizzes.list-quizzes');
    }
}
