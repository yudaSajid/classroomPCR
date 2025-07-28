<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum BadgeType: string implements HasColor, HasIcon, HasLabel
{
    case Default = 'default';
    case Custom = 'custom';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Default => 'Default',
            self::Custom => 'Custom',
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::Default => 'info',
            self::Custom => 'success',
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::Default => 'heroicon-m-document',
            self::Custom => 'heroicon-m-cog',
        };
    }
}