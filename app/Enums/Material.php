<?php

namespace App\Enums;

enum Material
{
    const Quiz = 'quiz';

    const Duration = 'duration';

    const Skip = 'skip';

    public static function toActionArray(): array
    {
        return [
            self::Quiz => 'Quiz',
            self::Duration => 'Duration',
            self::Skip => 'Skip',
        ];
    }
}
