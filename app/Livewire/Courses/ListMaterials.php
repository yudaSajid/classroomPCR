<?php

namespace App\Livewire\Courses;

use App\Models\Material;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables;
use Filament\Tables\Columns\ViewColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Grouping\Group;
use Filament\Tables\Table;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class ListMaterials extends Component implements HasForms, HasTable
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
                Material::whereHas('chapter', function (Builder $query) {
                    $query->where('course_id', $this->courseID);
                })
                    ->join('chapters', 'materials.chapter_id', '=', 'chapters.id')
                    ->orderBy('chapters.chapter_number')
                    ->orderBy('materials.order_number')
                    ->select('materials.*')
            )
            ->recordUrl(fn (Material $record) => '#')
            ->recordAction(fn (Material $record) => $this->emit('materialSelected', $record->id))
            ->groups([
                Group::make('chapter.titles')
                    ->label('Chapters')
                    ->collapsible(),
            ])
            ->defaultGroup('chapter.titles')
            ->columns([
                // Tables\Columns\TextColumn::make('material_name')
                //     ->searchable()
                //     ->description(fn (Material $record): string => $record->duration)
                //     ->icon('heroicon-m-video-camera'),
                ViewColumn::make('material_name')->view('tables.columns.material-name'),
                // Tables\Columns\TextColumn::make('duration')
                //     ->label('Duration')
                //     ->badge()
                //     ->formatStateUsing(fn ($state) => $state),
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
                Tables\Actions\CreateAction::make()
                    ->icon('heroicon-m-play-circle')
                    ->label('Play'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    //
                ]),
            ]);
    }

    public function render(): View
    {
        return view('livewire.courses.list-materials');
    }
}
