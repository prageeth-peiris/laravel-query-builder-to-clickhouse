<?php

namespace PrageethPeiris\LaravelQueryBuilderToClickhouse;

use Illuminate\Database\DatabaseManager;
use Illuminate\Support\ServiceProvider;
use PrageethPeiris\LaravelQueryBuilderToClickhouse\Connections\CustomConnection;

class LaravelQueryBuilderToClickhouseServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {

    }

    /**
     * Register the application services.
     */
    public function register()
    {

        $this->app->resolving('db', static function (DatabaseManager $db) {
            $db->extend('clickhouse_custom', static function ($config, $name) {
                return new CustomConnection(\array_merge($config, \compact('name')));
            });
        });



    }
}
