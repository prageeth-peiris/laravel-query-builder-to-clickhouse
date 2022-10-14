<?php

namespace PrageethPeiris\LaravelQueryBuilderToClickhouse\QueryBuilders;

use Illuminate\Database\Query\Builder;
use PrageethPeiris\LaravelQueryBuilderToClickhouse\Traits\ExecuteOnClickHouse;


class CustomQueryBuilder extends  Builder
{
    use ExecuteOnClickHouse;

    public function useTableSuffix(string $suffix):self{

        $table_name = $this->from;
        $this->from("{$table_name}_{$suffix}");

        return $this;


    }







}