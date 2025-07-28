<?php

namespace App\Enums;

enum ImageType
{
    const Thumbnail = 'thumbnail';

    const Profile = 'profile';

    const GIF = 'GIF';

    public static function toSelectArray(): array
    {
        return [
            self::Thumbnail => 'Thumbnail',
            self::Profile => 'Profile',
            self::GIF => 'GIF',
        ];
    }
}
