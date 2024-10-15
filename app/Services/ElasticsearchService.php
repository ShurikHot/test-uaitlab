<?php

namespace App\Services;

use App\Contracts\SearchServiceInterface;
use Elastic\Elasticsearch\Client;
use Elastic\Elasticsearch\ClientBuilder;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Env;

class ElasticsearchService implements SearchServiceInterface
{
    protected Client $client;

    public function __construct()
    {
        $this->client = ClientBuilder::create()
            ->setHosts([Env::get('ELASTICSEARCH_HOST')])
            ->build();
    }

    public function createIndex($indexName, $properties): JsonResponse
    {
        $params = [
            'index' => $indexName,
            'body' => [
                'mappings' => [
                    'properties' => $properties
                ],
            ],
        ];

        if ($this->client->indices()->exists(['index' => $indexName])) {
            $this->client->indices()->delete(['index' => $indexName]);
        }

        $this->client->indices()->create($params);

        return response()->json(['message' => 'Index created']);
    }

    public function indexPart($index, $body)
    {
        return $this->client->index([
            'index' => $index,
            'id' => $body['id'],
            'body' => $body,
        ]);
    }

    public function bulkIndex($index, $data)
    {
        return $this->client->bulk($data);
    }

    public function updatePart($index, $body)
    {
        return $this->client->update([
            'index' => $index,
            'id' => $body['id'],
            'body' => [
                'doc' => $body,
                'doc_as_upsert' => true,
            ],
        ]);
    }

    public function search($params)
    {
        return $this->client->search($params);
    }
}

