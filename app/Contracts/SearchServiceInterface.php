<?php

namespace App\Contracts;

interface SearchServiceInterface
{
    public function search($params);
    public function indexPart($index, $body);
    public function updatePart($index, $body);
}
