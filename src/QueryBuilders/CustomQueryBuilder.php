<?php

namespace PrageethPeiris\LaravelQueryBuilderToClickhouse\QueryBuilders;

use Illuminate\Database\Query\Builder;
use PrageethPeiris\LaravelQueryBuilderToClickhouse\Traits\ExecuteOnClickHouse;


class CustomQueryBuilder extends  Builder
{
    use ExecuteOnClickHouse;

    public function useBuffer():self{

        $table_name = $this->from;
        $this->from("{$table_name}_buffer");

        return $this;


    }







}