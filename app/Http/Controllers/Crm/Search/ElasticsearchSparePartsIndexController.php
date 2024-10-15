<?php

namespace App\Http\Controllers\Crm\Search;

use App\Contracts\SearchServiceInterface;
use App\Contracts\SparePartsIndexInterface;
use App\Http\Controllers\Controller;
use App\Models\SpareParts;

class ElasticsearchSparePartsIndexController extends Controller implements SparePartsIndexInterface
{
    protected $elasticsearchService;
    public function __construct(SearchServiceInterface $elasticsearchService)
    {
        $this->elasticsearchService = $elasticsearchService;
    }

    public function createIndex()
    {
        $properties = [
            'articul' => [
                'type' => 'text',
            ],
            'product' => [
                'type' => 'text',
            ],
        ];

        $this->elasticsearchService->createIndex(static::INDEX, $properties);

        $this->bulkIndexParts();
    }

    public function indexPart($part)
    {
        $this->elasticsearchService->indexPart(static::INDEX, $part->toArray());

        return response()->json(['message' => 'Indexing completed']);
    }

    public function updatePart($part)
    {
        $this->elasticsearchService->updatePart(static::INDEX, $part->toArray());

        return response()->json(['message' => 'Updating completed']);
    }

    public function bulkIndexParts()
    {
        $parts = SpareParts::all();
        $bulkData = [];

        foreach ($parts as $part) {
            $bulkData['body'][] = [
                'index' => [
                    '_index' => static::INDEX,
                    '_id' => $part->id,
                ],
            ];
            $bulkData['body'][] = $part->toArray();
        }

        $this->elasticsearchService->bulkIndex(static::INDEX, $bulkData);

        return response()->json(['message' => 'Bulk indexing completed']);
    }
}
