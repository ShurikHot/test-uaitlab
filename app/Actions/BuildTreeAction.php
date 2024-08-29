<?php

namespace App\Actions;

class BuildTreeAction
{
    private function makeTree(array $elements, string|int $parentId = 0): array
    {
        $branch = [];
        foreach ($elements as $element) {
            if ($element['parent_id'] == $parentId) {
                $children = $this->makeTree($elements, $element['code_1C']);
                if ($children) {
                    $element['children'] = $children;
                }
                $branch[] = $element;
            }
        }
        return $branch;
    }

    public function getTree(string $model): array
    {
        $codes = $model::all();
        $codesArray = $codes->toArray();

        return $this->makeTree($codesArray);
    }
}
