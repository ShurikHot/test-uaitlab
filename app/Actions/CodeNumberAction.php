<?php

namespace App\Actions;

use Illuminate\Support\Str;

class CodeNumberAction
{
    public function getCode(): string
    {
        return Str::random(8) . '-6734-11e3-88bf-00155d00402a';
    }

    public function getNumber(): string
    {
        return 'emg-' . Str::random(7);
    }
}
