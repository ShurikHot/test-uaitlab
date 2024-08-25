<?php

namespace App\Actions;

use Illuminate\Support\Carbon;

class DateFormatAction
{
    public function __invoke(?string $value, string $format): string
    {
        if (Carbon::hasFormat($value, 'Y-m-d')) {
            $value = Carbon::createFromFormat('Y-m-d', $value)->format($format);
        } else {
            $value = '';
        }

        return $value;
    }
}
