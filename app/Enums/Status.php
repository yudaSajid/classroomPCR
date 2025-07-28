<?php

namespace App\Enums;

enum Status
{
    const Pending = 'pending';

    const Approved = 'approved';

    const Reject = 'reject';

    public static function toSelectArray(): array
    {
        return [
            self::Pending => 'Pending',
            self::Approved => 'Approved',
            self::Reject => 'Reject',
        ];
    }
}
