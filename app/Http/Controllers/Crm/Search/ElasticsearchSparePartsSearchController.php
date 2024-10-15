<?php

namespace App\Http\Controllers\Crm\Search;

use App\Contracts\SearchServiceInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ElasticsearchSparePartsSearchController extends Controller
{
    protected $elasticsearchService;

    public function __construct(SearchServiceInterface $elasticsearchService)
    {
        $this->elasticsearchService = $elasticsearchService;
    }

    public function __invoke(Request $request)
    {
        $query = $request->input('query');

        $params = [
            'index' => 'parts',
            'body' => [
                'query' => [
                    'wildcard' => [
                        'product' => [
                            'value' => "*$query*"
                        ]
                    ]
                ]
            ]
        ];

        $response = $this->elasticsearchService->search($params);

        $parts = array_map(function ($hit) {
            return $hit['_source'];
        }, $response['hits']['hits']);

        return response()->json($parts);
    }
}
