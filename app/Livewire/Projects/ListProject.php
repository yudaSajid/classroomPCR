<?php

namespace App\Livewire\Projects;

use App\Models\Project;
use App\Models\ProjectSubmission;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ListProject extends Component implements HasForms, HasTable
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
            ->query(
                Project::query()
                    ->where('course_id', $this->courseID)
                    ->where('project_publish', 1)
                    // Mengambil submission terkait jika ada (left join dengan `with`)
                    ->with(['submissions' => function ($query) {
                        $query->where('user_id', Auth::id());
                    }])
            )
            ->columns([

                Tables\Columns\TextColumn::make('project_name')
                    ->searchable(),
                Tables\Columns\IconColumn::make('project_publish')
                    ->boolean(),
                Tables\Columns\ImageColumn::make('project_photo')
                    ->circular()
                    ->searchable(),
                Tables\Columns\TextColumn::make('submissions.submission_score')
                    ->label('Score')
                    ->formatStateUsing(function ($state, $record) {
                        // Ambil submission dari user yang sedang login
                        $submission = $record->submissions->first(); // Karena `with` mengembalikan Collection

                        return $submission ? $submission->submission_score : 'No Score';
                    }),
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
                //
            ])
            ->actions([
                CreateAction::make()
                    ->model(ProjectSubmission::class)
                    ->icon('heroicon-m-arrow-up-tray')
                    ->label('Upload Project')
                    ->form(function ($record) {
                        return [
                            Hidden::make('user_id')->default(Auth::id()), // Dapatkan user_id
                            Hidden::make('project_id')->default($record->id), // Dapatkan project_id dari record
                            TextInput::make('submission_link')
                                ->required()
                                ->maxLength(255)
                                ->placeholder('ex: https:://iqbalkeren.com')
                                ->url(),
                            TextInput::make('submission_notes'),
                        ];
                    })
                    ->createAnother(false)
                    ->visible(function ($record) {
                        // Cek apakah ProjectSubmission sudah ada untuk project ini oleh user yang sedang login
                        return ! ProjectSubmission::where('project_id', $record->id)
                            ->where('user_id', Auth::id())
                            ->exists();
                    }),

            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    //
                ]),
            ]);
    }

    public function render(): View
    {
        return view('livewire.projects.list-project');
    }
}
