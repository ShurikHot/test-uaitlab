<?php

namespace App\Providers;

use App\Contracts\SearchServiceInterface;
use App\Contracts\SparePartsIndexInterface;
use App\Http\Controllers\Crm\Search\ElasticsearchSparePartsIndexController;
use App\Http\Controllers\Crm\Search\ElasticsearchSparePartsSearchController;
use App\Http\Controllers\Crm\Search\MeilisearchSparePartsIndexController;
use App\Http\Controllers\Crm\Search\MeilisearchSparePartsSearchController;
use App\Http\Controllers\Crm\Search\SearchController;
use App\Services\ElasticsearchService;
use App\Services\MeilisearchService;
use http\Env;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use InvalidArgumentException;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();

        //в залежності від обраної системи повнотекстового пошуку (параметр SCOUT_DRIVER в .env)
        if (\env('SCOUT_DRIVER') == 'elasticsearch') {
            $this->app->bind(SearchServiceInterface::class, ElasticsearchService::class);
            $this->app->bind(SparePartsIndexInterface::class, ElasticsearchSparePartsIndexController::class);
            $this->app->bind(SearchController::class, ElasticsearchSparePartsSearchController::class);
        } elseif (\env('SCOUT_DRIVER') == 'meilisearch') {
            $this->app->bind(SearchServiceInterface::class, MeilisearchService::class);
            $this->app->bind(SparePartsIndexInterface::class, MeilisearchSparePartsIndexController::class);
            $this->app->bind(SearchController::class, MeilisearchSparePartsSearchController::class);
        } else {
            throw new InvalidArgumentException('Unsupported SCOUT_DRIVER value');
        }
    }
}
