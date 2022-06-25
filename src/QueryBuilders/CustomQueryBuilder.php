<?php

namespace PrageethPeiris\LaravelQueryBuilderToClickhouse\QueryBuilders;

use Illuminate\Database\Query\Builder;
use Bavix\LaravelClickHouse\Database\Connection;
use Illuminate\Support\Arr;
use Tinderbox\ClickhouseBuilder\Query\Grammar;

class CustomQueryBuilder extends  Builder
{

    public function useBuffer():self{

        $table_name = $this->from;
        $this->from("{$table_name}_buffer");

        return $this;


    }



    public function get($columns = ['*']){

        return   $this->executeClickHouse($this->toSql(),$this->getBindings());

    }

    private function executeClickHouse($toSql,$bindings){



        $raw = $this->getRawSql($toSql,$bindings);

        $sanitized_raw = str_replace('"', '', $raw);  //remove double quotes

        $clickhouse_connection = (new Connection(config('database.connections.bavix::clickhouse')));

        $result = $clickhouse_connection->select($sanitized_raw);



        return collect($result);



    }


    private function getRawSql($builderSql,$builderBindings){
        $sql = $builderSql;

        foreach($builderBindings as $binding)
        {
            $value = is_numeric($binding) ? $binding : "'".$binding."'";
            $sql = preg_replace('/\?/', $value, $sql, 1);
        }
        return $sql;


    }

    public function insert(array $values): bool
    {
        if (empty($values)) {
            return false;
        }

        if (!is_array(reset($values))) {
            $values = [$values];
        }

        // Here, we will sort the insert keys for every record so that each insert is
        // in the same order for the record. We need to make sure this is the case
        // so there are not any errors or problems when inserting these records.
        foreach ($values as $key => &$value) {
            ksort($value);
        }

        $clickhouse_connection = (new Connection(config('database.connections.bavix::clickhouse')));
        $clickhouse_grammar = new Grammar();
        $current_table_name =  str_replace("'","",$clickhouse_grammar->wrap($this->from));


        $clickhouse_builder = (new \Bavix\LaravelClickHouse\Database\Query\Builder($clickhouse_connection,$clickhouse_grammar))->from($current_table_name);

        return  $clickhouse_connection->insert(
            $clickhouse_grammar->compileInsert($clickhouse_builder, $values),
            Arr::flatten($values)
        );
    }





}