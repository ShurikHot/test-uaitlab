<?php

namespace App\Http\Controllers\Crm\Search;

use App\Contracts\SearchServiceInterface;
use App\Contracts\SparePartsIndexInterface;
use App\Http\Controllers\Controller;
use App\Models\SpareParts;

class MeilisearchSparePartsIndexController extends Controller implements SparePartsIndexInterface
{
    protected $meilisearchService;
    public function __construct(SearchServiceInterface $meilisearchService)
    {
        $this->meilisearchService = $meilisearchService;
    }

    public function createIndex()
    {
        $spareParts = SpareParts::all();
        $spareParts->searchable();
    }

    public function indexPart($part)
    {
        $this->meilisearchService->indexPart(static::INDEX, $part);

        return response()->json(['message' => 'Indexing completed']);
    }

    public function updatePart($part)
    {
        $this->meilisearchService->updatePart(static::INDEX, $part);

        return response()->json(['message' => 'Updating completed']);
    }
}
