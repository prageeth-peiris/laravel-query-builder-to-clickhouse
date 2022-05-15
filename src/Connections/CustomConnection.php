<?php

namespace PrageethPeiris\LaravelQueryBuilderToClickhouse\Connections;

use Bavix\LaravelClickHouse\Database\Connection;
use Illuminate\Database\Query\Grammars\Grammar;
use Illuminate\Database\Query\Processors\Processor;
use PrageethPeiris\LaravelQueryBuilderToClickhouse\QueryBuilders\CustomQueryBuilder;

class CustomConnection extends  Connection
{
    public function query()
    {
        return new CustomQueryBuilder($this,new Grammar(),new Processor());
    }


}