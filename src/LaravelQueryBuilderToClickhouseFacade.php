<?php

namespace PrageethPeiris\LaravelQueryBuilderToClickhouse;

use Illuminate\Support\Facades\Facade;

/**
 * @see \PrageethPeiris\LaravelQueryBuilderToClickhouse\Skeleton\SkeletonClass
 */
class LaravelQueryBuilderToClickhouseFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'laravel-query-builder-to-clickhouse';
    }
}
