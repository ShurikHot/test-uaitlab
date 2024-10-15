<?php

namespace App\Contracts;

interface SparePartsIndexInterface
{
    public final const INDEX = 'parts';

    public function createIndex();
    public function indexPart($part);
    public function updatePart($part);
}
