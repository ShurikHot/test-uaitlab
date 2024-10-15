<?php

namespace App\Services;

use App\Contracts\SearchServiceInterface;
use App\Models\SpareParts;
use Illuminate\Support\Env;
use Meilisearch\Client;

class MeilisearchService implements SearchServiceInterface
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client(Env::get('MEILISEARCH_HOST'));
    }

    public function search($params)
    {
        return SpareParts::search($params)->get();
    }

    public function indexPart($index, $body)
    {
        $index = $this->client->index($index);

        return $index->addDocuments([$body]);
    }

    public function updatePart($index, $body)
    {
        $index = $this->client->index($index);

        return $index->addDocuments([$body]);
    }
}
