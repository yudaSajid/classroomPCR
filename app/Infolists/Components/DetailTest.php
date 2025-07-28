<?php

namespace App\Infolists\Components;

use Filament\Infolists\Components\Component;

class DetailTest extends Component
{
    protected string $view = 'infolists.components.detail-test';

    public static function make(): static
    {
        return app(static::class);
    }
}
