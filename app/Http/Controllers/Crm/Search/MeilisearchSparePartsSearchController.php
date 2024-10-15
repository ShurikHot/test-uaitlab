<?php

namespace App\Http\Controllers\Crm\Search;

use App\Contracts\SearchServiceInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MeilisearchSparePartsSearchController extends Controller
{
    protected $meilisearchService;

    public function __construct(SearchServiceInterface $meilisearchService)
    {
        $this->meilisearchService = $meilisearchService;
    }

    public function __invoke(Request $request)
    {
        $query = $request->input('query');
        $parts = $this->meilisearchService->search($query);

        return response()->json($parts);
    }
}
