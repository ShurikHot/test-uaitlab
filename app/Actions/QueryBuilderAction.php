<?php

namespace App\Actions;

class QueryBuilderAction
{
    public function __invoke($requestInput)
    {
        $searchString = '&';
        foreach ($requestInput as $name => $value) {
            if ($value === null) {
                continue;
            }
            if (is_array($value)) {
                foreach ($value as $item) {
                    if ($item) {
                        $searchString .= $name . '[]=' . urlencode($item) . '&';
                    }
                }
            } else {
                if ($name !== 'page' && $value) {
                    $searchString .= $name . '=' . urlencode($value) . '&';
                }
            }
        }

        return rtrim($searchString, '&');
    }
}
