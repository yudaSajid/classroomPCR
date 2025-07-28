<?php

namespace App\Filament\Teacher\Pages;

use Filament\Pages\Page;

class BadgePage extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-check-badge';
    protected static ?string $navigationLabel = 'Badge';
    protected static ?string $navigationGroup = 'Management';
    protected ?string $heading = 'Badge';
    protected static string $view = 'filament.teacher.pages.badge-page';
}
