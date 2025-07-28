<?php

namespace App\Filament\Student\Pages;

use Filament\Pages\Page;

class TryQuiz extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.student.pages.try-quiz';

    public static function shouldRegisterNavigation(): bool
    {
        return false;
    }

    public $quiz;
}
