<?php

namespace App\Actions;

class BuildTreeAction
{
    public function getTree(string $model): array
    {
        $codes = $model::all()->toArray();

        $tree = [];
        foreach ($codes as $code) {
            if ($code['parent_id'] == '0') {
                foreach ($codes as $children) {
                    if ($children['parent_id'] == $code['code_1C']) {
                        $code['children'][] = $children;
                    }
                }
                $tree[] = $code;
            }
        }

        return $tree;
    }
}
