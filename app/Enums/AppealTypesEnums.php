<?php

namespace App\Enums;

enum AppealTypesEnums: string
{
    case WARRANTY = 'Гарантия';
    case NOT_WARRANTY = 'НеГарантия';
    case RETURN_EXCHANGE = 'ВозвратОбмен';

    public static function getTypes(): array
    {
        return array_column(self::cases(), 'value');
    }
}
