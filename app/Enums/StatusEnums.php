<?php

namespace App\Enums;

enum StatusEnums: string
{
    case DONE = 'Done';
    case FALSE = 'Ложь';

    public static function getStatuses(): array
    {
        return array_column(self::cases(), 'value');
    }
}
